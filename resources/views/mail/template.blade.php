<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="alert alert-success" style="background-color: rgb(235, 237, 235); padding:50px;">
        <h1 class="text-center" style="color: green; text-transform:uppercase;">Hallo
            {{ $data['nama_tim'] }} Selamat Datang
            di Website
            <strong>{{ env('APP_NAME') }}</strong>
        </h1>

        <p>Anda tergabung ke website kami dengan data sebagai berikut</p>
        <table class="table">
            <tr>
                <td>Nama</td>
                <td>: {{ $data['nama_tim'] }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $data['jenis_kelamin_tim'] }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $data['alamat_tim'] }}</td>
            </tr>
            <tr>
                <td>Bidang</td>
                <td>: {{ $data['nama_bidang_tim'] }}</td>
            </tr>
            <tr>
                <td>Deskripsi Bidang</td>
                <td>: {{ $data['deskripsi_bidang_tim'] }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ $data['email'] }}</td>
            </tr>
            <tr>
                <td>Password</td>
                <td>: {{ $data['password_ori'] }}</td>
            </tr>
            <tr>
                <td>Level Akun</td>
                <td>: {{ $data['level_user'] }}</td>
            </tr>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
