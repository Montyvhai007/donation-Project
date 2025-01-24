<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { background-color: #f0f0f0; font-family: Arial, sans-serif; }
        .container { max-width: 400px; margin: 50px auto; padding: 20px; background-color: white; border-radius: 10px; }
        button { background-color: #4CAF50; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="{{ url('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit">Login</button>
        </form>
        <br>
        <a href="{{ route('signup') }}">Don't have an account? Sign Up</a>
        <br>
        <a href="{{ route('forgot-password') }}">Forgot Password?</a>
    </div>
</body>
</html>
