<x-admin>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Manajeman soal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kategori soal</li>
            </ol>
        </nav>

        @include('admin.soal.tabs')
        <x-pages.card>
            <div class="flex items-center justify-between gap-8 mb-8">
                <div>
                    <h5
                        class="block  text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    </h5>
                </div>
                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                    @include('admin.kategori.create')
                </div>
            </div>
                    
            <h2 class="font-serif mt-2 text-center font-semibold uppercase">Kategori Mata Pelajaran</h2>
            <x-Tables.tabel>
                <thead>
                    <tr>
                        <x-Tables.th>
                            Nama Mata Pelajaran <i class="fas fa-book-reader"></i>
                        </x-Tables.th>
                        <x-Tables.th>
                            action <i class="fas fa-cogs"></i>
                        </x-Tables.th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $item)
                        <tr>
                            <x-Tables.td>
                                {{ $item->name }}
                            </x-Tables.td>
                            <x-Tables.td>
                                <div class="d-flex align-items-center">
                                    @include('admin.kategori.edit')
                                    <form id="deleteForm{{ $item->id }}" style="margin-left: 2%;" action="{{ route('kategori.destroy', $item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger rounded-sm" onclick="confirmDelete({{ $item->id }})"><i class="fas fa-trash"></i></button>
                                    </form>    
                                </div>
                            </x-Tables.td>
                        </tr>
                    @endforeach
                </tbody>
            </x-Tables.tabel>
            <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                <p class="block  text-sm antialiased font-normal leading-normal text-blue-gray-900">
                    Page {{ $kategori->currentPage() }} of {{ $kategori->lastPage() }}
                </p>
                <div class="flex gap-2">
                    @if ($kategori->onFirstPage())
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                            type="button" disabled>
                            Previous
                        </button>
                    @else
                        <a href="{{ $kategori->previousPageUrl() }}">
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="button">
                                Previous
                            </button>
                        </a>
                    @endif

                    @if ($kategori->hasMorePages())
                        <a href="{{ $kategori->nextPageUrl() }}">
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="button">
                                Next
                            </button>
                        </a>
                    @else
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                            type="button" disabled>
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </x-pages.card>
    </x-pages.container>
</x-admin>
