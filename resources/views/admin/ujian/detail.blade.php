<x-admin>
    <x-pages.container>
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
                    </div>
                    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                        <div class="w-full md:w-72">
                            <div class="relative h-10 w-full min-w-[200px]">
                                <div
                                    class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                        </path>
                                    </svg>
                                </div>
                                <input
                                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                    placeholder=" " />
                                <label
                                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    Search
                                </label>
                            </div>
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
                        @foreach ($ujian as $item)
                            <tr>
                                <x-Tables.td>{{ $item->siswa->name }}</x-Tables.td>
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
                
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="d-flex align-items-center">
                                        @if ($item->status == 'Belum Dimulai')
                                            <a href="{{ route('ujian.edit', $item->id) }}">
                                                <button
                                                    class="relative h-10 max-h-[40px] bg-primary w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                    type="button">
                                                    <i class="fas fa-pen fa-sm"></i>
                                                </button>
                                            </a>
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
                                        @elseif ($item->status == 'Selesai')
                                            <button class="btn btn-success" disabled>Selesai</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-Tables.tabel>
                
                {{-- <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
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
                </div> --}}
            </div>
        </x-pages.card>
    </x-pages.container>
</x-admin>
