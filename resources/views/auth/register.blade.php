@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name <i class="fas fa-file-signature"></i></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="NIK">No Handphone <i class="fas fa-phone-alt"></i></label>
                                    <input type="text" class="form-control" id="NIK" name="NIK" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Foto <i class="fas fa-image"></i></label>
                                    <input type="file" class="form-control" id="image" name="image" required>
                                </div>
                            </div>
                            <div class="col-6 col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email <i class="fas fa-envelope"></i></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <i class="fas fa-key"></i></label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="Position">Posisi <i class="fas fa-arrows-alt"></i></label>
                                    <input type="text" class="form-control" id="Position" name="Position" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
