@extends('layout')

@section('content')
    <h1>Reviews</h1>

    <ul>
        @foreach ($reviews as $review)
            <li>{{ $review->idUser }} - {{ $review->idMovie }} - {{ $review->review }}</li>
        @endforeach
    </ul>
@endsection
