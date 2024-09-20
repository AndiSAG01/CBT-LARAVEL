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
            <!-- Left Sidebar with Timer and Answered Questions -->
            <div class="col-sm-4 mb-4">
                <!-- Countdown Timer Card -->
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
                                        <button class="btn btn-outline-primary m-1 question-btn"
                                            id="question-btn-{{ $soal->id }}"
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
                    <form id="examForm" action="{{ route('exam.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
                        <input type="hidden" id="duration" value="{{ $ujian->durasi }}">

                        <div id="questionContainer">
                            @if ($soals->isNotEmpty()) <!-- Check if there are published questions -->
                                @foreach ($soals as $index => $soal)
                                    @php
                                        $questionNumber = $index + 1;
                                    @endphp
                        
                                    <div class="soal-slide" style="display: {{ $index == 0 ? 'block' : 'none' }};"
                                         data-index="{{ $index }}">
                                        <!-- Question Display -->
                                        <div class="soal-container mb-2">
                                            <span class="soal-number">{{ $questionNumber }}.</span>
                                            <div class="soal-content">{!! $soal->soal_ujian !!}</div>
                                        </div>
                        
                                        <!-- Answer Options -->
                                        @foreach (['A', 'B', 'C', 'D', 'E'] as $option)
                                            @if (!empty($soal->{'kunci_' . $option}))
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                           name="answers[{{ $soal->id }}]" value="{{ $option }}"
                                                           {{ isset($answeredSoals[$soal->id]) && $answeredSoals[$soal->id] == $option ? 'checked' : '' }}>
                                                    <label class="form-check-label">{!! $soal->{'kunci_' . $option} !!}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                        
                                <!-- Navigation buttons -->
                                <div class="mt-4">
                                    <button type="button" class="btn btn-secondary" id="prevBtn" onclick="prevQuestion()"
                                            disabled>Previous</button>
                                    <button type="button" class="btn btn-secondary" id="nextBtn"
                                            onclick="nextQuestion()">Next</button>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    Tidak ada soal yang dipublikasikan untuk ujian ini.
                                </div>
                            @endif
                        </div>
                        
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

    document.addEventListener('DOMContentLoaded', function() {
        showQuestion(currentQuestionIndex);
    });
</script>
<script>
    // Ensure the server-side variable is correctly passed as a numeric value
    const examDurationMinutes = parseInt(@json($ujian->durasi), 10); // Duration in minutes from the controller

    if (isNaN(examDurationMinutes) || examDurationMinutes <= 0) {
        console.error('Invalid exam duration:', examDurationMinutes);
    } else {
        const currentTime = new Date().getTime(); // Current time in milliseconds
        let examEndTime = localStorage.getItem('examEndTime');

        // If there's no stored end time, calculate it and store it
        if (!examEndTime) {
            examEndTime = currentTime + (examDurationMinutes * 60 * 1000); // Duration in milliseconds
            localStorage.setItem('examEndTime', examEndTime);
        } else {
            examEndTime = parseInt(examEndTime, 10); // Parse stored end time
        }

        function updateCountdown() {
            const now = new Date().getTime(); // Get current time
            const remainingTime = examEndTime - now; // Calculate remaining time

            // If time has expired, submit the form automatically
            if (remainingTime <= 0) {
                document.getElementById('countdown').innerText = 'Waktu Habis';

                // Submit form automatically
                document.getElementById('examForm').submit();

                // Redirect to the schedule page after form submission
                setTimeout(function() {
                    window.location.href = "{{ route('jadwal.index') }}";
                }, 1000); // Delay 1 second to ensure form submission

                // Clear the stored end time
                localStorage.removeItem('examEndTime');
                return;
            }

            // Calculate minutes and seconds remaining
            const minutes = Math.floor(remainingTime / (1000 * 60)); // Total minutes
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000); // Remaining seconds

            // Display the remaining time in minutes and seconds
            document.getElementById('countdown').innerText = `${minutes}m ${seconds}s`;

            // Update countdown every 1 second
            setTimeout(updateCountdown, 1000);
        }

        // Start the countdown
        updateCountdown();
    }
</script>



<script>
    // Function to restore answers from localStorage on page load, using `ujian_id`
    function restoreAnswers() {
        const ujianId = document.querySelector('input[name="ujian_id"]').value;
        let answers = JSON.parse(localStorage.getItem(`answers_${ujianId}`)) || {}; // Use ujian_id in key

        document.querySelectorAll('.form-check-input').forEach(input => {
            const questionId = input.name.match(/\d+/)[0]; // Extract the question ID from the input name

            // Check if the answer exists in localStorage for this question
            if (answers[questionId] && input.value === answers[questionId]) {
                input.checked = true; // Check the saved answer
                const button = document.querySelector(`.question-btn[data-question-id="${questionId}"]`);
                if (button) {
                    button.classList.remove('btn-outline-primary');
                    button.classList.add('btn-primary');
                }
            }
        });
    }

    // Function to save answers to localStorage when a user selects an option, using `ujian_id`
    function saveAnswer(input) {
        const ujianId = document.querySelector('input[name="ujian_id"]').value; // Get the current ujian_id
        let answers = JSON.parse(localStorage.getItem(`answers_${ujianId}`)) || {}; // Use ujian_id in key
        const questionId = input.name.match(/\d+/)[0]; // Extract question ID
        answers[questionId] = input.value; // Store the selected answer
        localStorage.setItem(`answers_${ujianId}`, JSON.stringify(
        answers)); // Save answers to localStorage with ujian_id
    }

    // Function to clear previous answers when a new `ujian_id` is detected
    function clearPreviousAnswers() {
        const currentUjianId = document.querySelector('input[name="ujian_id"]').value;
        const storedUjianId = localStorage.getItem('current_ujian_id');

        if (storedUjianId && storedUjianId !== currentUjianId) {
            // Clear previous answers if the `ujian_id` has changed
            localStorage.removeItem(`answers_${storedUjianId}`);
        }

        // Update the current `ujian_id` in localStorage
        localStorage.setItem('current_ujian_id', currentUjianId);
    }

    // Function to update the button styles based on answered questions
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

            // Change button background if answered and save to Local Storage
            if (isAnswered) {
                button.classList.remove('btn-outline-primary');
                button.classList.add('btn-primary');
                localStorage.setItem(`answered_${questionId}`, true); // Save answered state to localStorage
            } else {
                button.classList.remove('btn-primary');
                button.classList.add('btn-outline-primary');
                localStorage.removeItem(`answered_${questionId}`); // Remove answered state from localStorage
            }
        });
    }

    // Function to restore answered questions from Local Storage on page load
    function restoreAnsweredStatus() {
        const questionButtons = document.querySelectorAll('.question-btn');

        questionButtons.forEach(button => {
            const questionId = button.getAttribute('data-question-id');

            // Check Local Storage to restore button state
            if (localStorage.getItem(`answered_${questionId}`)) {
                button.classList.remove('btn-outline-primary');
                button.classList.add('btn-primary');
            } else {
                button.classList.remove('btn-primary');
                button.classList.add('btn-outline-primary');
            }
        });
    }

    // On page load, clear previous answers if `ujian_id` changes and restore current answers
    document.addEventListener('DOMContentLoaded', () => {
        clearPreviousAnswers(); // Clear previous answers if a new exam is started
        restoreAnswers(); // Restore saved answers for the current exam
        restoreAnsweredStatus(); // Restore answered status (button colors)
    });

    // Attach event listeners to form-check-inputs to detect changes and update button states
    document.querySelectorAll('.form-check-input').forEach(input => {
        input.addEventListener('change', function() {
            saveAnswer(this); // Save the answer when it changes
            checkAnswered(); // Update the button styles based on answered questions
        });
    });
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
    // Function to check if a question is answered and update the button state
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

            // Change button background if answered and save to Local Storage
            if (isAnswered) {
                button.classList.remove('btn-outline-primary');
                button.classList.add('btn-primary');
                localStorage.setItem(`answered_${questionId}`, true); // Save answered state to localStorage
            } else {
                button.classList.remove('btn-primary');
                button.classList.add('btn-outline-primary');
                localStorage.removeItem(`answered_${questionId}`); // Remove answered state from localStorage
            }
        });
    }

    // Function to restore answered questions from Local Storage on page load
    function restoreAnsweredStatus() {
        const questionButtons = document.querySelectorAll('.question-btn');

        questionButtons.forEach(button => {
            const questionId = button.getAttribute('data-question-id');

            // Check Local Storage to restore button state
            if (localStorage.getItem(`answered_${questionId}`)) {
                button.classList.remove('btn-outline-primary');
                button.classList.add('btn-primary');
            } else {
                button.classList.remove('btn-primary');
                button.classList.add('btn-outline-primary');
            }
        });
    }

    // Run restoreAnsweredStatus on page load to restore the state of answered questions
    document.addEventListener('DOMContentLoaded', function() {
        restoreAnsweredStatus(); // Restore answered status from localStorage
    });

    // Attach event listeners to form-check-inputs to detect changes and update button states
    document.querySelectorAll('.form-check-input').forEach(input => {
        input.addEventListener('change', checkAnswered); // Run checkAnswered when an answer is selected
    });

    // Optionally, call checkAnswered after restoring status to handle any remaining updates
    document.addEventListener('DOMContentLoaded', function() {
        checkAnswered(); // Ensure the button states are correct after page load
    });
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
