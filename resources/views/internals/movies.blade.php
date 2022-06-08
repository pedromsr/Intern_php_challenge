@extends('layout')

@section('content')
    <h1>Movies</h1>

    <ul>
        @foreach ($movies as $movie)
            <li>{{ $movie->movie }}</li>
        @endforeach
    </ul>
@endsection
