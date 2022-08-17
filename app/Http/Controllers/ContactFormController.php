<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\AdminAccount;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

            $ticket = $ticket->fresh();

            $data = [
                'app_id' => env('ONESIGNAL_APP_ID', ''),
                'included_segments' => ['Subscribed Users'],
                'headings' => [
                    'en' => $ticket->name . ' • Yeni İletişim Talebi'
                ],
                'contents' => [
                    'en' => $ticket->message
                ],
                'data' => [
                    'ticket_id' => $ticket->id
                ]
            ];

            Http::contentType('application/json')
                ->acceptJson()
                ->withToken(env('ONESIGNAL_REST_API_KEY', ''))
                ->post('https://onesignal.com/api/v1/notifications', $data);

            return true;
        }
        return false;
    }
}
