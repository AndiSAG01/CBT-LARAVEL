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
    margin-bottom: 20px;
}

.soal-number {
    font-weight: bold;
    font-size: 16px;
    margin-right: 10px;
}

.soal-content {
    display: inline-block;
    font-size: 14px;
    line-height: 1.5;
}


</style>



<body>
    <nav class="navbar navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ Storage::url($user->image) }}" class="rounded-circle" alt="" width="40"
                    height="40">
                <span class="text-white">{{ $user->name }}</span>
            </a>
            <span class="text-white"><b>Ujian Daring</b></span>
        </div>
    </nav>
    <x-pages.container>
        <div class="row">
            <div class="col-sm-4 mb-4">
                <x-pages.card>
                    <h5 class="text-center">Waktu Ujian</h5>
                    <div id="countdown" class="countdown-timer"></div>
                </x-pages.card>

                <div class="card mt-4">
                    <div class="question-navigation">
                        <div id="status-indicator" class="mt-2">0 dikerjakan</div>
                        <div class="question-buttons">
                            @foreach ($soals as $index => $soal)
                                <button class="question-button"
                                    data-id="{{ $soal->id }}">{{ $index + 1 }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <x-pages.card>

                    <form id="exam-form" action="{{ route('exam.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
                        <input type="hidden" id="duration" value="{{ $ujian->durasi }}">

                        @foreach ($soals as $soal)
                            <div class="mb-4">
                                <div class="soal-container">
                                    <span class="soal-number">{{ $loop->iteration }}.</span>
                                    <div class="soal-content">{!! $soal->soal_ujian !!}</div>
                                </div>                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $soal->id }}]"
                                        value="A">
                                    <label class="form-check-label">{{ $soal->kunci_A }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $soal->id }}]"
                                        value="B">
                                    <label class="form-check-label">{{ $soal->kunci_B }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $soal->id }}]"
                                        value="C">
                                    <label class="form-check-label">{{ $soal->kunci_C }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $soal->id }}]"
                                        value="D">
                                    <label class="form-check-label">{{ $soal->kunci_D }}</label>
                                </div>
                                @if (!empty($soal->kunci_E))
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="answers[{{ $soal->id }}]" value="E">
                                        <label class="form-check-label">{{ $soal->kunci_E }}</label>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        {{ $soals->links('pagination::bootstrap-4') }}
                        <!-- Submit Button with JavaScript confirmation -->
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Apakah jawaban Anda sudah terisi semua?')">
                            Submit
                        </button>


                    </form>

                </x-pages.card>
            </div>
        </div>

        <script>
            let answeredCount = 0;

            // Kembalikan jawaban dari localStorage saat halaman dimuat
            window.addEventListener('load', () => {
                let answers = JSON.parse(localStorage.getItem('answers')) || {};
                document.querySelectorAll('.form-check-input').forEach(input => {
                    const questionId = input.name.match(/\d+/)[0];
                    if (answers[questionId] && input.value === answers[questionId]) {
                        input.checked = true;
                        const button = document.querySelector(`.question-button[data-id="${questionId}"]`);
                        button.classList.add('answered');
                        answeredCount++;
                    }
                });
                document.getElementById('status-indicator').textContent = `${answeredCount} dikerjakan`;
            });

            // Simpan jawaban ke localStorage saat input berubah
            document.querySelectorAll('.form-check-input').forEach(input => {
                input.addEventListener('change', function() {
                    const questionId = this.name.match(/\d+/)[0];
                    const button = document.querySelector(`.question-button[data-id="${questionId}"]`);

                    let answers = JSON.parse(localStorage.getItem('answers')) || {};
                    answers[questionId] = this.value;
                    localStorage.setItem('answers', JSON.stringify(answers));

                    if (!button.classList.contains('answered')) {
                        button.classList.add('answered');
                        answeredCount++;
                        document.getElementById('status-indicator').textContent = `${answeredCount} dikerjakan`;
                    }
                });
            });

            // Hitung mundur waktu ujian
            let duration = {{ $ujian->durasi }};

            function initializeCountdown() {
                let now = new Date().getTime();
                let examEndTime = localStorage.getItem('examEndTime');

                if (!examEndTime) {
                    examEndTime = now + duration * 60000;
                    localStorage.setItem('examEndTime', examEndTime);
                }

                let countdown = setInterval(function() {
                    let currentTime = new Date().getTime();
                    let timeLeft = examEndTime - currentTime;

                    let minutes = Math.floor(timeLeft / (1000 * 60));
                    let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    let countdownElement = document.getElementById('countdown');
                    countdownElement.innerHTML = minutes + "m " + seconds + "s ";

                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        countdownElement.innerHTML = "Waktu Habis";

                        // Redirect to the Jadwal Ujian page
                        window.location.href = "{{ route('jadwal.index') }}";

                        // Remove stored data from local storage
                        localStorage.removeItem('examEndTime');
                        localStorage.removeItem('answers');
                    }

                }, 1000);
            }

            initializeCountdown();

            // Hapus jawaban dari localStorage setelah submit
            document.getElementById('exam-form').addEventListener('submit', function() {
                localStorage.removeItem('answers');
                localStorage.removeItem('examEndTime');
            });
        </script>
    </x-pages.container>
</body>

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
