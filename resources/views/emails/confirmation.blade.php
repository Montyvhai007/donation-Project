<!DOCTYPE html>
<html>
<head>
    <title>Email Confirmation</title>
</head>
<body>
    <h1>Welcome, {{ $name }}!</h1>
    <p>Thank you for signing up. Please click the link below to confirm your email:</p>
    <a href="{{ $confirmationUrl }}">Confirm Email</a>
</body>
</html>
