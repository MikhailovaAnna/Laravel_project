<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Posts</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-image: url(https://clipart-db.ru/file_content/rastr/background_042.jpg);
            background-size: cover;
            background-blend-mode: multiply;
            color: whitesmoke;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Практика</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar1">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/table">Table</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/search">Search</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <li class="nav-item">
                <a href="http://seventest.ru/" class="custom-logo-link" rel="home" itemprop="url"><img width="170" height="20" src="http://seventest.ru/wp-content/uploads/2017/07/logo_7T.png" class="custom-logo" alt="" itemprop="logo" /></a>
            </li>
        </form>
    </div>
</nav>

<div class="container flex-center position-ref full-height">
    <div class="content">
        <div class="title" >
            <h2>Практика</h2>
            <h4>Разработка программного обеспечения для поэтапного вывода части большой таблицы БД в ВЕБ-интерфейсе пользователя</h4>
            <p class="lead">
                <a href="/table" class="btn btn-lg btn-secondary">Начать просмотр</a>
            </p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3.1/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
</body>
</html>
