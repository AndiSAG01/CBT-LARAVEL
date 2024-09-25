<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report_title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 12px;
        }

        .table th,
        .table td {
            padding: 5px;
            border: 1px solid #000;
        }

        .card-header.header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header .logo {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
        }

        .card-header .title {
            flex-grow: 1;
            text-align: center;
        }

        .card-header .title h2,
        .card-header .title h4,
        .card-header .title p {
            margin: 0;
        }

        .card-body .signature {
            margin-top: 40px;
            text-align: right;
        }

        .card-body .signature p {
            margin-bottom: 60px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header header">
                <div class="logo">
                    <!-- Correct file path for the logo -->
                    <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo" width="100%" height="100%">
                </div>
                <div class="title">
                    <h2>{{ $school_name }}</h2>
                    <h4>{{ $report_title }}</h4>
                    <p>Jl. RB. Siagian No.19, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129, No.Telpon:
                        0852-6893-9186</p>
                    <p>{{ $report_date }}</p>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" style="width: 100%; margin-top: 20px;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Member</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Nomor Handphone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $sw)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Use absolute path for the image stored in storage -->
                                        <img src="{{ storage_path('app/public/' . $sw->image) }}" alt="Student Image"
                                             class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;" />
                                        <div>
                                            <p class="mb-0 fw-bold">{{ $sw->name }}</p>
                                            <p class="mb-0 text-muted">{{ $sw->email }}</p>
                                        </div>
                                    </div>                                    
                                </td>
                                <td>{{ $sw->class }}</td>
                                <td>{{ $sw->number_phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="signature">
                    <p>Kota Jambi, {{ date('d-m-Y') }}</p>
                    <p>Admin</p>
                    <br><br><br><br>
                    <p><b>_________________________</b></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
