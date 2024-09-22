<x-student>
    <x-pages.container>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark">
                <li class="breadcrumb-item"><a href="{{ route('pages') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Halaman Hasil Ujian</li>
            </ol>
        </nav>
        <x-pages.card>
            <h1 class="font-semibold font-serif text-center" style="font-size:150%">HASIL UJIAN</h1>
        </x-pages.card>
        <x-pages.card>
            <x-Tables.tabel>
                <thead>
                    <x-Tables.th>No</x-Tables.th>
                    <x-Tables.th>Mata Pelajaran</x-Tables.th>
                    <x-Tables.th>Tanggal Ujian</x-Tables.th>
                    <x-Tables.th>Jam</x-Tables.th>
                    <x-Tables.th>Benar</x-Tables.th>
                    <x-Tables.th>Salah</x-Tables.th>
                    <x-Tables.th>Nilai</x-Tables.th>
                    <x-Tables.th>Action</x-Tables.th>
                </thead>
                <tbody>
                    @foreach ($hasil as $no => $group)
                        @php
                            // Menghitung jumlah jawaban benar dan salah dalam grup
                            $correct = $group->filter(function($item) {
                                return $item->answer === $item->soal->kunci_jawaban; // Jawaban benar
                            })->count();
            
                            $incorrect = $group->count() - $correct; // Jawaban salah = total - benar
            
                            // Mengambil data dari item pertama dalam grup untuk menampilkan data umum
                            $firstItem = $group->first();
            
                            // Menghitung nilai dengan asumsi setiap jawaban benar bernilai 10 poin
                            $nilai = $correct * 10;
                        @endphp
                        <tr>
                            <x-Tables.td>{{ $loop->iteration }}</x-Tables.td>
                            <x-Tables.td>{{ $firstItem->soal->kategori->name }}</x-Tables.td>
                            <x-Tables.td>{{ optional($firstItem->ujian)->tanggal_ujian }}</x-Tables.td>
                            <x-Tables.td>{{ optional($firstItem->ujian)->jam_ujian }}</x-Tables.td>
                            <x-Tables.td>{{ $correct }}</x-Tables.td>
                            <x-Tables.td>{{ $incorrect }}</x-Tables.td>
                            <x-Tables.td>{{ $nilai }}</x-Tables.td>
                            <x-Tables.td>
                                <a href="{{ route('hasil.show', $group->first()->id) }}" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md">
                                    Lihat Detail
                                 </a>
                            </x-Tables.td>

                        </tr>
                    @endforeach
                </tbody>
            </x-Tables.tabel>
            
            
            <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                    Page {{ $hasil->currentPage() }} of {{ $hasil->lastPage() }}
                </p>
                <div class="flex gap-2">
                    @if ($hasil->onFirstPage())
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                            type="button" disabled>
                            Previous
                        </button>
                    @else
                        <a href="{{ $hasil->previousPageUrl() }}">
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="button">
                                Previous
                            </button>
                        </a>
                    @endif

                    @if ($hasil->hasMorePages())
                        <a href="{{ $hasil->nextPageUrl() }}">
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