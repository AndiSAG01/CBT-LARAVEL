<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- SweetAlert2 CSS and JavaScript -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    .countdown-timer {
        font-family: 'Arial', sans-serif;
        font-size: 1.5rem;
        /* Adjust font size as needed */
        font-weight: bold;
        color: #333;
        /* Dark color for better readability */
        background-color: #f8f9fa;
        /* Light background color */
        border: 2px solid #007bff;
        /* Border color matching the primary theme */
        border-radius: 8px;
        /* Rounded corners */
        padding: 10px 15px;
        /* Padding for spacing */
        text-align: center;
        /* Center-align the text */
        width: fit-content;
        /* Adjust width based on content */
        margin: 0 auto;
        /* Center the timer horizontally */
    }

    .question-navigation {
        text-align: center;
        margin-bottom: 20px;
    }

    #status-indicator {
        background-color: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 15px;
    }

    .question-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .question-button {
        width: 40px;
        height: 40px;
        border: 2px solid #007BFF;
        background-color: white;
        border-radius: 5px;
        color: #007BFF;
        font-weight: bold;
        text-align: center;
        line-height: 36px;
        cursor: pointer;
    }

    .question-button.answered {
        background-color: #007BFF;
        color: white;
    }

    .question-button.active {
        background-color: #6c757d;
        color: white;
        border-color: #6c757d;
    }

    .soal-container {
        display: flex;
        align-items: flex-start;
        /* Aligns the content at the top */
        margin-bottom: 15px;
    }

    .soal-number {
        font-weight: bold;
        font-size: 16px;
        margin-right: 10px;
    }

    .soal-content {
        font-size: 14px;
        line-height: 1.5;
    }

    .soal-content img {
        max-width: 70%;
        height: auto;
        margin: 0 auto;
    }

    .form-check-label img {
        max-width: 70%;
        /* Membuat gambar menyesuaikan lebar container */
        height: auto;
        /* Menjaga proporsi gambar */
        margin: 5px 0;
        /* Beri sedikit margin untuk gambar */
    }

    .form-check {
        padding: 5px;
        margin-bottom: 10px;
    }

    #soal-info {
        display: none;
        /* Sembunyikan awalnya */
    }
</style>



<body>
    <!-- Navbar with User Info -->
    <nav class="navbar navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ Storage::url($user->image) }}" class="rounded-circle" alt="User Image" width="40"
                    height="40">
                <span class="text-white">{{ $user->name }}</span>
            </a>
            <span class="text-white"><b>Ujian Daring</b></span>
        </div>
    </nav>

    <!-- Main Container -->
    <x-pages.container>
        <div class="row">
            <div class="col-sm-4 mb-4">
                <x-pages.card>
                    <h5 class="text-center">Waktu Ujian</h5>
                    <div id="countdown" class="countdown-timer text-center h4"></div>
                </x-pages.card>

                <div class="card mt-4">
                    <div class="question-navigation">
                        <h5 class="card-header">Soal yang Sudah Dijawab</h5>
                        <div class="card-body">
                            <div id="answered-questions">
                                <span>Nomor soal yang sudah dijawab:</span>
                                <div class="answered-question-buttons mt-3">
                                    @foreach ($soals as $index => $soal)
                                    <button class="btn btn-outline-primary m-1 question-btn" id="question-btn-{{ $soal->id }}"
                                        data-question-id="{{ $soal->id }}">
                                        {{ $index + 1 }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>

            <!-- Main Content Area with Questions -->
            <div class="col-sm-8">
                <x-pages.card>
                    <form id="examForm" action="{{ route('exam.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
                        <input type="hidden" id="duration" value="{{ $ujian->durasi }}">
                
                        <!-- Loop through each question -->
                        <div id="questionContainer">
                            @foreach ($soals as $index => $soal)
                                @php
                                    $questionNumber = $index + 1;
                                @endphp
                
                                <div class="soal-slide" style="display: {{ $index == 0 ? 'block' : 'none' }};" data-index="{{ $index }}">
                                    <!-- Question Display -->
                                    <div class="soal-container mb-2">
                                        <span class="soal-number">{{ $questionNumber }}.</span>
                                        <div class="soal-content">{!! $soal->soal_ujian !!}</div>
                                    </div>
                
                                    <!-- Answer Options -->
                                    @foreach (['A', 'B', 'C', 'D', 'E'] as $option)
                                        @if (!empty($soal->{'kunci_' . $option}))
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="answers[{{ $soal->id }}]"
                                                    value="{{ $option }}" 
                                                    {{ isset($answeredSoals[$soal->id]) && $answeredSoals[$soal->id] == $option ? 'checked' : '' }}>
                                                <label class="form-check-label">{!! $soal->{'kunci_' . $option} !!}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                
                        <!-- Navigation buttons -->
                        <div class="mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="prevQuestion()" disabled>Previous</button>
                            <button type="button" class="btn btn-secondary" id="nextBtn" onclick="nextQuestion()">Next</button>
                        </div>
                
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3" 
                            onclick="return confirm('Apakah jawaban Anda sudah terisi semua?')">Submit</button>
                    </form>
                </x-pages.card>
            </div>
        </div>
    </x-pages.container>

</body>
<script>
    let currentQuestionIndex = 0;
    const totalQuestions = {{ count($soals) }};

    function showQuestion(index) {
        const slides = document.querySelectorAll('.soal-slide');
        slides.forEach((slide, idx) => {
            slide.style.display = (idx === index) ? 'block' : 'none';
        });

        document.getElementById('prevBtn').disabled = (index === 0);
        document.getElementById('nextBtn').disabled = (index === totalQuestions - 1);
    }

    function nextQuestion() {
        if (currentQuestionIndex < totalQuestions - 1) {
            currentQuestionIndex++;
            showQuestion(currentQuestionIndex);
        }
    }

    function prevQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            showQuestion(currentQuestionIndex);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        showQuestion(currentQuestionIndex);
    });
</script>

<script>
    // Durasi ujian dalam menit setelah dikurangi keterlambatan
    const examDurationMinutes = @json($durasiUjian); // Durasi yang dikirim dari controller

    // Debugging: Cek nilai yang diterima dari backend
    console.log('Durasi Ujian dari Backend:', examDurationMinutes);

    // Cek apakah examDurationMinutes adalah nilai yang valid
    if (examDurationMinutes && examDurationMinutes > 0) {
        // Dapatkan waktu sekarang dalam milidetik
        const currentTime = new Date().getTime();

        // Hitung waktu akhir ujian berdasarkan durasi yang tersisa
        const examEndTime = currentTime + (examDurationMinutes * 60 * 1000); // Konversi durasi ke milidetik

        function updateCountdown() {
            const now = new Date().getTime();
            const remainingTime = examEndTime - now;

            // Jika waktu habis, submit form otomatis
            if (remainingTime <= 0) {
                document.getElementById('countdown').innerText = 'Waktu Habis';

                // Submit form otomatis
                document.getElementById('examForm').submit();

                // Redirect ke halaman jadwal.index setelah submit
                setTimeout(function(){
                    window.location.href = "{{ route('jadwal.index') }}";
                }, 2000); // Delay 2 detik agar form selesai tersubmit sebelum redirect

                // Hentikan update countdown
                return;
            }

            // Hitung menit dan detik yang tersisa
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            // Tampilkan waktu tersisa dalam format menit dan detik
            document.getElementById('countdown').innerText = `${minutes}m ${seconds}s`;

            // Update countdown setiap 1 detik
            setTimeout(updateCountdown, 1000);
        }

        // Mulai countdown
        updateCountdown();
    } else {
        // Jika durasi ujian tidak valid, tampilkan pesan
        document.getElementById('countdown').innerText = 'Durasi ujian tidak valid';
    }
</script>


<script>
    // Ketika jawaban dipilih
    $('.option-input').on('change', function() {
        var soalId = $(this).data('soal-id'); // ID soal saat ini
        var jawaban = $(this).val(); // Nilai jawaban

        $.ajax({
            url: '/save-jawaban', // Rute untuk menyimpan jawaban
            method: 'POST',
            data: {
                soal_id: soalId,
                jawaban: jawaban,
                _token: '{{ csrf_token() }}' // Token CSRF
            },
            success: function(response) {
                // Berikan feedback atau update UI jika diperlukan
                $('#status-indicator').text(response.totalAnswered + ' dikerjakan dari ' + response
                    .totalQuestions + ' soal');
            },
            error: function(xhr) {
                // Tangani error jika gagal menyimpan jawaban
                alert('Gagal menyimpan jawaban. Silakan coba lagi.');
            }
        });
    });
</script>
<script>
    // Function to check if a question is answered
    function checkAnswered() {
        const questionButtons = document.querySelectorAll('.question-btn');
        
        questionButtons.forEach(button => {
            const questionId = button.getAttribute('data-question-id');
            const radioButtons = document.querySelectorAll(`input[name="answers[${questionId}]"]`);

            // Check if any radio button for the question is checked
            let isAnswered = false;
            radioButtons.forEach(radio => {
                if (radio.checked) {
                    isAnswered = true;
                }
            });

            // Change button background if answered
            if (isAnswered) {
                button.classList.remove('btn-outline-primary');
                button.classList.add('btn-primary');
            } else {
                button.classList.remove('btn-primary');
                button.classList.add('btn-outline-primary');
            }
        });
    }

    // Run checkAnswered whenever an answer is selected
    document.querySelectorAll('.form-check-input').forEach(input => {
        input.addEventListener('change', checkAnswered);
    });

    // Run check on page load
    document.addEventListener('DOMContentLoaded', checkAnswered);
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>
