<!DOCTYPE html>
<html>
<head lang="es">
    <meta charset="utf-8">
    <title>@yield('title','Curso de Laravel 5')</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto+Slab:300,500">
    <link href="assets/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<p class="logo">
    <img src="assets/styde.jpg" width="200" />
</p>


@yield('content')


<div class="bottom">
    <hr>
    http://google.com
</div>
</body>
</html>