<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pengisian Formulir</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">

        <h1>Notifikasi Pengisian Formulir Website ARIMA</h1>

        <p>Halo ARIMA,</p>

        <p>Anda menerima notifikasi bahwa seorang pengguna telah mengisi formulir.</p>

        <p>Berikut adalah detail yang diberikan oleh pengguna:</p>
        <ul>
            <li><strong>Nama:</strong> {{ $formData['name'] }}</li>
            <li><strong>Email:</strong> {{ $formData['email'] }}</li>
        </ul>

        <p><strong>Pesan:</strong></p>
        <p>{{ $formData['message'] }}</p>

        <p>Segera tinjau formulir yang diisi dan tindak lanjuti sesuai kebijakan perusahaan.</p>

        <p>Terima kasih atas perhatiannya.</p>

        <p>Hormat Kami,</p>
        <p>[ARIMA]</p>

    </div>

</body>

</html>