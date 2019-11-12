<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Главная</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="/template/css/my_style.css" rel="stylesheet">
    <link rel="shortcut icon" href="/template/images/favicon.ico">

</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills"></ul>
                        <div class="logo pull-left">
                            <a href="/"><img class="logo-img" src="/template/images/favicon.ico" alt=""/></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="pull-right">
                        <ul class="nav navbar-nav">
                            <?php if (User::isGuest()) : ?>
                                <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                            <?php elseif (AdminBase::checkAdmin()): ?>
                                <li><a href="/admin"><i class="fa fa-edit"></i>Админпанель</a></li>
                                <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
</header><!--/header-->
