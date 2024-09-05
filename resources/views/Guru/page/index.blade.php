<x-admin>
    <x-pages.container>
        <x-pages.card>
            <h3 class="font-serif font-semibold">Selamat Datang, {{ $user->name }}</h3>
        </x-pages.card>
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Petunjuk Penggunaan Ujian Online</h4>
            </div>
            <div class="card-body">
                <ol>
                    <li><strong>Manajeman Soal:</strong>
                        <p>1. Di dalam tab <strong>Manajeman Soal</strong>, Anda akan menemukan Kategori Soal dan Kelola Soal Ujian Yang di mana anda bisa membuat dan mengatur isi dari soal.</p>
                        <p>2. Jika Anda tidak menemukan Kendala , segera hubungi administrator untuk
                            informasi lebih lanjut.</p>
                        <p>3. Pastikan untuk mengecek jadwal secara berkala dan Informasi Jadwal Ujian Agar tidak Terjadi Miss Komunikasi.</p>
                    </li>
                    <li><strong>Manajeman Peserta Ujian:</strong>
                        <p>1. Setelah menyelesaikan Soal ujian, Anda Bisa Memilih Siswa/i yang boleh untuk mengikuti ujian.</p>
                        <p>2. Pastikan Anda Memilih Siswa/i dengan benar agar tidak terjadi kesalahan dalam pemberian jadwal ujian.</p>
                        <p>3. Pastikan untuk mereview Kembali Peserta Ujian Apakah Sudah <strong>Benar</strong>  atau <strong>Tidak</strong></p>
                    </li>
                    <li><strong>Hasil Ujian:</strong>
                        <p>1. Setelah menyelesaikan ujian, Anda dapat melihat hasil ujian Anda pada tab <strong>Hasil Ujian</strong>.</p>
                        <p>2. Hasil yang ditampilkan akan mencakup skor ujian serta informasi tambahan lainnya sesuai kebijakan yang ditetapkan oleh administrator.</p>
                        <p>3. Pastikan untuk mereview hasil tersebut dan memahami kesalahan yang mungkin terjadi agar dapat memperbaiki performa Anda di ujian selanjutnya.</p>
                    </li>
                </ol>
            </div>
        </div>

    </x-pages.container>
</x-admin>
