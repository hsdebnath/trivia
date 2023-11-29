@extends('layouts.app')

@section('content')

@if(isset($error))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Oops! </strong> {{$error}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="card">
  <div class="card-header">
    Find Your Trivia
  </div>
  <div class="card-body">
  <div class="row">
    <div class="col-lg-6">
        <form method="POST" action="{{ route('form.submit') }}">
        @csrf
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required  value="{{ old('full_name') }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required  value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="num_questions">Number of Questions</label>
            <input type="number" class="form-control" id="num_questions" name="num_questions" required  min ="1" max="49" value="{{ old('num_questions') }}">
        </div>
        <div class="form-group">
            <label for="difficulty">Select Difficulty</label>
            <select class="form-control" id="difficulty" name="difficulty" required>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type">Select Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="multiple choice">Multiple Choice</option>
                <option value="true-false">True-False</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success btn-block">Search</button>
    </form></div>
  <div class="col-lg-6 thumbnail-col d-none d-lg-block">
              <img src="https://img.freepik.com/free-vector/curiosity-people-concept-illustration_114360-11034.jpg?w=740&t=st=1701249017~exp=1701249617~hmac=73f8b6240702686129ada38676152ac610419f48088ce44412b2071cd8d9d4d6" class="img-fluid rounded w-100 h-100" alt="Thumbnail">
            </div>
  </div>
</div>

@endsection