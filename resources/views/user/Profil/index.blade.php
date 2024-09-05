<x-student>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('pages') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </nav>
        <x-pages.card>
            <div class="row">
                <div class="col-sm-6">
                    <div class="grid min-h-[140px] w-full place-items-center overflow-x-scroll rounded-lg p-6 lg:overflow-visible">
                        <img
                          class="object-cover object-center rounded-full h-96 w-96"
                          src="{{ Storage::url($siswa->image) }}"
                          alt="nature image"
                        />
                      </div>
                </div>
                <div class="col-sm-6">
                    <x-pages.card>
                        <div class="p-2">
                            <h1 class="text-2xl font-bold">Data Siswa</h1>
                            <p class="text-gray-600">{{ $siswa->name }}</p>
                            <p class="text-gray-600">{{ $siswa->class }}</p>
                        </div>
                        <div class="p-2">
                            <h2 class="text-xl font-bold">Contact Information</h2>
                            <p class="text-gray-600">{{ $siswa->number_phone }}</p>
                            <p class="text-gray-600">{{ $siswa->email }}</p>
                        </div>
                        <a href="{{ route('profil.edit',$siswa->id) }}" style="margin-left: 75%" class="btn btn-primary">Update Profil</a>
                    </x-pages.card>
                    <x-pages.card>
                        <form action="{{ route('profil.updatepassword') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="p-2">
                                <h1 class="text-2xl font-bold">Form Ubah Password</h1>
                                <label for="new-password">Password Baru</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="new_password" id="new-password" class="form-control" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggle-new-password" onclick="togglePassword('new-password', 'toggle-new-password')">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <label for="confirm-password" class="mt-3">Konfirmasi Password Baru</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="new_password_confirmation" id="confirm-password" class="form-control" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggle-confirm-password" onclick="togglePassword('confirm-password', 'toggle-confirm-password')">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" style="margin-left: 70%" type="submit">Update Password</button>
                        </form>
                       
                    </x-pages.card>
                </div>
            </div>
        </x-pages.card>
    </x-pages.container>
    <script>
        function togglePassword(inputId, toggleButtonId) {
            var input = document.getElementById(inputId);
            var toggleButton = document.getElementById(toggleButtonId);
            var icon = toggleButton.querySelector('i');
    
            if (input.type === "password") {
                input.type = "text";
                icon.classList.add('fa-eye');
                icon.classList.remove('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.add('fa-eye-slash');
                icon.classList.remove('fa-eye');
            }
        }
    </script>
</x-student>
