<?php

namespace App\Http\Controllers;

use App\Service\Twilio\PhoneNumberLookupService;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    public function show(Request $request)
    {
        $lookupService = new PhoneNumberLookupService(
            env('TWILIO_AUTH_SID'),
            env('TWILIO_AUTH_TOKEN')
        );

        $validated = $request->validate([
            'phone_number' => ['required', 'string', function ($attribute, $value, $fail) use ($lookupService) {
                if (! $lookupService->validate($value)) {
                    $fail(sprintf('The value provided (%s) is not a valid phone number.', $value));
                }
            }],
        ]);

        return true;
    }
}
