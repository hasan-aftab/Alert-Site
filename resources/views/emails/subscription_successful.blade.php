<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5;">
    <div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 40px 20px; border: 1px solid #eaeaea; border-radius: 10px; text-align: center;">
        <!-- Logo -->
        <img src="{{ asset('asset/frontend/test/images/trackrak-logo.png') }}" alt="TrackRak Logo" style="margin: auto; display: block; padding: 15px 0; width: 125px; height: auto;" />

        <!-- Content -->
        <h1 style="margin: 10px 0 15px; font-size: 28px; line-height: normal; text-align: center;">Subscription Successful!</h1>

        <p style="margin: 0 0 10px; font-size: 16px; text-align: center; line-height: normal;">You are signed up for our {{ ucfirst($plan->title) }} Plan.</p>

        <p style="margin: 0 0 10px; font-size: 16px; text-align: center; line-height: normal;">You can now set up your alerts so you never miss out on savings again!</p>

        <a href="{{ route('track') }}" style="background-color: #95bb3c; padding: 7px 20px; border-radius: 50px; font-size: 25px; font-weight: bolder; color: #000000 !important; text-decoration: none; display: inline-block; margin: 20px 0; line-height: normal;border: solid 2px black;font-family: sans-serif;s">Start Tracking</a>

        <p style="margin: 0 0 10px; font-size: 16px; text-align: center; line-height: normal;"><strong>TrackRak & Get More Money Back</strong></p>

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
