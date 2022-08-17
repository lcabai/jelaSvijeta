<!DOCTYPE html>
<html lang="en">

<head>
  <title>Jela Svijeta</title>
</head>

<body>
  <h1>helou</h1>
  <div> to refill the database with new random content run: php artisan migrate:fresh --seed </div>
  <div> pick language by chaning lang (hr/en/fr) <a href="http://127.0.0.1:8000/api/meals?lang=hr"> http://127.0.0.1:8000/api/meals?lang=hr</a> </br>
    filter by category id (1-10 / NULL / !NULL) <a href="http://127.0.0.1:8000/api/meals?lang=hr&category=1"> http://127.0.0.1:8000/api/meals?lang=hr&category=1</a> </br>
    filter by multiple tag ids (1-10) <a href="http://127.0.0.1:8000/api/meals?lang=hr&tags=1,2,3"> http://127.0.0.1:8000/api/meals?lang=hr&tags=1,2,3</a> </br>
    add more info using 'with = (any or all of these)(category, tags, ingredients) <a href="http://127.0.0.1:8000/api/meals?lang=hr&with=tags,ingredients"> http://127.0.0.1:8000/api/meals?lang=hr&with=tags,ingredients</a> </br>
    see meals published after given time (UNIX) <a href="http://127.0.0.1:8000/api/meals?lang=hr&diff_time=1493902343"> http://127.0.0.1:8000/api/meals?lang=hr&diff_time=1493902343</a> </br>
    add per_page and page <a href="http://127.0.0.1:8000/api/meals?lang=hr&per_page=3&page=2"> http://127.0.0.1:8000/api/meals?lang=hr&per_page=3&page=2</a> </br>
    or mix them all up <a href="http://127.0.0.1:8000/api/meals?lang=hr&&category=!NULL&tags=4&with=category,tags,ingredients&diff_time=1493902343&per_page=2&page=2"> http://127.0.0.1:8000/api/meals?lang=hr&&category=!NULL&tags=4&with=category,tags,ingredients&diff_time=1493902343&per_page=2&page=2</a>
  </div>
</body>

</html>