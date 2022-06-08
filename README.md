# DebtGes Intern Software Engineer - PHP Challenge

# API

List of functionalities:

- Create new user/movie/review
- Delete user/movie/review
- Get all users/movies/reviews
- Get specific user/movie/review
- Get average rating of movie
- Get average rating of user

# API endpoints

### Create new user

**inputs**: name of user

**constraints** : None

curl -X POST http://localhost:<Port>/insertUser --data '{"user":"John"}'

---> {'user':'John',option:'create','status':'success'}

### Delete user

**inputs**: id of user

**constraints** : Must exist in database

curl -X POST http://localhost:<Port>/deleteUser --data '{"userId":<userId>}'

---> {'userId':userId, 'username':<username> , 'option':'delete','status:'<success/error>'}

### Create new movie

**inputs**: name of movie

**constraints** : None

curl -X POST http://localhost:<Port>/insertMovie --data '{"user":"Avengers"}'

---> {'movie':'Avengers',option:'create','status':'success'}

### Delete movie

**inputs**: id of movie

**constraints** : Must exist in database

curl -X POST http://localhost:<Port>/deleteMovie --data '{"userId":<movieId>}'

---> {'movieId':movieId, 'movie':<movie> , 'option':'delete','status:'<success/error>'}

### Create Review

**inputs** : userId, movieId, text of review, rating of review. 

**constraints**: movieId and userId must exist in the database.

curl -X POST http://localhost:<Port>/createReview --data '{"userId":<userId>, "movieId":<movieId>, "review":<review>,"rating":<rating>}'

---> response = {'username':<username>,'userId':<userId>,'movieId':<movieId>,'movie':<movie>, 'review':<review>, 'rating':<rating>,'option':'create','status':'success'}

### Delete review

**inputs** : reviewId 

**constraints**: reviewId must exit in the database

curl -X POST http://localhost:<Port>/deleteReview --data '{"reviewId":<reviewId>}'

---> response = {'username':<username>,'userId':<userId>,'movieId':<movieId>,'movie':<movie>, 'review':<review>, 'rating':<rating>,'option':'delete','status':'success/error'}

### Get all users

**inputs**: None

**constraints** : None

curl -X GET http://localhost:<Port>/getAllUsers

---> response = [{'id':userId, 'username':username}, ...]

### Get Specific user

curl -X GET http://localhost:<Port>/getuser --data '{"userId":<userId>}'

---> response = {'userId':<userId>,'username':<username>,'option':'get','status':'success'}

### Get all movies

**inputs**: None

**constraints** : None

curl -X GET http://localhost:<Port>/getAllMovies

---> response = [{'id':movieId, 'movie':movie}, ...]

### Get Specific movie

curl -X GET http://localhost:<Port>/getMovie --data '{"movieId":<movieId>}'

---> response = {'movieId':<movieId>,'movie':<movie>,'option':'get','status':'success'}

### Get all reviews

**inputs**: None

**constraints** : None

curl -X GET http://localhost:<Port>/getAllReviews

---> response = [{'id':reviewId, 'idMovie':idMovie, 'idUser':idUser, 'rating':rating, review':review}, ...]

### Get Specific review

curl -X GET http://localhost:<Port>/getReview --data '{"reviewId":<reviewId>}'

---> response = {'reviewId':reviewId, 'userId':userId, 'username':username, 'idMovie':idMovie, 'movie':movie, 'rating':rating, review':review,'option':'get','status':'success'}

### Get Average rating of movie

curl -X GET http://localhost:<Port>/getAverageRatingMovie --data '{"movie":<movieId>}'

---> response = {'movieId':movieId, 'movie':movie, 'averageMovieRating':<averageRating>, 'option':'get','status':'success'}

### Get Average rating of user

curl -X GET http://localhost:<Port>/getAverageRatingMovie --data '{"user":<userId>}'

---> response = {'userId':userId, 'username':username, 'averageUserRating':<averageRating>, 'option':'get','status':'success'}
