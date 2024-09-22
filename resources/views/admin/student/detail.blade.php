<x-admin>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Siswa</a></li>
                <li class="breadcrumb-item ">Detail</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $siswa->name }}</li>
            </ol>
        </nav>
        <x-pages.card>
            <div class="row">
                <div class="col-6 col-sm-6">
                    <div
                        class="grid min-h-[140px] w-full place-items-center overflow-x-scroll rounded-lg p-6 lg:overflow-visible">
                        <img class="object-cover object-center rounded-full h-96 w-96"
                            src="{{ Storage::url($siswa->image) }}" alt="nature image" />
                    </div>
                </div>
                <div class="col-6 col-sm-6">
                    <div
                        class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-96">
                        <div class="p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-12 h-12 mb-4 text-gray-900">
                                <path fill-rule="evenodd"
                                    d="M9.315 7.584C12.195 3.883 16.695 1.5 21.75 1.5a.75.75 0 01.75.75c0 5.056-2.383 9.555-6.084 12.436A6.75 6.75 0 019.75 22.5a.75.75 0 01-.75-.75v-4.131A15.838 15.838 0 016.382 15H2.25a.75.75 0 01-.75-.75 6.75 6.75 0 017.815-6.666zM15 6.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"
                                    clip-rule="evenodd"></path>
                                <path
                                    d="M5.26 17.242a.75.75 0 10-.897-1.203 5.243 5.243 0 00-2.05 5.022.75.75 0 00.625.627 5.243 5.243 0 005.022-2.051.75.75 0 10-1.202-.897 3.744 3.744 0 01-3.008 1.51c0-1.23.592-2.323 1.51-3.008z">
                                </path>
                            </svg>
                            <h5
                                class="block mb-2 text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                {{ $siswa->name }}
                            </h5>
                            <h5
                                class="block mb-2 text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                {{ $siswa->email }}
                            </h5>
                            <h5
                                class="block mb-2 text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                {{ $siswa->number_phone }}
                            </h5>
                            <h5
                                class="block mb-2 text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                {{ $siswa->class }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </x-pages.card>
        <x-pages.card>
            <h1 class="mb-4">Hasil Ujian per Kategori</h1>

            <div class="form-group mb-4">
                <label for="category-select">Pilih Kategori:</label>
                <select id="category-select" class="form-control">
                    <option value="">Select a category</option>
                    @foreach ($categories as $id => $kategori)
                        <option value="{{ $id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Jenis Ujian</th>
                            <th>Nilai Ujian</th>
                            <th>Tanggal Ujian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil as $index => $result)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $result->soal->kategori->name }}</td>
                                <td>{{ $result->ujian->category->name }}</td>
                                <td>{{ $nilai }}</td>
                                <td>{{ $result->ujian->tanggal_ujian }}</td>
                                <td>
                                    @if ($result->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($current_time->lessThan($exam_time))
                                    <span class="badge bg-warning text-white">Belum Dimulai</span>
                                @elseif ($current_time->greaterThanOrEqualTo($exam_time))
                                    <span class="badge bg-secondary text-white">Belum Diselesaikan</span>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </x-pages.card>

    </x-pages.container>
  
</x-admin>
