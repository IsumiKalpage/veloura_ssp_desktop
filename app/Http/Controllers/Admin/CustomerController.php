<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch all customers 
        $customers = User::all();

        return view('admin.customers', compact('customers'));
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.edit-customer', compact('customer'));
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')
                         ->with('success', 'Customer deleted successfully.');
    }
}
