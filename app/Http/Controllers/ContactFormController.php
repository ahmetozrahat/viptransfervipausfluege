<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function index(Request $request) {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'message' => ['required', 'string']
        ]);

        $ticket = new Ticket;

        $ticket->name = $request->post('name');
        $ticket->email = $request->post('email');
        $ticket->phone = $request->post('phone');
        $ticket->message = $request->post('message');

        $result = $ticket->save();
        if ($result) {
            return true;
        }
        return false;
    }
}
