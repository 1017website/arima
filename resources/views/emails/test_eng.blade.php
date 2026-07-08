<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARIMA</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">

        <h1>Message from ARIMA Website</h1>

        <p>Dear {{ $formData['name'] }},</p>

        <p>We have received your inquiry. Thank you for contacting us.</p>

        <p>Here are the details you provided:</p>
        <ul>
            <li><strong>Name:</strong> {{ $formData['name'] }}</li>
            <li><strong>Email:</strong> {{ $formData['email'] }}</li>
        </ul>

        <p><strong>Message:</strong></p>
        <p>{{ $formData['message'] }}</p>

        <p>We will review your message and will get back to you shortly.</p>

        <p>Thank you for your interest in our company.</p>

        <p>Best Regards,</p>
        <p>[ARIMA]</p>

    </div>

</body>

</html>
