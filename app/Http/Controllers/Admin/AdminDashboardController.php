<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\MongoOrder;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::count();
        $totalCustomers = User::count();
        $totalOrders    = MongoOrder::count();

        $totalRevenue = MongoOrder::sum('total');

        $recentOrders = MongoOrder::orderBy('created_at', 'desc')->take(5)->get();


        $byId = MongoOrder::raw(function ($col) {
            return $col->aggregate([
                ['$unwind' => '$items'],
                ['$match'  => ['items.product_id' => ['$exists' => true, '$ne' => null, '$ne' => '']]],
                [
                    '$group' => [
                        '_id'   => '$items.product_id',
                        'count' => ['$sum' => '$items.quantity'],
                    ]
                ],
            ]);
        });

        $byName = MongoOrder::raw(function ($col) {
            return $col->aggregate([
                ['$unwind' => '$items'],
                [
                    '$match' => [
                        '$or' => [
                            ['items.product_id' => ['$exists' => false]],
                            ['items.product_id' => null],
                            ['items.product_id' => ''],
                        ]
                    ]
                ],
                [
                    '$group' => [
                        '_id'   => '$items.name',
                        'count' => ['$sum' => '$items.quantity'],
                    ]
                ],
            ]);
        });

        $countByProductId = [];
        foreach ($byId as $row) {
            $pid = $row->_id;
            $pid = is_numeric($pid) ? (int)$pid : $pid; // cast if needed
            $countByProductId[$pid] = ($countByProductId[$pid] ?? 0) + (int)$row->count;
        }

        $names = collect($byName)->pluck('_id')->filter()->unique()->values();
        $productsByName = Product::whereIn('name', $names)->get()->keyBy('name');

        $unresolvedNameCounts = [];

        foreach ($byName as $row) {
            $name = $row->_id;
            $qty  = (int) $row->count;

            $product = $productsByName->get($name);
            if ($product) {
                $pid = (int) $product->id;
                $countByProductId[$pid] = ($countByProductId[$pid] ?? 0) + $qty;
            } else {
                $unresolvedNameCounts[$name] = ($unresolvedNameCounts[$name] ?? 0) + $qty;
            }
        }

        $productIds = array_keys($countByProductId);
        $productsMap = $productIds
            ? Product::whereIn('id', $productIds)->get()->keyBy('id')
            : collect();

        $topList = [];

        foreach ($countByProductId as $pid => $qty) {
            $p = $productsMap->get((int)$pid);
            if ($p) {
                $topList[] = (object)[
                    'id'       => (int)$p->id,
                    'name'     => $p->name,
                    'brand'    => $p->brand ?? '-',
                    'category' => $p->category ?? '-',
                    'image'    => $p->image_path ?? null,
                    'count'    => $qty,
                ];
            }
        }

        foreach ($unresolvedNameCounts as $name => $qty) {
            $topList[] = (object)[
                'id'       => null,
                'name'     => $name,
                'brand'    => '-',
                'category' => '-',
                'image'    => null,
                'count'    => $qty,
            ];
        }

        $topProducts = collect($topList)
            ->sortByDesc('count')
            ->take(5)
            ->values();


        $salesData = MongoOrder::raw(function($collection) {
            return $collection->aggregate([
                [
                    '$match' => [
                        'created_at' => [
                            '$gte' => new \MongoDB\BSON\UTCDateTime(now()->subDays(6)->startOfDay())
                        ]
                    ]
                ],
                [
                    '$group' => [
                        '_id' => [
                            'day' => ['$dateToString' => ['format' => "%Y-%m-%d", 'date' => '$created_at']]
                        ],
                        'total' => ['$sum' => '$total']
                    ]
                ],
                ['$sort' => ['_id.day' => 1]]
            ]);
        });

        $labels = [];
        $data   = [];
        foreach ($salesData as $day) {
            $labels[] = $day->_id['day'];
            $data[]   = $day->total;
        }

        $customerIdsWithOrders = MongoOrder::raw(function($collection) {
            return $collection->distinct('user_id');
        });

        $activeCustomers   = is_array($customerIdsWithOrders) ? count($customerIdsWithOrders) : 0;
        $inactiveCustomers = $totalCustomers - $activeCustomers;

        return view('admin.admindashboard', compact(
            'totalProducts',
            'totalCustomers',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'topProducts',
            'labels',
            'data',
            'activeCustomers',
            'inactiveCustomers'
        ));
    }
}
