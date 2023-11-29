@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
         Search History
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Questions</th>
                    <th>Difficulty</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->full_name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->num_questions }}</td>
                    <td>{{ $data->difficulty }}</td>
                    <td>{{ $data->type }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <div class="pagination justify-content-center"> {{ $history->links() }}</div>
    </div>
</div>

@endsection
