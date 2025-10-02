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
        $totalProducts = Product::count();
        $totalCustomers = User::count();
        $totalOrders = MongoOrder::count();

        // ✅ Total Revenue (sum of all orders)
        $totalRevenue = MongoOrder::sum('total');

        // ✅ Recent Orders (last 5)
        $recentOrders = MongoOrder::orderBy('created_at', 'desc')->take(5)->get();

        // ✅ Top Products (aggregate by items array)
        $topProducts = MongoOrder::raw(function($collection) {
            return $collection->aggregate([
                ['$unwind' => '$items'],
                [
                    '$group' => [
                        '_id' => '$items.name',
                        'brand' => ['$first' => '$items.brand'],
                        'category' => ['$first' => '$items.category'],
                        'image' => ['$first' => '$items.image'],
                        'count' => ['$sum' => '$items.quantity']
                    ]
                ],
                ['$sort' => ['count' => -1]],
                ['$limit' => 5]
            ]);
        });

        // ✅ Sales Analytics (last 7 days revenue)
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
        $data = [];
        foreach ($salesData as $day) {
            $labels[] = $day->_id['day'];
            $data[] = $day->total;
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
