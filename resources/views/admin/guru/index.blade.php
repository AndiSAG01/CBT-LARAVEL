<x-admin>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pengajar</li>
            </ol>
        </nav>
        <x-pages.card>
            <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class="block  text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Daftar Pengajar <i class="fas fa-user-tie"></i>
                            </h5>
                        </div>
                        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                            @include('admin.guru.create')
                        </div>
                    </div>
                    <form action="{{ route('guru') }}" method="GET">
                        <div class="flex items-center gap-4">
                            <div class="relative h-10 w-72">
                                <div class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                    <i class="fas fa-search"></i>
                                </div>
                                <input
                                    name="search"
                                    type="text"
                                    value="{{ request('search') }}"
                                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9  text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                    placeholder="Search" />
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ route('guru') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>                    
                </div>
                <x-Tables.tabel>
                    <thead>
                        <tr>
                            <x-Tables.th>
                                Member <i class="fas fa-user-tie"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                Posisi <i class="fas fa-arrows-alt"></i>
                            </x-Tables.th>
                            <x-Tables.th>
                                No Handphone <i class="fas fa-phone-alt"></i>
                            </x-Tables.th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gurus as $guru)
                            <tr>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ Storage::url($guru->image) }}" alt="Guru Image"
                                            class="relative inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                        <div class="flex flex-col">
                                            <p
                                                class="block  text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                                {{ $guru->name }}
                                            </p>
                                            <p
                                                class="block  text-sm antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
                                                {{ $guru->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <x-Tables.td>
                                    {{ $guru->Position }}
                                </x-Tables.td>
                                <x-Tables.td>
                                    {{ $guru->NIK }}
                                </x-Tables.td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('guru.edit', $guru->id) }}">
                                            <button
                                                class=" bg-primary relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle  text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button">
                                                <i class="fas fa-pen fa-sm"></i>
                                            </button>
                                        </a>
                                        <form id="deleteForm{{ $guru->id }}" style="margin-left: 2%;"
                                            action="{{ route('guru.destroy', $guru->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger rounded-sm"
                                                onclick="confirmDelete({{ $guru->id }})"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-Tables.tabel>
                <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                    <p class="block  text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        Page {{ $gurus->currentPage() }} of {{ $gurus->lastPage() }}
                    </p>
                    <div class="flex gap-2">
                        @if ($gurus->onFirstPage())
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                                type="button" disabled>
                                Previous
                            </button>
                        @else
                            <a href="{{ $gurus->previousPageUrl() }}">
                                <button
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                    type="button">
                                    Previous
                                </button>
                            </a>
                        @endif

                        @if ($gurus->hasMorePages())
                            <a href="{{ $gurus->nextPageUrl() }}">
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
            </div>
        </x-pages.card>
    </x-pages.container>
</x-admin>
