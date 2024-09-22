<x-admin>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('CategoryExam.index') }}">Manajeman Peserta Ujian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jenis Ujian</li>
            </ol>
        </nav>

        @include('admin.ujian.tabs')
        <x-pages.card>
            <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class=
                                "block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Daftar Jenis Ujian <i class="fas fa-book-reader"></i> 
                            </h5>
                        </div>
                       @include('admin.jenis-ujian.create')
                    </div>
                    
                </div>
                <x-Tables.tabel>
                    <thead>
                        <tr>
                            <x-Tables.th>
                                <div class="text-center">
                                    Nama Jenis Ujian <i class="fas fa-book-reader"></i>
                                </div>
                            </x-Tables.th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                Action <i class="fas fa-cogs"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorys as $item)
                            <tr>
                                <x-Tables.td>
                                    <div class="text-center">
                                        {{ $item->name }}
                                    </div>
                                </x-Tables.td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="d-flex align-items-center">
                                       @include('admin.jenis-ujian.edit')
                                        <form id="deleteForm{{ $item->id }}" style="margin-left: 2%;" action="{{ route('CategoryExam.destroy', $item->id) }}" method="POST" enctype="multipart/form-data">
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
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        Page {{ $categorys->currentPage() }} of {{ $categorys->lastPage() }}
                    </p>
                    <div class="flex gap-2">
                        @if ($categorys->onFirstPage())
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                                type="button" disabled>
                                Previous
                            </button>
                        @else
                            <a href="{{ $categorys->previousPageUrl() }}">
                                <button
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                    type="button">
                                    Previous
                                </button>
                            </a>
                        @endif

                        @if ($categorys->hasMorePages())
                            <a href="{{ $categorys->nextPageUrl() }}">
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

                <!-- Menambahkan paginasi default -->
                <div class="mt-4">
                    {{ $categorys->links() }}
                </div>

            </div>
        </x-pages.card>
    </x-pages.container>
</x-admin>
