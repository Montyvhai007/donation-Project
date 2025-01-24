<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationMail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;  
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;  // Use the Auth facade for easier login management

class AuthController extends Controller
{
    public function confirmEmail($id, $hash)
{
    $developer = Developer::findOrFail($id);

    // Check if the hash matches the email hash
    if (sha1($developer->email) !== $hash) {
        abort(404, 'Invalid verification link.');
    }

    // Perform email verification logic (e.g., mark as verified)
    $developer->update(['email_verified_at' => now()]);

    return redirect()->route('login')->with('status', 'Email verified successfully.');
}


public function verifyEmail($id, $hash)
{
    Log::info("Verifying email for ID: $id, Hash: $hash");
    $user = User::findOrFail($id);

    if (! hash_equals($hash, sha1($user->getEmailForVerification()))) {
        throw new \Illuminate\Validation\ValidationException('Invalid or expired verification link.');
    }

    $user->markEmailAsVerified();

    return redirect()->route('home')->with('status', 'Email verified successfully!');
}



    // Show signup form
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Handle user signup
    public function handleSignup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:developers',
            'password' => 'required|min:2|confirmed',
        ]);
    
        Log::info('Signup Data:', $request->all());  // Logging the signup data
    
        $developer = Developer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(60), ['id' => $developer->id, 'hash' => Hash::make($developer->email)]
        );
        
    
        // Send email confirmation
        Mail::to($developer->email)->send(new ConfirmationMail($developer, $verificationUrl));
    
        return view('auth.check-your-email');
    }
    


    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle user login
    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $developer = Developer::where('email', $request->email)->first();

        if ($developer && Hash::check($request->password, $developer->password)) {
            session(['developer_id' => $developer->id]);
            return redirect()->route('profile');  // Redirect to the profile page
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Handle forgot password
    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Generate password reset link
        $status = Password::sendResetLink(['email' => $request->email]);

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', 'We have emailed your password reset link!')
                    : back()->withErrors(['email' => 'No account found with that email.']);
    }

    // Show profile page
    public function showProfile()
    {
        $developer = Developer::find(session('developer_id'));  // Retrieve the logged-in user
        return view('auth.profile', compact('developer'));  // Pass the developer data to the view
    }

    // Update user profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $developer = Developer::find(session('developer_id'));
        $developer->name = $request->name;
        $developer->email = $request->email;

        if ($request->password) {
            $developer->password = Hash::make($request->password);
        }

        $developer->save();

        return redirect()->route('profile')->with('status', 'Profile updated successfully.');
    }
    

    
}

