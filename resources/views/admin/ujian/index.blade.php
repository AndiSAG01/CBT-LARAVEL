<x-admin>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Manajeman Soal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kelola Soal Ujian</li>
            </ol>
        </nav>

        @include('admin.ujian.tabs')
        <x-pages.card>
            <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Daftar Peserta Ujian <i class="fas fa-address-book"></i>
                            </h5>
                        </div>
                        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                            <a href="{{ route('ujian.create') }}">
                                <button
                                    class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <i class="far fa-newspaper"></i>
                                    Add Peserta Ujian
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                        <form action="{{ route('ujian.index') }}" method="GET" class="flex w-full gap-2 md:w-72">
                            <!-- Search Input -->
                            <div class="relative flex-grow">
                                <div
                                    class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" name="search"
                                    class=" rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                    placeholder="Masukan Tanggal dan Bulan Ujian" value="{{ request('search') }}" />
                            </div>
                    
                            <!-- Search Button -->
                            <button type="submit" class="h-10 px-4 py-2 bg-blue-500 text-white rounded-md">
                                Search
                            </button>
                    
                            <!-- Reset Button -->
                            <a href="{{ route('ujian.index') }}" class="h-10 px-4 py-2 bg-gray-200 text-gray-700 rounded-md">
                                Reset
                            </a>
                        </form>
                    </div>  
                </div>
                <x-Tables.tabel>
                    <thead>
                        <tr>
                            <x-Tables.th>
                                Kelas <i class="fas fa-graduation-cap"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Nama Mata Pelajaran <i class="fas fa-book-reader"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Jenis Ujian <i class="fas fa-book-open"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Waktu Ujian <i class="fas fa-clock"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Durasi Ujian <i class="fas fa-stopwatch"></i>
                            </x-Tables.th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                Action <i class="fas fa-cogs"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ujian as $item)
                            <tr>
                                <x-Tables.td>
                                    {{ $item->kelas }}
                                </x-Tables.td>
                                <x-Tables.td>
                                    {{ $item->kategori->name }}
                                </x-Tables.td>
                                <x-Tables.td>
                                    {{ $item->category->name }}
                                </x-Tables.td>
                                <x-Tables.td>
                                    {{ $item->tanggal_ujian }} | {{ $item->jam_ujian }}
                                </x-Tables.td>
                                <x-Tables.td>
                                    {{ $item->durasi }} Menit
                                </x-Tables.td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <a href="{{ route('ujian.show', ['kategori_id' => $item->kategori_id, 'jam_ujian' => $item->jam_ujian]) }}">
                                        Detail ({{ $item->student_count }} Siswa/i)
                                        <button
                                            class="relative h-10 max-h-[40px] bg-primary w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="button">
                                            <i class="fas fa-eye fa-sm"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-Tables.tabel>
                
                <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        Page {{ $ujian->currentPage() }} of {{ $ujian->lastPage() }}
                    </p>
                    <div class="flex gap-2">
                        @if ($ujian->onFirstPage())
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                                type="button" disabled>
                                Previous
                            </button>
                        @else
                            <a href="{{ $ujian->previousPageUrl() }}">
                                <button
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                    type="button">
                                    Previous
                                </button>
                            </a>
                        @endif

                        @if ($ujian->hasMorePages())
                            <a href="{{ $ujian->nextPageUrl() }}">
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
            </div>
        </x-pages.card>
    </x-pages.container>
</x-admin>
