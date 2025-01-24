<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        body { background-color: #f0f0f0; font-family: Arial, sans-serif; }
        .container { max-width: 400px; margin: 50px auto; padding: 20px; background-color: white; border-radius: 10px; }
        button { background-color: #4CAF50; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form method="POST" action="{{ url('signup') }}">
            @csrf
            <input type="text" name="name" placeholder="Your Name" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>
            <button type="submit">Sign Up</button>
        </form>
        <br>
        <a href="{{ route('login') }}">Already have an account? Login</a>
        <br>
        <a href="{{ route('forgot-password') }}">Forgot Password?</a>
    </div>
</body>
</html>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

