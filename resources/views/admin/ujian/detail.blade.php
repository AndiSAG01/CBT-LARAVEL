<x-admin>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Manajeman Soal</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Kelola Peserta Ujian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </nav>

        <x-pages.card>
            <div
                class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Daftar Peserta Ujian <i class="fas fa-address-book"></i>
                            </h5>
                        </div>

                    </div>
                </div>
                <x-Tables.tabel>
                    <thead>
                        <tr>
                            <x-Tables.th>
                                Nama Siswa <i class="fas fa-file-signature"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Status <i class="fas fa-stream"></i>
                            </x-Tables.th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                Action <i class="fas fa-cogs"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                            <tr>
                                <x-Tables.td>{{ $item->siswa->name }}</x-Tables.td>
                                <x-Tables.td>
                                    @php
                                        $current_time = Carbon\Carbon::now();
                                        $exam_start_time = Carbon\Carbon::parse(
                                            $item->tanggal_ujian . ' ' . $item->jam_ujian,
                                        );
                                        $exam_end_time = $exam_start_time->copy()->addMinutes($item->durasi);
                                    @endphp

                                    @if ($item->status == 'Selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif ($current_time->lessThan($exam_start_time))
                                        <span class="badge bg-warning text-white">Belum Dimulai</span>
                                    @elseif ($current_time->greaterThanOrEqualTo($exam_start_time) && $current_time->lessThanOrEqualTo($exam_end_time))
                                        <span class="badge bg-secondary text-white">Belum Diselesaikan</span>
                                    @elseif ($current_time->greaterThan($exam_end_time) && $item->status != 'Selesai')
                                        <span class="badge bg-danger text-white">Terlambat</span>
                                    @endif
                                </x-Tables.td>

                                <td class="p-4 border-b border-blue-gray-50">
                                    @if ($item->status == 'Belum Dimulai')
                                        <div class="d-flex align-items-center">
                                            <form id="deleteForm{{ $item->id }}" style="margin-left: 2%;"
                                                action="{{ route('ujian.delete', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger rounded-sm"
                                                    onclick="confirmDelete({{ $item->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($item->status == 'Selesai')
                                        <button class="btn btn-success" disabled>Selesai</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-Tables.tabel>
                <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        Page {{ $students->currentPage() }} of {{ $students->lastPage() }}
                    </p>
                    <div class="flex gap-2">
                        @if ($students->onFirstPage())
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                                type="button" disabled>
                                Previous
                            </button>
                        @else
                            <a href="{{ $students->previousPageUrl() }}">
                                <button
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                    type="button">
                                    Previous
                                </button>
                            </a>
                        @endif

                        @if ($students->hasMorePages())
                            <a href="{{ $students->nextPageUrl() }}">
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
