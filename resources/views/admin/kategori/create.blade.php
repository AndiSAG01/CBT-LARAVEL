<!-- Trigger the modal with a button -->
<button
    class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    type="button" data-toggle="modal" data-target="#myModal">
    <i class="fas fa-plus"></i>
    Kategori Soal
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
                        Data Kategori Soal Di input dengan <span class="text-success">benar</span> untuk memastikan tidak terjadi
                        <span class="text-danger">kesalahan</span> informasi.
                    </p>
                </x-card>
            </div>
            <div class="modal-body">
                <form action="{{ route('kategori.store') }}" method="post">
                    @csrf
                    <input type="text" name="user_id" value="{{ $user }}" hidden>
                    <div class="form-group">
                        <label for="my-input">Nama Kategori Mata Pelajaran <i class="fas fa-book-reader"></i></label>
                        <input id="my-input" class="form-control" type="text" name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <x-button>
                        Submit
                    </x-button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default bg-danger text-white" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
