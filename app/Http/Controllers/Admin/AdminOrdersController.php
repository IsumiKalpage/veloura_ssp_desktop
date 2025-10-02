<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MongoOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;

class AdminOrdersController extends Controller
{
    public function index(Request $request)
    {
        $query = MongoOrder::query();

        if ($request->filled('q')) {
            $q = trim($request->q);

            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });

            if (preg_match('/^[a-f0-9]{24}$/i', $q)) {
                $query->orWhere('_id', new ObjectId($q));
            }
        }

        //status filter
        if ($request->filled('status')) {
            $query->where('status', (string) $request->status);
        }

        if ($request->filled('payment') && $request->payment !== 'all') {
            $query->where('payment_method', (string) $request->payment);
        }

        if ($request->filled('from')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $query->where('created_at', '>=', $from);
        }

        if ($request->filled('to')) {
            $to = Carbon::parse($request->to)->endOfDay();
            $query->where('created_at', '<=', $to);
        }

        $orders = $query->orderBy('created_at', 'desc')
                        ->paginate(12)
                        ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show a single order details page
     */
    public function show(string $id)
    {
        $order = MongoOrder::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
}
