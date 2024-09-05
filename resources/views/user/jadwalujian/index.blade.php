<x-student>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('pages') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Halaman Jadwal Ujian</li>
            </ol>
        </nav>
        <x-pages.card>
            @php
                $waktu = Carbon\Carbon::now()->format('d F Y, H:i');
            @endphp
            <h2 class="font-semibold font-serif">Jadwal Ujian | {{ $waktu }} </h2>
        </x-pages.card>
        <x-pages.card>
            <x-Tables.tabel>
                <thead>
                    <x-Tables.th>
                        No
                    </x-Tables.th>
                    <x-Tables.th>
                        Mata Pelajaran
                    </x-Tables.th>
                    <x-Tables.th>
                        Waktu Ujian
                    </x-Tables.th>
                    <x-Tables.th>
                        Durasi
                    </x-Tables.th>
                    <x-Tables.th>
                        Jenis Ujian
                    </x-Tables.th>
                    <x-Tables.th>
                        Status
                    </x-Tables.th>
                    <x-Tables.th>
                        Action
                    </x-Tables.th>
                </thead>
                <tbody>
                    @foreach ($jadwal as $no => $item)
                        <tr>
                            <x-Tables.td>
                                {{ ++$no }}
                            </x-Tables.td>
                            <x-Tables.td>
                                {{ $item->kategori->name }}
                            </x-Tables.td>
                            <x-Tables.td>
                               {{ $item->tanggal_ujian }} | {{ $item->jam_ujian }}
                            </x-Tables.td>
                            <x-Tables.td>
                                {{ $item->durasi }} Menit
                            </x-Tables.td>
                            <x-Tables.td>
                                {{ $item->category->name }}
                            </x-Tables.td>
                            <x-Tables.td>
                                @php
                                    $current_time = Carbon\Carbon::now();
                                    $exam_time = Carbon\Carbon::parse($item->tanggal_ujian . ' ' . $item->jam_ujian);
                                @endphp
                            
                                @if ($item->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif ($current_time->lessThan($exam_time))
                                    <span class="badge bg-warning text-white">Belum Dimulai</span>
                                @elseif ($current_time->greaterThanOrEqualTo($exam_time))
                                    <span class="badge bg-secondary text-white">Belum Diselesaikan</span>
                                @endif
                            </x-Tables.td>
                            
                            <x-Tables.td>
                                @if ($item->status == 'Selesai')
                                    <button class="btn btn-success" disabled>Selesai</button>
                                @elseif ($current_time->lessThan($exam_time))
                                    <button class="btn btn-warning" disabled>Belum Dimulai</button>
                                @elseif ($current_time->greaterThanOrEqualTo($exam_time))
                                    <a href="{{ route('exam.index', $item->id) }}">
                                        <button class="btn btn-info">Kerjakan Soal</button>
                                    </a>
                                @endif
                            </x-Tables.td>
                                                          
                        </tr>
                    @endforeach
                </tbody>
                
            </x-Tables.tabel>
            <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                    Page {{ $jadwal->currentPage() }} of {{ $jadwal->lastPage() }}
                </p>
                <div class="flex gap-2">
                    @if ($jadwal->onFirstPage())
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                            type="button" disabled>
                            Previous
                        </button>
                    @else
                        <a href="{{ $jadwal->previousPageUrl() }}">
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="button">
                                Previous
                            </button>
                        </a>
                    @endif

                    @if ($jadwal->hasMorePages())
                        <a href="{{ $jadwal->nextPageUrl() }}">
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
