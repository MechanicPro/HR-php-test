<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/style.css">
    <!--Подключение библиотеки jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <title>Denis Yegorov</title>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Погода</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/order">Список заказов</a></li>
        </ul>
        <ul class="nav navbar-nav">
            <li><a href="/product">Список заказов(Дополнение)</a></li>
        </ul>
    </div>
</nav>