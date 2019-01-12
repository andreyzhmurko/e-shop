<!DOCTYPE html>
<html lang="ru">
    <div id="wrapper">
        <head>
            <meta charset="utf-8">  
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            <title><?= Router::$title; ?></title>
            <link href="/app/template/css/bootstrap.min.css" rel="stylesheet">
            <link href="/app/template/css/font-awesome.min.css" rel="stylesheet">
            <link href="/app/template/css/prettyPhoto.css" rel="stylesheet">
            <link href="/app/template/css/price-range.css" rel="stylesheet">
            <link href="/app/template/css/animate.css" rel="stylesheet">
            <link href="/app/template/css/main.css" rel="stylesheet">
            <link href="/app/template/css/slick.css" rel="stylesheet" type="text/css"/>
        </head><!--/head-->
        <body>
            <header id="header"><!--header-->
                <div class="header_top"><!--header_top-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="contactinfo">
                                    <ul class="nav nav-pills">
                                        <li><a href="#"><i class="fa fa-phone"></i> +38 (012) 345-67-89</a></li>
                                        <li><a href="#"><i class="fa fa-envelope"></i> example@example.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="social-icons pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header_top-->

                <div class="header-middle"><!--header-middle-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="logo pull-left">
                                    <a href="/"><img src="/app/template/images/home/logo.png" alt="logo" /></a>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="shop-menu pull-right">
                                    <ul class="nav navbar-nav">
                                        <li>
                                            <a href="/cart"><i class="fa fa-shopping-cart"></i> Корзина
                                                (<span id="cart-count"><?= Cart::countItems(); ?></span>)
                                            </a>
                                        </li>
                                        <?php if (Model_User::isGuest()): ?>  
                                            <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                        <?php else: ?>
                                            <li><a href="/cabinet/"><i class="fa fa-user"></i> Аккаунт</a></li>
                                            <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header-middle-->

                <div class="header-bottom"><!--header-bottom-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="mainmenu pull-left">
                                    <ul class="nav navbar-nav collapse navbar-collapse">
                                        <li><a href="/">Главная</a></li>
                                        <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                            <ul role="menu" class="sub-menu">
                                                <li><a href="/catalog//">Каталог товаров</a></li>
                                                <li><a href="/cabinet/"> Аккаунт</a></li>
                                                <li><a href="/cart/"> Корзина</a></li> 
                                            </ul>
                                        </li> 
                                        <li><a href="/contacts/">Контакты</a></li>
                                        <li>
                                            <div class="search-bar">
                                                <div>
                                                    <form action="/search/" method="POST">
                                                        <i class="icon fa fa-search"></i>
                                                        <input class="input-text search-field" id="search" type="search" name="search" placeholder="Поиск">
                                                        <input class="input-text" type="submit" id="btn_search" name="btn-search" value="Найти">
                                                        <div id="src-warning">Для поиска введите минимум 3 символа</div>
                                                    </form>
                                                </div>
                                                <ul class="search-result"></ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header-bottom-->
            </header><!--/header-->

            <div class="content">
                <?php include 'app/views/' . $this->content_view; ?>
            </div>
            <footer>
                <div class="footer footer-bottom">
                    <div class="container">
                        <div class="row">
                            <p class="pull-center">Example E-SHOPPER © 2019</p>
                        </div>
                    </div>
                </div>

            </footer><!--/Footer-->
    </div>

    <script src="/app/template/js/jquery.js"></script>
    <script src="/app/template/js/bootstrap.min.js"></script>
    <script src="/app/template/js/jquery.scrollUp.min.js"></script>
    <script src="/app/template/js/price-range.js"></script>
    <script src="/app/template/js/jquery.prettyPhoto.js"></script>
    <script src="/app/template/js/main.js"></script>
    <script src="/app/template/js/count-product.js" type="text/javascript"></script>
    <script src="/app/template/js/search.js" type="text/javascript"></script>
    <script src="/app/template/js/slick.min.js" type="text/javascript"></script>
    <script src="/app/template/js/product-slider.js" type="text/javascript"></script>
    <script src="/app/template/js/slider-autoplay.js" type="text/javascript"></script>
</body>
</html>