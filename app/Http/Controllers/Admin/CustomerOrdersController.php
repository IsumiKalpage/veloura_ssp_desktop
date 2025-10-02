<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MongoOrder;
use Illuminate\Http\Request;

class CustomerOrdersController extends Controller
{
    public function index(Request $request)
    {
        $query = MongoOrder::query();

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')
                        ->paginate(12)
                        ->appends($request->all());

        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = MongoOrder::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $order = MongoOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated successfully.');
    }
}
