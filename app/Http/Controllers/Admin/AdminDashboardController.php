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

        // ✅ Total Revenue (sum of all orders)
        $totalRevenue = MongoOrder::sum('total');

        // ✅ Recent Orders (last 5)
        $recentOrders = MongoOrder::orderBy('created_at', 'desc')->take(5)->get();

        /**
         * ---------- TOP PRODUCTS (True top 5 by quantity) ----------
         * 1) Group by items.product_id when available.
         * 2) For items missing product_id, group by items.name.
         * 3) Map those names to real SQL products and merge counts with #1.
         * 4) Sort by count desc, take 5, and attach product details (brand/category/image).
         */

        // 1) group by product_id (exists & not null/empty)
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

        // 2) group by name for items missing product_id
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

        // Build counts by product id from #1
        $countByProductId = [];
        foreach ($byId as $row) {
            $pid = $row->_id;
            $pid = is_numeric($pid) ? (int)$pid : $pid; // cast if needed
            $countByProductId[$pid] = ($countByProductId[$pid] ?? 0) + (int)$row->count;
        }

        // Resolve names -> products (SQL), then merge counts into the same map
        $names = collect($byName)->pluck('_id')->filter()->unique()->values();
        $productsByName = Product::whereIn('name', $names)->get()->keyBy('name');

        // Track any unresolved names (old/deleted products) to still show as rows
        $unresolvedNameCounts = [];

        foreach ($byName as $row) {
            $name = $row->_id;
            $qty  = (int) $row->count;

            $product = $productsByName->get($name);
            if ($product) {
                $pid = (int) $product->id;
                $countByProductId[$pid] = ($countByProductId[$pid] ?? 0) + $qty;
            } else {
                // keep as "orphan" by name so it can compete in top 5 if truly popular
                $unresolvedNameCounts[$name] = ($unresolvedNameCounts[$name] ?? 0) + $qty;
            }
        }

        // Load product details for ids we have
        $productIds = array_keys($countByProductId);
        $productsMap = $productIds
            ? Product::whereIn('id', $productIds)->get()->keyBy('id')
            : collect();

        // Build unified list: resolved products + unresolved names
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

        // Sort by count desc and take 5
        $topProducts = collect($topList)
            ->sortByDesc('count')
            ->take(5)
            ->values();

        // ---------- SALES (unchanged) ----------
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

        return view('admin.admindashboard', compact(
            'totalProducts',
            'totalCustomers',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'topProducts',
            'labels',
            'data'
        ));
    }
}
