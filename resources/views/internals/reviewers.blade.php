@extends('layout')

@section('content')
    <h1>Users</h1>

    <ul>
        @foreach ($reviewers as $reviewer)
            <li>{{ $reviewer->username }}</li>
        @endforeach
    </ul>
@endsection
