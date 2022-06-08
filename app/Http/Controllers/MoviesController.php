<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteMovieRequest;
use App\Http\Requests\GetMovieRequest;
use App\Http\Requests\InsertMovieRequest;
use App\Models\Movie;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class MoviesController extends Controller
{
    public function insertMovie(InsertMovieRequest $request)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        $movie = new Movie();
        $movie->movie = $request->movie;
        $movie->save();

        return response()->json([
            'movie' => $movie->movie,
            'option'=> 'create',
            'status'=> 'success'
        ]);
    }

    public function deleteMovie(DeleteMovieRequest $request)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        if (Movie::find($request->movieId) != null) {
            $movie = Movie::find($request->movieId);

            $movieId = $movie->id;
            $movieName = $movie->movie;

            $movie->forceDelete();

            return response()->json([
                'movieId' => $movieId,
                'movie' => $movieName,
                'option'=> 'delete',
                'status'=> 'success'
            ]);
        } else {
            return response()->json([
                'movieId' => null,
                'movie' => null,
                'option'=> 'delete',
                'status'=> 'error'
            ]);
        }
    }

    public function getAllMovies()
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(Movie::all());
    }

    public function getMovie(GetMovieRequest $query)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        if (Movie::find($query->movieId) != null) {
            return response()->json([
                'movieId' => Movie::find($query->movieId)::first()->id,
                'movie' => Movie::find($query->movieId)::first()->movie,
                'option' => 'get',
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'movieId' => null,
                'movie' => null,
                'option' => 'get',
                'status' => 'error'
            ]);
        }
    }
}
