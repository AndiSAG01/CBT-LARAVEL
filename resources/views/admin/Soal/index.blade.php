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

        @include('admin.soal.tabs')
        <x-pages.card>
            <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class="block text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Daftar Soal Ujian <i class="fas fa-book-open"></i>
                            </h5>
                        </div>
                        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                            <a href="{{ route('soal.create') }}">
                                <button
                                    class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <i class="far fa-newspaper"></i>
                                    Add Soal
                                </button>
                            </a>
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
                                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
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
                                Kode <i class="fas fa-code"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Mata Pelajaran <i class="fas fa-book-reader"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Soal Ujian <i class="fas fa-book-open"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Kunci Jawaban <i class="fas fa-key"></i>
                            </x-Tables.th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($soals as $item)
                            <tr>
                                <x-Tables.td>
                                    {{ $item->code }}
                                </x-Tables.td>
                                <x-Tables.td>
                                    {{ $item->kategori->name }}
                                </x-Tables.td>
                                <x-Tables.td>
                                    {!! $item->soal_ujian !!}
                                    <p>
                                        @if ($item->kunci_jawaban == 'A')
                                            <strong>A. {{ $item->kunci_A }}</strong>
                                        @else
                                            A. {{ $item->kunci_A }}
                                        @endif
                                    </p>

                                    <p>
                                        @if ($item->kunci_jawaban == 'B')
                                            <strong>B. {{ $item->kunci_B }}</strong>
                                        @else
                                            B. {{ $item->kunci_B }}
                                        @endif
                                    </p>
                                    <p>
                                        @if ($item->kunci_jawaban == 'C')
                                            <strong>C. {{ $item->kunci_C }}</strong>
                                        @else
                                            C. {{ $item->kunci_C }}
                                        @endif
                                    </p>

                                    <p>
                                        @if ($item->kunci_jawaban == 'D')
                                            <strong>D. {{ $item->kunci_D }}</strong>
                                        @else
                                            D. {{ $item->kunci_D }}
                                        @endif
                                    </p>

                                    <p>
                                        @if ($item->kunci_jawaban == 'E')
                                            <strong>E. {{ $item->kunci_E }}</strong>
                                        @else
                                            E. {{ $item->kunci_E }}
                                        @endif
                                    </p>

                                </x-Tables.td>
                                <x-Tables.td>
                                    {{ $item->kunci_jawaban }}
                                </x-Tables.td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('soal.edit',$item->id) }}">
                                            <button
                                                class="relative h-10 max-h-[40px] bg-primary w-10 max-w-[40px] select-none rounded-lg text-center align-middle text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button">
                                                <i class="fas fa-pen fa-sm"></i>
                                            </button>
                                        </a>
                                        <form id="deleteForm{{ $item->id }}" style="margin-left: 2%;" action="{{ route('soal.destroy', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger rounded-sm" onclick="confirmDelete({{ $item->id }})"><i class="fas fa-trash"></i></button>
                                        </form>                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-Tables.tabel>
                <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                    <p class="block text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        Page {{ $soals->currentPage() }} of {{ $soals->lastPage() }}
                    </p>
                    <div class="flex gap-2">
                        @if ($soals->onFirstPage())
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                                type="button" disabled>
                                Previous
                            </button>
                        @else
                            <a href="{{ $soals->previousPageUrl() }}">
                                <button
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                    type="button">
                                    Previous
                                </button>
                            </a>
                        @endif

                        @if ($soals->hasMorePages())
                            <a href="{{ $soals->nextPageUrl() }}">
                                <button
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                    type="button">
                                    Next
                                </button>
                            </a>
                        @else
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                                type="button" disabled>
                                Next
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Menambahkan paginasi default -->
                <div class="mt-4">
                    {{ $soals->links() }}
                </div>

            </div>
        </x-pages.card>
    </x-pages.container>
</x-admin>
