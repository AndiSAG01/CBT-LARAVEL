<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Hasil Ujian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .question-container {
            margin-bottom: 20px;
        }

        .question-container h5 {
            font-weight: bold;
        }

        .answer-option {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            /* Ensures both the label and answer are vertically aligned */
        }

        .answer-option span.option-label {
            font-weight: bold;
            font-size: 16px;
            margin-right: 10px;
        }

        .answer-option span.option-answer {
            font-size: 14px;
        line-height: 1.5;
        }
        .answer-option.bg-success {
            background-color: #28a745;
            color: white;
        }

        .answer-option.bg-danger {
            background-color: #dc3545;
            color: white;
        }

        .correct-answer {
            font-weight: bold;
        }

        .card {
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding-top: 40px;
        }

        h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
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
    </style>
</head>

<body>

<!-- Main Container -->
<div class="container">
    <div class="card">
        <h3 class="text-center">Detail Hasil Ujian</h3>

        <!-- Iterate through the results -->
        @foreach ($hasil as $index => $answer)
            <div class="question-container">
                <div class="soal-container">
                    <span class="soal-number">{{ (int)$index + 1 }}. </span>
                    <div class="soal-content">{!! $answer->soal->soal_ujian !!}</div>
                </div>
                
                <div>
                    @foreach (['A', 'B', 'C', 'D', 'E'] as $option)
                        @if (!empty($answer->soal->{'kunci_' . $option}))
                            @php
                                $isSelected = $answer->answer === $option;
                                $isCorrect = $option === $answer->soal->kunci_jawaban;
                                $backgroundColor = $isSelected ? ($isCorrect ? 'bg-success' : 'bg-danger') : '';
                            @endphp
                            <div class="answer-option {{ $backgroundColor }}">
                                <span class="option-label">{{ $option }}.</span>
                                <span class="option-answer">{!! $answer->soal->{'kunci_' . $option} !!}</span>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="correct-answer">
                    <strong>Kunci Jawaban:</strong> {{ $answer->soal->kunci_jawaban }}
                </div>
            </div>
        @endforeach
    </div>
</div>




    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
