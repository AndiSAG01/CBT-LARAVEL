<x-admin>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Siswa/i</li>
            </ol>
        </nav>
        <x-pages.card>
            <h1 class="font-semibold font-serif text-center" style="font-size:150%">HASIL UJIAN</h1>
        </x-pages.card>
        <x-pages.card>
            <div class="flex items-center gap-4">
                <!-- PDF Button -->
                <a href="{{ route('siswa.cetak') }}" class="btn btn-danger rounded-sm">
                    PDF <i class="fas fa-file-pdf"></i>
                </a>

                <!-- Search Form -->
                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                    <form action="{{ route('siswa.laporan') }}" method="GET">
                        <div class="flex items-center gap-4">
                            <div class="relative h-10 w-72">
                                <div
                                    class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                    <i class="fas fa-search"></i>
                                </div>
                                <input name="search" type="text" value="{{ request('search') }}"
                                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                    placeholder="Search Nama Siswa/i" />
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ route('siswa.laporan') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <x-Tables.tabel>
                <thead>
                    <tr>
                        <x-Tables.th>
                            Member <i class="fas fa-user-graduate"></i>
                        </x-Tables.th>
                        <x-Tables.th>
                            Kelas <i class="fas fa-graduation-cap"></i>
                        </x-Tables.th>
                        <x-Tables.th>
                            Nomor Handphone <i class="fas fa-phone-alt"></i>
                        </x-Tables.th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $sw)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <img src="{{ Storage::url($sw->image) }}" alt="Guru Image"
                                        class="relative inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                    <div class="flex flex-col">
                                        <p
                                            class="block  text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $sw->name }}
                                        </p>
                                        <p
                                            class="block  text-sm antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
                                            {{ $sw->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <x-Tables.td>
                                {{ $sw->class }}
                            </x-Tables.td>
                            <x-Tables.td>
                                {{ $sw->number_phone }}
                            </x-Tables.td>
                        </tr>
                    @endforeach
                </tbody>
            </x-Tables.tabel>
            <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                    Page {{ $siswa->currentPage() }} of {{ $siswa->lastPage() }}
                </p>
                <div class="flex gap-2">
                    @if ($siswa->onFirstPage())
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                            type="button" disabled>
                            Previous
                        </button>
                    @else
                        <a href="{{ $siswa->previousPageUrl() }}">
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="button">
                                Previous
                            </button>
                        </a>
                    @endif

                    @if ($siswa->hasMorePages())
                        <a href="{{ $siswa->nextPageUrl() }}">
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="button">
                                Next
                            </button>
                        </a>
                    @else
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                            type="button" disabled>
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </x-pages.card>
        </div>
    </x-pages.container>
    </x-student>
