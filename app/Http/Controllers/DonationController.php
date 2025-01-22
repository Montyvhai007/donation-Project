<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Donation;
use App\Notifications\PaymentSuccessfulNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class DonationController extends Controller
{
    public function donation(Request $req)
    {
        if ($req->ajax()) {
            if (auth()->user()->role !== 'admin') {
                return response()->json(['error' => 'You\'re not authorized'], 401);
            }

            $donation = Donation::query(); // Updated to use query()
            if ($req->status) {
                $donation->where('status', $req->status);
            }

            return \DataTables::of($donation)
                ->addColumn('action', function ($donation) {
                    $button = '<button type="button" data-id="' . $donation->id . '" class="edit btn btn-outline-danger btn-sm mb-1 me-1 deletedonation"><i class="fa fa-trash"></i></button>';
                    if ($donation->add_to_leaderboard == 'yes') {
                        $button .= ' <button type="button" data-id="' . $donation->id . '" data-status="' . $donation->add_to_leaderboard . '" class="btn btn-outline-danger btn-sm mb-1 me-1 change-leaderboard-status"><i class="fa fa-ban"></i></button>';
                    } else {
                        $button .= ' <button type="button" data-id="' . $donation->id . '" data-status="' . $donation->add_to_leaderboard . '" class="btn btn-outline-success btn-sm mb-1 me-1 change-leaderboard-status"><i class="fa fa-check"></i></button>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if (auth()->user()->role !== 'admin') {
            return redirect()->route('auth.dashboard')->with(['error' => 'Oops! You are not authorized to access this page.']);
        }

        return view('admin.auth.donation');
    }

    public function leaderBoardStatus(Request $req)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'You\'re not authorized.'], 401);
        }

        $req->validate([
            'id' => 'required|exists:donation,id',
            'status' => 'required|in:yes,no',
        ]);

        $donation = Donation::find($req->id);
        $donation->add_to_leaderboard = $req->status == 'yes' ? 'no' : 'yes';

        if ($donation->save()) {
            return response()->json(['success' => 'Leaderboard status changed successfully'], 200);
        }

        return response()->json(['error' => 'Something went wrong'], 500);
    }

    public function delete(Request $req)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'You\'re not authorized.'], 401);
        }

        $req->validate([
            'id' => 'required|exists:donation,id',
        ]);

        $donation = Donation::find($req->id);

        if ($donation->delete()) {
            return response()->json(['success' => 'Donation deleted successfully'], 200);
        }

        return response()->json(['error' => 'Something went wrong'], 500);
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:' . env('MIN_DONATION_AMOUNT'),
        ]);

        // Payment processing logic
        $paymentSuccess = true; // Simulating payment success for demonstration

        if ($paymentSuccess) {
            // Trigger notification
            $userName = $validated['first_name'] . ' ' . $validated['last_name'];
            $userEmail = $validated['email'];
            $donationAmount = $validated['amount'];

            // Sending email notification
            Notification::route('mail', $userEmail)
                ->notify(new PaymentSuccessfulNotification($userName, $donationAmount));

            return redirect()->back()->with('success', 'Payment successful! A confirmation email has been sent.');
        } else {
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    }
}
