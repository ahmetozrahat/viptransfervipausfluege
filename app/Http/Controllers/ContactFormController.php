<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\AdminAccount;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            // Send ticket as mail to the system admins.
            Mail::to('info@viptransfervipausfluege.com')
                ->cc(AdminAccount::where('is_active', true)->get()->all())
                ->send(new Contact($ticket));
            return true;
        }
        return false;
    }
}
