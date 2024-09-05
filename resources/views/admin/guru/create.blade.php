<!-- Trigger the modal with a button -->
<button
    class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    type="button" data-toggle="modal" data-target="#myModal">
    <i class="fas fa-user-plus"></i>
    Pengajar
</button>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="container py-2">
                <x-card>
                    <span class="text-danger font-semibold uppercase">PERINGATAN!!!</span>
                    <p class="font-normal text-white font-serif uppercase text-balance text-center">Pastikan Informasi
                        Data
                        Guru Di input dengan <span class="text-success">benar</span> untuk memastikan tidak terjadi
                        <span class="text-danger">kesalahan</span> informasi.
                    </p>
                </x-card>
            </div>
            <div class="modal-body">
                <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default bg-danger text-white" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
