<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','string','max:150'],
            'last_name'  => ['nullable','string','max:150'],
            'email'      => ['required','email','max:255'],
            'phone'      => ['nullable','string','max:50'],
            'message'    => ['required','string','max:5000'],
        ]);

        ContactMessage::create([
            'user_id'    => auth()->id(),
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'] ?? null,
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? null,
            'message'    => $data['message'],
            'ip_address' => $request->ip(),
            'status'     => 'new',
        ]);

        return back()->with('success', 'Thanks! Your message has been sent. We’ll get back to you soon.');
    }
}
