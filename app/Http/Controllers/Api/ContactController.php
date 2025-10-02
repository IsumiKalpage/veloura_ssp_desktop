<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // 🔹 Store Contact Message (JSON)
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','string','max:150'],
            'last_name'  => ['nullable','string','max:150'],
            'email'      => ['required','email','max:255'],
            'phone'      => ['nullable','string','max:50'],
            'message'    => ['required','string','max:5000'],
        ]);

        $msg = ContactMessage::create([
            'user_id'    => optional($request->user())->id,
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'] ?? null,
            'email'      => $data['email'],
            'phone'      => $data['phone'] ?? null,
            'message'    => $data['message'],
            'ip_address' => $request->ip(),
            'status'     => 'new',
        ]);

        return response()->json($msg, 201);
    }
}
