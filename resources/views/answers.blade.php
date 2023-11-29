@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Submitted Answers
    </div>
    <div class="card-body">
        @if($userAnswers)
        <ul>
            @foreach ($userAnswers as $index => $answer)
            <li>
                <strong>Question {{ $index + 1 }}:</strong> {{ $answer }}
            </li>
            @endforeach
        </ul>
        @else
        <p> You didn't answer any of the questions</p>
        @endif

        <a class="btn btn-success ml-4" href="{{ route('home') }}">newSearch </a>
    </div>
</div>
@endsection
