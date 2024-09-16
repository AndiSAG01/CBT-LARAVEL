<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    h5 {
        font-size: 90%;
        font-family: 'Times New Roman', Times, serif;
    }
</style>

<body style="background-image: url(/assets/images/foto3.png); background-size: cover; background-position: center;">
    <nav class="navbar bg-primary navbar-expand-lg shadow-sm navbar-custom">
        <div class="container">
            <h1 class="text-white" style="font-family: 'Times New Roman', Times, serif;"><b>Bimbel</b></h1>
            <marquee style="font-family:'Times New Roman', Times, serif;" class="text-white"><b>
                <h1 class="d-none d-md-block">Selamat Datang Di Bimbel Kota Jambi</h1></b>
            </marquee>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar Section -->
            <div class="col-12 col-md-3 mb-3">
                <div class="card" style="background-color: rgb(241, 241, 241)">
                    <div class="card-header bg-primary">
                        <h5 class="text-white"><i class="fas fa-home"></i><b> COMPUTER BASED TEST BIMBEL</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p><a href="{{ route('login.siswa') }}" class="btn btn-primary rounded"><i
                                            class="fas fa-user-graduate"></i> Login Siswa</a></p>
                                <p><a href="{{ route('login') }}" class="btn btn-primary rounded"><i
                                            class="fas fa-chalkboard-teacher"></i> Login Guru</a></p>
                            </div>
                            <div class="col-6">
                                <img src="/assets/images/foto4.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3" style="background-color: rgb(241, 241, 241)">
                    <div class="card-header bg-primary">
                        <h5 class="text-white"><i class="fas fa-hotel"></i><b> CS BIMBEL</b></h5>
                    </div>
                    <div class="card-body">
                        <p>Jika terdapat kendala pada saat mengakses siakad, Hubungi WA berikut.</p>
                        <p>
                        <h5><a href="#" class="btn btn-primary"><i class="fab fa-whatsapp"></i> CS BIMBEL</a></h5>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Main Content Section -->
            @php
                $tanggal = \Carbon\Carbon::now()->format('Y-M-d');
            @endphp
            <div class="col-12 col-md-9">
                <div class="card mb-3">
                    <div class="card-header">
                        Panduan Login Siswa Baru
                        <p>{{ $tanggal }} | <i class="fas fa-user-tie"></i> Administrator</p>
                        <hr>
                        <span>Untuk Melakukan Registrasi Siswa/i, bisa di klik pada link berikut : <a
                                href="{{ route('regis.siswa') }}">Daftar Disini</a></span>
                    </div>
                    <div class="card-body text-center">
                        <img src="/assets/images/foto1.png" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Panduan Login Siswa Baru
                        <p>{{ $tanggal }} | <i class="fas fa-user-tie"></i> Administrator</p>
                        <hr>
                        <span>Untuk Melakukan Registrasi Siswa/i, bisa di klik pada link berikut : <a
                                href="{{ route('regis.siswa') }}">Daftar Disini</a></span>
                    </div>
                    <div class="card-body text-center">
                        <img src="/assets/images/foto2.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/be87c3e44a.js" crossorigin="anonymous"></script>

</html>
