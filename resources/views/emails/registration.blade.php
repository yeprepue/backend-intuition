<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Email</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>
    <p>Thank you for registering with us.</p>
    <p>Please click the following link to activate your account:</p>
    <a href="{{ $activationLink }}">Activate Account</a>
    <p>If you did not register with us, please ignore this email.</p>
</body>
</html>
