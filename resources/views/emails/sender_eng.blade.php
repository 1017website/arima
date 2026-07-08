<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Notification</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">

        <h1>Form Submission Notification for ARIMA Website</h1>

        <p>Hi ARIMA,</p>

        <p>You've received a notification that a user has submitted a form.</p>

        <p>Here are the details provided by the user:</p>
        <ul>
            <li><strong>Name:</strong> {{ $formData['name'] }}</li>
            <li><strong>Email:</strong> {{ $formData['email'] }}</li>
        </ul>

        <p><strong>Message:</strong></p>
        <p>{{ $formData['message'] }}</p>

        <p>Please review the submitted form and take appropriate action according to the company's policy.</p>

        <p>Thank you for your attention.</p>

        <p>Best Regards,</p>
        <p>[ARIMA]</p>

    </div>

</body>

</html>