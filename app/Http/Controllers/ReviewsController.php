<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteReviewRequest;
use App\Http\Requests\GetMovieRequest;
use App\Http\Requests\GetReviewRequest;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\InsertReviewRequest;
use App\Models\Review;
use App\Models\Reviewer;
use App\Models\Movie;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReviewsController extends Controller
{
    public function createReview(InsertReviewRequest $request)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        $review = new Review([
            'idUser' => $request->userId,
            'idMovie' => $request->movieId,
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        if (Reviewer::find($review->idUser) != null && Movie::find($review->idMovie)) {
            $user = Reviewer::find($review->idUser);
            $movie = Movie::find($review->idMovie);
            $review->save();

            return response()->json([
                'username' => $user->username,
                'userId' => $user->id,
                'movieId' => $movie->id,
                'movie' => $movie->movie,
                'review' => $review->review,
                'rating' => $review->rating,
                'option'=> 'create',
                'status'=> 'success'
            ]);
        } else {
            return response()->json([
                'username' => null,
                'userId' => null,
                'movieId' => null,
                'movie' => null,
                'review' => null,
                'rating' => null,
                'option'=> 'create',
                'status'=> 'error'
            ]);
        }
    }

    public function deleteReview(DeleteReviewRequest $request)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        if (Review::find($request->reviewId) != null) {
            $review = Review::find($request->reviewId);

            $reviewText = $review->review;
            $rating = $review->rating;

            $user = Reviewer::find($review->idUser);
            $movie = Movie::find($review->idMovie);

            $review->forceDelete();

            return response()->json([
                'username' => $user->username,
                'userId' => $user->id,
                'movieId' => $movie->id,
                'movie' => $movie->movie,
                'review' => $reviewText,
                'rating' => $rating,
                'option'=> 'delete',
                'status'=> 'success'
            ]);
        } else {
            return response()->json([
                'username' => null,
                'userId' => null,
                'movieId' => null,
                'movie' => null,
                'review' => null,
                'rating' => null,
                'option'=> 'delete',
                'status'=> 'error'
            ]);
        }
    }

    public function getAllReviews()
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(Review::all());
    }

    public function getReview(GetReviewRequest $query)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json([
            'review' => Review::find($query->reviewId),
            'option' => 'get',
            'status' => 'success'
        ]);
    }

    public function getAverageRatingMovie(GetMovieRequest $query)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        $movieReviews = Review::all()->where('idMovie', '==', $query->movieId);
        $totalRating = 0;
        $totalRatingsLength = 0;
        foreach($movieReviews as $review) {
            $totalRating += $review->rating;
            $totalRatingsLength++;
        }
        return response()->json([
            'averageMovieRating' => $totalRatingsLength > 0 ? $totalRating/$totalRatingsLength : 0,
            'option' => 'get',
            'status' => 'success'
        ]);
    }

    public function getAverageRatingUser(GetUserRequest $query)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        $userReviews = Review::all()->where('idUser', '==', $query->userId);
        $totalRating = 0;
        $totalRatingsLength = 0;
        foreach($userReviews as $review) {
            $totalRating += $review->rating;
            $totalRatingsLength++;
        }
        return response()->json([
            'averageUserRating' => $totalRatingsLength > 0 ? $totalRating/$totalRatingsLength : 0,
            'option' => 'get',
            'status' => 'success'
        ]);
    }
}
