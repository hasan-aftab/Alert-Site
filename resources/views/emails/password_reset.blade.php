<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5;">
    <div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 40px 20px; border: 1px solid #eaeaea; border-radius: 10px; text-align: center;">
        <!-- Logo -->
        <img src="{{ asset('asset/frontend/test/images/trackrak-logo.png') }}" alt="TrackRak Logo" style="margin: auto; display: block; padding: 15px 0; width: 125px; height: auto;" />

        <h1 style="margin: 10px 0 15px; font-size: 28px; line-height: normal; text-align: center;">Reset Password</h1>

        <a href="{{ $resetUrl }}" style="background-color: #95bb3c; padding: 7px 20px; border-radius: 50px; font-size: 25px; font-weight: bolder; color: #000000 !important; text-decoration: none; display: inline-block; margin: 20px 0; line-height: normal;border: solid 2px black;font-family: sans-serif;s">Reset Password</a>

        <p style="margin: 0 0 10px; font-size: 16px; text-align: center; line-height: normal;">Or click here: <a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>

        <p style="margin: 0 0 10px; font-size: 16px; text-align: center; line-height: normal;">If you did not request a password reset, no further action is required.</p>

        <p style="margin: 0 0 10px; font-size: 16px; text-align: center; line-height: normal;"><strong style="color: #555;">TrackRak & Get More Money Back</strong></p>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 20px; font-size: 14px; color: #555;">
            <p style="font-size: 14px; margin: 0 0 5px; line-height: normal; text-align: center;">&copy; {{ date('Y') }} TrackRak, All Rights Reserved</p>
            <p style="font-size: 14px; margin: 0 0 5px; line-height: normal; text-align: center;">
                <a href="{{ url('/terms-and-conditions') }}" style="color: #555; text-decoration: none; text-align: center;">Terms & Conditions</a> |
                <a href="{{ url('/privacy-policy') }}" style="color: #555; text-decoration: none; text-align: center;">Privacy Policy</a>
            </p>
        </div>
    </div>
</body>
</html>
