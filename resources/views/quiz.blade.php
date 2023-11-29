@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Trivia Quiz</div>

    <form method="POST" action="{{ route('quiz.submit') }}" id="quizForm">
        @csrf
        <div id="questionContainer">
            @foreach ($questions as $index => $question)
            <div class="card border-light" style="{{ $index > 0 ? 'display: none;' : '' }}" data-index="{{ $index }}">
                <div class="card-body">
                    <h5 class="card-title">Question {{ $index + 1 }} - (<small>{!! $question['category'] !!}</small>)</h5>
                    <p>{!! $question['question'] !!}</p>
                    <div class="form-group">
                        @foreach ($question['options'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $index }}]" value="{{ $option }}">
                            <label class="form-check-label">
                                {{ $option }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary m-3">Submit Answer</button>
    </form>
</div>

<script>
    const form = document.getElementById('quizForm');
    const questionCards = document.querySelectorAll('#questionContainer .card');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const currentQuestionIndex = Array.from(questionCards).findIndex(card => card.style.display !== 'none');
        const nextQuestionIndex = currentQuestionIndex + 1;
        if (nextQuestionIndex < questionCards.length) {
            questionCards[currentQuestionIndex].style.display = 'none';
            questionCards[nextQuestionIndex].style.display = 'block';
        } else {
            this.submit();
        }
    });
</script>

@endsection
