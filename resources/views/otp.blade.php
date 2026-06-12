<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Code</title>
</head>
<body style="font-family: Arial; background:#f5f5f5; padding:20px;">

    <div style="max-width:500px;margin:auto;background:#fff;padding:20px;border-radius:10px;text-align:center;">

        <!-- Logo -->
        <img src="{{ asset('images/logo.png') }}" alt="Rafiq Logo" style="width:120px;margin-bottom:20px;">

        <h2>Hello!</h2>

        <p>Your OTP is:</p>

        <h1 style="letter-spacing:5px;color:#2d89ef;">
            {{ $otp }}
        </h1>

        <p>This code expires in 5 minutes.</p>

        <hr>

        <small>Regards,<br>Rafiq Team</small>
    </div>

</body>
</html>