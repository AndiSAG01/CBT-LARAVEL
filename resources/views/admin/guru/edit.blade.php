<x-admin>
   <x-pages.container>
    <x-pages.card>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('guru') }}">Guru</a></li>
              <li class="breadcrumb-item">Edit</li>
              <li class="breadcrumb-item active" aria-current="page">{{ $guru->name }}</li>
            </ol>
          </nav>
          <form action="{{ route('guru.update', $guru) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-6 col-sm-6">
                    <img src="{{ Storage::url($guru->image) }}" alt="Guru">
                </div>
                <div class="col-6 col-sm-6">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $guru->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="NIK">NIK</label>
                            <input type="number" class="form-control" id="NIK" name="NIK" value="{{ $guru->NIK }}">
                            @error('NIK')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $guru->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <span class="text-danger font-serif font-normal">* Password Tidak Perlu Anda isi Jika Tidak Ingin Di ubah</span>
                        </div>
                        <div class="form-group">
                            <label for="Position">Posisi</label>
                            <input type="text" class="form-control" id="Position" name="Position" value="{{ $guru->Position }}">
                            @error('Position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Foto</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <span class="text-danger font-serif font-normal">* Foto Tidak Perlu Anda isi Jika Tidak Ingin Di ubah</span>
                        </div>
                        <x-button>
                            submit
                        </x-button>
                    </form>
                </div>
            </div>
          </form>
    </x-pages.card>
   </x-pages.container>
</x-admin>