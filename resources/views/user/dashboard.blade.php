<x-student>
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
                    <li><strong>Jadwal Ujian:</strong>
                        <p>1. Di dalam tab <strong>Jadwal Ujian</strong>, Anda akan menemukan daftar ujian yang telah
                            didaftarkan oleh administrator. Ujian-ujian ini adalah ujian yang Anda berhak untuk
                            melaksanakan.</p>
                        <p>2. Jika Anda tidak menemukan jadwal ujian yang diharapkan, segera hubungi administrator untuk
                            informasi lebih lanjut.</p>
                        <p>3. Pastikan untuk mengecek jadwal secara berkala dan persiapkan diri Anda sebelum waktu ujian
                            dimulai. Ketika waktu ujian telah tiba, klik tombol <strong>Mulai</strong> untuk memulai
                            ujian.</p>
                    </li>
                    <li><strong>Hasil Ujian:</strong>
                        <p>1. Setelah menyelesaikan ujian, Anda dapat melihat hasil ujian Anda pada tab <strong>Hasil
                                Ujian</strong>.</p>
                        <p>2. Hasil yang ditampilkan akan mencakup skor ujian serta informasi tambahan lainnya sesuai
                            kebijakan yang ditetapkan oleh administrator.</p>
                        <p>3. Pastikan untuk mereview hasil tersebut dan memahami kesalahan yang mungkin terjadi agar
                            dapat memperbaiki performa Anda di ujian selanjutnya.</p>
                    </li>
                </ol>
            </div>
        </div>

    </x-pages.container>
</x-student>