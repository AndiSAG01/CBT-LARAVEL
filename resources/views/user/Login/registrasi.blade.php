<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    body{
        font-family: 'Times New Roman', Times, serif;
    }
</style>

<body style="background-color: rgb(241, 241, 241)">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <h2 class="text-center">
                    <span class="badge bg-primary">REGISTRASI SISWA</span>
                </h2>
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                        class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('regis.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mt-3">
                                    <label class="form-label" for="form1Example13">Nama</label>
                                    <input type="text" name="name" id="form1Example13" class="form-control" />
                                </div>
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mt-3">
                                    <label class="form-label" for="form1Example13">Email</label>
                                    <input type="email" name="email" id="form1Example13" class="form-control" />
                                </div>
                                  <!-- Password input -->
                                  <div data-mdb-input-init class="form-outline mt-3">
                                      <label class="form-label" for="form1Example23">Password</label>
                                    <input type="password" name="password" id="form1Example23" class="form-control" />
                                </div>
                                  <!-- Password input -->
                                  <div data-mdb-input-init class="form-outline mt-3">
                                      <label class="form-label" for="form1Example23">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="form1Example23" class="form-control" />
                                </div>
        
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mt-3">
                                    <label class="form-label" for="form1Example13">Nomor Handphone/Wa</label>
                                    <input type="number" name="number_phone" id="form1Example13" class="form-control" />
                                </div>
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mt-3">
                                    <label class="form-label" for="form1Example13">Foto</label>
                                    <input type="file" name="image" id="form1Example13" class="form-control" />
                                </div>
                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mt-3">
                                    <label class="form-label" for="form1Example13">Kelas</label>
                                    <select class="form-control" name="class" id="">
                                        <option value="">==Pilih Kelas==</option>
                                        <option value="TNI">TNI</option>
                                        <option value="Polri">Polri</option>
                                    </select>
                                </div>
                                <!-- Submit button -->
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-primary btn-lg btn-block mt-3">Register</button>
        
                            </form>
                            <div class="mt-2">
                                <span>Anda Sudah Punya akun?<a href="{{ route('login.siswa') }}">Login Disini</a></span>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
