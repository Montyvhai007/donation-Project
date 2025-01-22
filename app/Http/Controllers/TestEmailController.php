<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class TestEmailController extends Controller
{
    public function showForm()
    {
        return view('test-email');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $recipientEmail = $request->input('email');

        Mail::raw('This is a test email.', function ($message) use ($recipientEmail) {
            $message->to($recipientEmail)
                ->subject('Test Email')
                ->from(config('mail.from.address'), config('mail.from.name'));
        });

        return redirect()->back()->with('success', 'Test email sent successfully to ' . $recipientEmail);
    }
}
