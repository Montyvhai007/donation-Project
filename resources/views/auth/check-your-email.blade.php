<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Your Email</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #FF9800;
        }
        p {
            color: #333;
        }
        a {
            display: inline-block;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Check Your Email</h1>
        <p>We have sent you an email with a confirmation link. Please check your inbox and click the link to confirm your email.</p>
        <a href="{{ route('login') }}">Back to Login</a>
    </div>
</body>
</html>
