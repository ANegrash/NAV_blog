<?
    $link                   = $_GET['link_rewrite'];
    $hostname               = "web08-cp";
    $username               = "username"; 
    $password               = "password"; 
    $database               = "username_blog"; 
    $db1                    = mysqli_connect($hostname, $username, $password, $database);
    
    if (!empty($link)) {
        $q = "
            (SELECT p.id_post, p.id_category, p.name_post, p.date_post, p.tags, p.link_rewrite, p.text, p.author, p.img_back, 'post' as type FROM posts as p WHERE p.link_rewrite='".$link."') 
            UNION 
            (SELECT c.id_category, null, c.name, null, null, c.link_rewrite, c.description, null, c.img_back, 'category' FROM categories as c WHERE c.link_rewrite='".$link."') LIMIT 1
        ";
        $res        = mysqli_query($db1, $q); 
        $row1       = mysqli_fetch_array($res);
        $type       = $row1['type'];
        $name       = $row1['name_post']; 
        $text       = $row1['text']; 
        $id         = $row1['id_post'];
        $datePost   = $row1['date_post'];
        $idParent   = $row1['id_category'];
        $author     = $row1['author'];
        $tags       = $row1['tags'];
        $imgOG      = $row1['img_back'];
        
        function getReplacedText($r_text) {
            $toreturn = str_replace("&", "&amp;", $r_text);
            $toreturn = str_replace('<', '&lt;', $toreturn);
            $toreturn = str_replace('>', '&gt;', $toreturn);
            $toreturn = str_replace('[h2]', '<br><br><h2>', $toreturn);
            $toreturn = str_replace('[h3]', '<br><br><h3>', $toreturn);
            $toreturn = str_replace('[', '<', $toreturn);
            $toreturn = str_replace(']', '>', $toreturn);
            return $toreturn;
        }

        if ($type == "category") {
            ?>
                <!doctype html>
                <html lang="ru">
                    <head>
                        <meta name="yandex-verification" content="382e52e64bd7e557" />
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta name="description" content="">
                        <meta name="author" content="NAV-com">
                        <title><? echo $name; ?></title>
                        <link rel="shortcut icon" href="https://nav-com.ru/img/logo-round.png" type="image/png"> 
                        <meta name="description" content="<? echo $text; ?>">
                        <meta name="keywords" content="<? echo $tags; ?>">
                        <meta name="robots" content="index">
                        <meta name="og:title" content="<? echo $name; ?> | NAV-com">
                        <meta name="og:type" content="website">
                        <meta name="og:image" content="https://blog.nav-com.ru/img/categories/<? echo $imgOG; ?>">
                        <meta name="og:url" content="https://blog.nav-com.ru/<? echo $link; ?>">
                        <meta name="og:locale" content="ru_RU">
                        
                        <!-- Bootstrap core CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                        <meta name="theme-color" content="#7952b3">
                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <style>
                            .bd-placeholder-img {
                                font-size: 1.125rem;
                                text-anchor: middle;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                user-select: none;
                            }
                        
                            @media (min-width: 768px) {
                                .bd-placeholder-img-lg {
                                    font-size: 3.5rem;
                                }
                            }
                        </style>
                    </head>
                    <body>
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="https://nav-com.ru/">
                                    <img src="https://nav-com.ru/img/logo-round.png" style="width:40px!important;height:40px!important;">
                                    NAV-com
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="https://blog.nav-com.ru/">Главная</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Категории
                                            </a>
                                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                                <?
                                                $q2 = "SELECT name, link_rewrite FROM categories WHERE 1";
                                                $res = mysqli_query($db1, $q2); 
                                                while ($row = mysqli_fetch_array($res)){
                                                    $nameCat = $row['name'];
                                                    $linkCat = $row['link_rewrite'];
                                                    ?>
                                                        <li><a class="dropdown-item" href="https://blog.nav-com.ru/<? echo $linkCat; ?>" style="color:white;"><? echo $nameCat; ?></a></li>
                                                    <?
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div style="padding-right:30px;">
                                        <a href="https://vk.com/nav_com" style="margin-right:10px;text-decoration:none;">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000px" height="25.000000px" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                                    <path d="M2235 4019 c-336 -12 -449 -46 -528 -159 -26 -37 -21 -48 31 -59 106
                                                    -23 181 -75 214 -147 63 -144 80 -491 39 -804 -21 -155 -61 -239 -121 -252
                                                    -79 -17 -212 92 -325 266 -90 138 -342 625 -425 821 -52 123 -74 153 -136 185
                                                    l-49 25 -400 -3 c-220 -1 -417 -5 -438 -8 -21 -3 -51 -17 -67 -31 -26 -21 -30
                                                    -32 -30 -76 0 -42 14 -81 81 -231 253 -562 537 -1059 837 -1465 239 -324 382
                                                    -475 583 -617 284 -201 498 -297 754 -339 122 -20 573 -20 628 -1 87 32 108
                                                    73 118 241 12 200 57 318 147 388 88 68 175 14 414 -255 158 -178 238 -256
                                                    317 -306 61 -39 148 -75 207 -87 46 -8 321 -7 666 4 l247 8 48 29 c55 34 73
                                                    63 73 120 0 148 -130 327 -525 719 -292 290 -312 317 -302 408 9 70 41 119
                                                    302 467 338 450 450 625 506 789 26 75 25 161 -1 189 -50 53 -57 54 -580 52
                                                    -282 0 -500 -5 -522 -11 -51 -13 -78 -50 -128 -175 -24 -60 -88 -197 -142
                                                    -304 -199 -398 -432 -723 -565 -787 -29 -15 -34 -14 -70 4 -25 13 -45 35 -60
                                                    64 -40 77 -44 168 -32 624 12 451 9 500 -34 584 -12 25 -34 54 -48 64 -38 28
                                                    -168 56 -284 62 -55 3 -122 7 -150 9 -27 1 -140 -1 -250 -5z"/>
                                                </g>
                                            </svg>
                                        </a>
                                        <a href="https://www.instagram.com/nav_com.ru/" style="text-decoration:none;">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000px" height="25.000000px" viewBox="0 0 2200.000000 2200.000000" preserveAspectRatio="xMidYMid meet">
                                                <g transform="translate(0.000000,2200.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                                    <path d="M8410 21477 c-3 -2 -198 -7 -435 -11 -236 -4 -446 -8 -465 -10 -19
                                                    -3 -132 -7 -250 -11 -118 -3 -242 -8 -275 -10 -33 -2 -127 -7 -210 -10 -1266
                                                    -51 -2209 -261 -3090 -689 -392 -190 -698 -389 -1055 -685 -143 -118 -533
                                                    -507 -665 -661 -543 -639 -924 -1409 -1154 -2335 -184 -743 -249 -1495 -282
                                                    -3250 -14 -762 -6 -5755 10 -6165 47 -1219 66 -1502 132 -1965 161 -1129 554
                                                    -2122 1137 -2870 228 -292 541 -618 827 -861 367 -312 828 -595 1290 -792 837
                                                    -357 1709 -533 2860 -577 83 -3 177 -8 210 -10 33 -3 152 -7 265 -11 113 -3
                                                    225 -8 250 -10 343 -27 6730 -27 6980 1 19 2 132 6 250 10 118 3 242 8 275 10
                                                    33 2 128 7 210 10 1259 50 2204 260 3080 684 559 271 1006 597 1470 1072 424
                                                    434 713 841 966 1364 292 604 484 1249 588 1980 66 463 87 777 132 1970 16
                                                    417 24 5400 10 6160 -26 1387 -73 2129 -172 2720 -150 889 -467 1732 -891
                                                    2369 -378 568 -920 1113 -1484 1493 -680 458 -1549 781 -2494 927 -421 65
                                                    -802 97 -1445 121 -82 3 -179 8 -215 10 -36 2 -175 7 -310 10 -135 4 -276 9
                                                    -315 12 -80 7 -5728 16 -5735 10z m5410 -1901 c36 -2 207 -7 380 -10 173 -4
                                                    342 -9 375 -11 33 -2 132 -7 220 -10 686 -24 1088 -59 1490 -131 596 -106
                                                    1167 -323 1575 -597 418 -280 839 -729 1072 -1142 229 -406 401 -911 492
                                                    -1445 72 -424 99 -785 136 -1825 38 -1052 38 -5765 0 -6810 -33 -933 -55
                                                    -1260 -106 -1630 -105 -752 -343 -1413 -677 -1884 -258 -363 -633 -721 -993
                                                    -949 -110 -69 -324 -180 -458 -237 -634 -271 -1270 -390 -2291 -430 -77 -3
                                                    -174 -8 -215 -10 -41 -2 -172 -7 -290 -11 -118 -3 -237 -8 -265 -9 -429 -26
                                                    -6304 -26 -6520 -1 -16 2 -142 7 -280 11 -137 3 -268 8 -290 10 -22 2 -114 7
                                                    -205 10 -385 14 -712 40 -1005 81 -847 119 -1533 388 -2060 810 -146 117 -437
                                                    410 -556 559 -438 549 -705 1255 -818 2165 -40 316 -63 698 -91 1520 -38 1075
                                                    -38 5751 0 6805 37 1040 64 1401 136 1825 83 491 236 958 439 1347 287 551
                                                    825 1096 1370 1388 648 348 1380 516 2460 565 127 5 271 12 320 15 50 2 187 7
                                                    305 11 118 3 238 8 265 9 28 2 336 6 685 10 349 4 637 9 639 11 5 5 4682 -5
                                                    4761 -10z"/>
                                                    <path d="M16510 17853 c-240 -21 -430 -87 -623 -216 -99 -66 -239 -199 -304
                                                    -287 -318 -437 -333 -1007 -38 -1455 77 -116 234 -273 349 -349 584 -385 1360
                                                    -231 1747 346 143 215 212 442 212 703 1 679 -534 1234 -1213 1258 -52 2 -111
                                                    2 -130 0z"/>
                                                    <path d="M10805 16383 c-146 -5 -448 -33 -612 -58 -983 -149 -1881 -555 -2663
                                                    -1205 -152 -127 -491 -463 -625 -620 -655 -770 -1076 -1690 -1229 -2690 -79
                                                    -513 -79 -1108 0 -1620 173 -1122 676 -2133 1464 -2944 1130 -1162 2703 -1748
                                                    4325 -1611 1116 95 2177 539 3035 1271 148 126 468 446 594 594 583 683 991
                                                    1512 1175 2385 130 618 150 1299 56 1922 -176 1162 -722 2225 -1566 3048
                                                    -1059 1032 -2459 1573 -3954 1528z m595 -1917 c258 -32 486 -83 720 -162 1210
                                                    -409 2107 -1461 2319 -2719 36 -213 45 -335 45 -585 0 -250 -9 -372 -45 -585
                                                    -183 -1087 -879 -2029 -1868 -2529 -1086 -549 -2386 -490 -3419 155 -147 91
                                                    -367 258 -504 383 -568 516 -961 1236 -1087 1991 -36 215 -45 336 -45 585 0
                                                    250 9 372 45 585 128 761 512 1465 1084 1988 576 526 1303 842 2090 907 146
                                                    12 521 4 665 -14z"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <script>
                            $( document ).ready(function(){
                                $( ".dropdown-item" ).hover(function(){ // задаем функцию при наведении курсора на элемент	
                                    $( this ).attr( "style", "background-color: rgba(255, 255, 255, .7);" ) ; 
                                }, function(){ // задаем функцию, которая срабатывает, когда указатель выходит из элемента 	
                                    $( this ).attr( "style", "color:white" ) ; 
                                });
                            });
                        </script>
                        <main>
                            <section class="py-5 text-center container">
                                <div class="row py-lg-5">
                                    <div class="col-lg-6 col-md-8 mx-auto">
                                        <h1 class="fw-light">
                                            <? echo $name; ?>
                                        </h1>
                                        <p class="lead text-muted">
                                            <? echo $text; ?>
                                        </p>
                                        <p>
                                            <a href="#" class="btn btn-primary rounded-pill">Заказать сайт в NAV-com</a>
                                        </p>
                                    </div>
                                </div>
                            </section>
                        
                            <div class="album py-5 bg-light">
                                <div class="container">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                        <?
                                            $q1 = "SELECT name_post, date_post, link_rewrite, LENGTH(text) as length, img_back FROM posts WHERE id_category=".$id." ORDER BY date_post DESC";
                                            $res = mysqli_query($db1, $q1); 
                                            while ($row = mysqli_fetch_array($res)){
                                                $name_post      = $row['name_post'];
                                                $date_post      = $row['date_post'];
                                                $link_rewrite   = $row['link_rewrite'];
                                                $length         = $row['length'];
                                                $img_back       = $row['img_back'];
                                                ?>
                                                    <div class="col">
                                                        <div class="card shadow-sm">
                                                            <img class="bd-placeholder-img card-img-top" src="https://blog.nav-com.ru/img/posts/<? echo $img_back; ?>" width="30em" height="auto" onError="this.src='https://blog.nav-com.ru/img/posts/default-post.png'">
                                                            <div class="card-body">
                                                                <p class="card-text">
                                                                    <? echo getReplacedText($name_post); ?>
                                                                </p>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="btn-group">
                                                                        <a type="button" class="btn btn-sm btn-outline-secondary" href="https://blog.nav-com.ru/<? echo $link_rewrite ?>">
                                                                            Читать
                                                                        </a>
                                                                    </div>
                                                                    <small class="text-muted">
                                                                        <? echo round($length/1500)+1; ?> мин
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </main>
                        
                        <footer class="text-muted py-5">
                            <div class="container">
                                <p class="mb-1">
                                    <? 
                                        $nowYear = date(Y);
                                        $textYear = '';
                                        if ($nowYear == 2021) $textYear = "2021"; else $textYear = "2021-".$nowYear;
                                    ?>
                                    &copy; NAV-com, <? echo $textYear; ?>
                                </p>
                            </div>
                        </footer>
                        
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
                        
                    </body>
                </html>
            <?
        } else if ($type == "post") {
            $q          = "SELECT name, link_rewrite FROM categories WHERE id_category='".$idParent."' LIMIT 1";
            $res        = mysqli_query($db1, $q); 
            $row1       = mysqli_fetch_array($res);
            $nameParent = $row1['name']; 
            $linkParent = $row1['link_rewrite']; 
            $displayDatePost = "";
            $datePost = explode("-", $datePost);
            $displayDatePost .= $datePost[2]." ";
            switch ($datePost[1]) {
                case 1: $displayDatePost .= "января";break;
                case 2: $displayDatePost .= "февраля";break;
                case 3: $displayDatePost .= "марта";break;
                case 4: $displayDatePost .= "апреля";break;
                case 5: $displayDatePost .= "мая";break;
                case 6: $displayDatePost .= "июня";break;
                case 7: $displayDatePost .= "июля";break;
                case 8: $displayDatePost .= "августа";break;
                case 9: $displayDatePost .= "сентября";break;
                case 10: $displayDatePost .= "октября";break;
                case 11: $displayDatePost .= "ноября";break;
                case 12: $displayDatePost .= "декабря";break;
            }
            $displayDatePost .= " ".$datePost[0]." года";
            ?>
                <!doctype html>
                <html lang="ru">
                    <head>
                        <meta name="yandex-verification" content="382e52e64bd7e557" />
                        <!-- Put this script tag to the <head> of your page -->
                        <script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>
                        
                        <script type="text/javascript">
                          VK.init({apiId: 7802119, onlyWidgets: true});
                        </script>
                        <!-- Put this script tag to the <head> of your page -->
                        <script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta name="description" content="">
                        <meta name="author" content="<? echo $author; ?>">
                        <title><? echo $name; ?></title>
                        <link rel="shortcut icon" href="https://nav-com.ru/img/logo-round.png" type="image/png"> 
                        <meta name="keywords" content="<? echo $tags; ?>">
                        <meta name="robots" content="index">
                        <meta name="og:title" content="<? echo $name; ?> | NAV-com">
                        <meta name="og:type" content="article">
                        <meta name="og:image" content="https://blog.nav-com.ru/img/posts/<? echo $imgOG; ?>">
                        <meta name="og:url" content="https://blog.nav-com.ru/<? echo $link; ?>">
                        <meta name="og:locale" content="ru_RU">
                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        
                        <!-- Bootstrap core CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                        <meta name="theme-color" content="#7952b3">
                        
                        <style>
                            img {
                                width: 100%;
                                padding: 5px;
                            }
                            
                            img[data-src] {
                                opacity: 0;
                            }
                              
                            h2:after {
                                position: absolute;
                                content: "";
                                left: 0;
                                top: 0;
                                bottom: 0;
                                width: 5px;
                                background-color:#00ffff;
                                border-radius: 2px;
                                box-shadow: inset 0 1px 1px #00ffff, 0 1px 1px #00ffff;
                            }
                              
                            h2 {
                                margin: 1em 0 .6em 0;
                                padding: 0 0 0 20px;
                                font-weight: normal;
                                position: relative;
                                font-size: 30px;
                                line-height: 40px;
                            }
                              
                            h3 {
                                font-size:1.3rem;
                            }
                        </style>
                    </head>
                    <body style="overflow-x:hidden;">
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v10.0" nonce="ThJudfCh"></script>
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="https://nav-com.ru/">
                                    <img src="https://nav-com.ru/img/logo-round.png" style="width:40px!important;height:40px!important;">
                                    NAV-com
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="https://blog.nav-com.ru/">Главная</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Категории
                                            </a>
                                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                                <?
                                                $q2 = "SELECT name, link_rewrite FROM categories WHERE 1";
                                                $res = mysqli_query($db1, $q2); 
                                                while ($row = mysqli_fetch_array($res)){
                                                    $nameCat = $row['name'];
                                                    $linkCat = $row['link_rewrite'];
                                                    ?>
                                                        <li><a class="dropdown-item" href="https://blog.nav-com.ru/<? echo $linkCat; ?>" style="color:white;"><? echo $nameCat; ?></a></li>
                                                    <?
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div style="padding-right:30px;">
                                        <a href="https://vk.com/nav_com" style="margin-right:10px;text-decoration:none;">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000px" height="25.000000px" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                                    <path d="M2235 4019 c-336 -12 -449 -46 -528 -159 -26 -37 -21 -48 31 -59 106
                                                    -23 181 -75 214 -147 63 -144 80 -491 39 -804 -21 -155 -61 -239 -121 -252
                                                    -79 -17 -212 92 -325 266 -90 138 -342 625 -425 821 -52 123 -74 153 -136 185
                                                    l-49 25 -400 -3 c-220 -1 -417 -5 -438 -8 -21 -3 -51 -17 -67 -31 -26 -21 -30
                                                    -32 -30 -76 0 -42 14 -81 81 -231 253 -562 537 -1059 837 -1465 239 -324 382
                                                    -475 583 -617 284 -201 498 -297 754 -339 122 -20 573 -20 628 -1 87 32 108
                                                    73 118 241 12 200 57 318 147 388 88 68 175 14 414 -255 158 -178 238 -256
                                                    317 -306 61 -39 148 -75 207 -87 46 -8 321 -7 666 4 l247 8 48 29 c55 34 73
                                                    63 73 120 0 148 -130 327 -525 719 -292 290 -312 317 -302 408 9 70 41 119
                                                    302 467 338 450 450 625 506 789 26 75 25 161 -1 189 -50 53 -57 54 -580 52
                                                    -282 0 -500 -5 -522 -11 -51 -13 -78 -50 -128 -175 -24 -60 -88 -197 -142
                                                    -304 -199 -398 -432 -723 -565 -787 -29 -15 -34 -14 -70 4 -25 13 -45 35 -60
                                                    64 -40 77 -44 168 -32 624 12 451 9 500 -34 584 -12 25 -34 54 -48 64 -38 28
                                                    -168 56 -284 62 -55 3 -122 7 -150 9 -27 1 -140 -1 -250 -5z"/>
                                                </g>
                                            </svg>
                                        </a>
                                        <a href="https://www.instagram.com/nav_com.ru/" style="text-decoration:none;">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000px" height="25.000000px" viewBox="0 0 2200.000000 2200.000000" preserveAspectRatio="xMidYMid meet">
                                                <g transform="translate(0.000000,2200.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                                    <path d="M8410 21477 c-3 -2 -198 -7 -435 -11 -236 -4 -446 -8 -465 -10 -19
                                                    -3 -132 -7 -250 -11 -118 -3 -242 -8 -275 -10 -33 -2 -127 -7 -210 -10 -1266
                                                    -51 -2209 -261 -3090 -689 -392 -190 -698 -389 -1055 -685 -143 -118 -533
                                                    -507 -665 -661 -543 -639 -924 -1409 -1154 -2335 -184 -743 -249 -1495 -282
                                                    -3250 -14 -762 -6 -5755 10 -6165 47 -1219 66 -1502 132 -1965 161 -1129 554
                                                    -2122 1137 -2870 228 -292 541 -618 827 -861 367 -312 828 -595 1290 -792 837
                                                    -357 1709 -533 2860 -577 83 -3 177 -8 210 -10 33 -3 152 -7 265 -11 113 -3
                                                    225 -8 250 -10 343 -27 6730 -27 6980 1 19 2 132 6 250 10 118 3 242 8 275 10
                                                    33 2 128 7 210 10 1259 50 2204 260 3080 684 559 271 1006 597 1470 1072 424
                                                    434 713 841 966 1364 292 604 484 1249 588 1980 66 463 87 777 132 1970 16
                                                    417 24 5400 10 6160 -26 1387 -73 2129 -172 2720 -150 889 -467 1732 -891
                                                    2369 -378 568 -920 1113 -1484 1493 -680 458 -1549 781 -2494 927 -421 65
                                                    -802 97 -1445 121 -82 3 -179 8 -215 10 -36 2 -175 7 -310 10 -135 4 -276 9
                                                    -315 12 -80 7 -5728 16 -5735 10z m5410 -1901 c36 -2 207 -7 380 -10 173 -4
                                                    342 -9 375 -11 33 -2 132 -7 220 -10 686 -24 1088 -59 1490 -131 596 -106
                                                    1167 -323 1575 -597 418 -280 839 -729 1072 -1142 229 -406 401 -911 492
                                                    -1445 72 -424 99 -785 136 -1825 38 -1052 38 -5765 0 -6810 -33 -933 -55
                                                    -1260 -106 -1630 -105 -752 -343 -1413 -677 -1884 -258 -363 -633 -721 -993
                                                    -949 -110 -69 -324 -180 -458 -237 -634 -271 -1270 -390 -2291 -430 -77 -3
                                                    -174 -8 -215 -10 -41 -2 -172 -7 -290 -11 -118 -3 -237 -8 -265 -9 -429 -26
                                                    -6304 -26 -6520 -1 -16 2 -142 7 -280 11 -137 3 -268 8 -290 10 -22 2 -114 7
                                                    -205 10 -385 14 -712 40 -1005 81 -847 119 -1533 388 -2060 810 -146 117 -437
                                                    410 -556 559 -438 549 -705 1255 -818 2165 -40 316 -63 698 -91 1520 -38 1075
                                                    -38 5751 0 6805 37 1040 64 1401 136 1825 83 491 236 958 439 1347 287 551
                                                    825 1096 1370 1388 648 348 1380 516 2460 565 127 5 271 12 320 15 50 2 187 7
                                                    305 11 118 3 238 8 265 9 28 2 336 6 685 10 349 4 637 9 639 11 5 5 4682 -5
                                                    4761 -10z"/>
                                                    <path d="M16510 17853 c-240 -21 -430 -87 -623 -216 -99 -66 -239 -199 -304
                                                    -287 -318 -437 -333 -1007 -38 -1455 77 -116 234 -273 349 -349 584 -385 1360
                                                    -231 1747 346 143 215 212 442 212 703 1 679 -534 1234 -1213 1258 -52 2 -111
                                                    2 -130 0z"/>
                                                    <path d="M10805 16383 c-146 -5 -448 -33 -612 -58 -983 -149 -1881 -555 -2663
                                                    -1205 -152 -127 -491 -463 -625 -620 -655 -770 -1076 -1690 -1229 -2690 -79
                                                    -513 -79 -1108 0 -1620 173 -1122 676 -2133 1464 -2944 1130 -1162 2703 -1748
                                                    4325 -1611 1116 95 2177 539 3035 1271 148 126 468 446 594 594 583 683 991
                                                    1512 1175 2385 130 618 150 1299 56 1922 -176 1162 -722 2225 -1566 3048
                                                    -1059 1032 -2459 1573 -3954 1528z m595 -1917 c258 -32 486 -83 720 -162 1210
                                                    -409 2107 -1461 2319 -2719 36 -213 45 -335 45 -585 0 -250 -9 -372 -45 -585
                                                    -183 -1087 -879 -2029 -1868 -2529 -1086 -549 -2386 -490 -3419 155 -147 91
                                                    -367 258 -504 383 -568 516 -961 1236 -1087 1991 -36 215 -45 336 -45 585 0
                                                    250 9 372 45 585 128 761 512 1465 1084 1988 576 526 1303 842 2090 907 146
                                                    12 521 4 665 -14z"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <script>
                            $( document ).ready(function(){
                                $( ".dropdown-item" ).hover(function(){ // задаем функцию при наведении курсора на элемент	
                                    $( this ).attr( "style", "background-color: rgba(255, 255, 255, .7);" ) ; 
                                }, function(){ // задаем функцию, которая срабатывает, когда указатель выходит из элемента 	
                                    $( this ).attr( "style", "color:white" ) ; 
                                });
                            });
                        </script>
                        <main>
                            <div class="form-row">
                                <div class="container" style="max-width:960px; padding:10px;">
                                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                      <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="https://blog.nav-com.ru/">Главная</a></li>
                                        <li class="breadcrumb-item"><a href="https://blog.nav-com.ru/<? echo $linkParent; ?>"><? echo getReplacedText($nameParent); ?></a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><? echo getReplacedText($name); ?></li>
                                      </ol>
                                    </nav>
                                    <h1 class="display-5">
                                        <?
                                            echo getReplacedText($name);
                                        ?>
                                    </h1>
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <p style="width:auto;">Опубликовано: <? echo $displayDatePost; ?></p>
                                        <div class="d-flex justify-content-end align-items-center" style="width:auto;">
                                            <div class="fb-share-button d-flex align-items-center" data-href="https://blog.nav-com.ru/<? echo $link; ?>" data-layout="button_count" data-size="small" style="width:150px;">
                                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fblog.nav-com.ru%2F<? echo $link; ?>%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                                    Поделиться
                                                </a>
                                            </div>
                                            <script type="text/javascript"><!--
                                                document.write(VK.Share.button(false,{type: "round", text: "Поделиться"}));
                                            --></script>
                                        </div>
                                    </div>
                                    <hr>
                                    <?
                                        echo getReplacedText($text);
                                    ?>
                                    <br>
                                    <figure class="text-end">
                                        <p class="lead"><left>Автор: <b><? echo $author; ?></b></left></p>
                                    </figure>
                                    <br>
                                    <!-- Put this div tag to the place, where the Comments block will be -->
                                    <div id="vk_comments"></div>
                                    <script type="text/javascript" defer>
                                        VK.Widgets.Comments("vk_comments", {limit: 5, attach: "*"});
                                    </script>
                                    
                                </div>
                                <div class="album py-5 bg-light">
                                        <div class="container">
                                            <h2>Другие наши статьи</h2>
                                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                                <?
                                                    $q1 = "SELECT name_post, date_post, link_rewrite, LENGTH(text) as length, img_back FROM posts WHERE link_rewrite<>'".$link."' ORDER BY date_post DESC LIMIT 3";
                                                    $res = mysqli_query($db1, $q1); 
                                                    while ($row = mysqli_fetch_array($res)){
                                                        $name_post      = $row['name_post'];
                                                        $date_post      = $row['date_post'];
                                                        $link_rewrite   = $row['link_rewrite'];
                                                        $length         = $row['length'];
                                                        $img_back       = $row['img_back'];
                                                        ?>
                                                            <div class="col">
                                                                <div class="card shadow-sm">
                                                                    <img class="bd-placeholder-img card-img-top" data-src="https://blog.nav-com.ru/img/posts/<? echo $img_back; ?>" width="30em" height="auto"  onError="this.src='https://blog.nav-com.ru/img/posts/default-post.png'">
                                                                    <div class="card-body">
                                                                        <p class="card-text">
                                                                            <? echo getReplacedText($name_post); ?>
                                                                        </p>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div class="btn-group">
                                                                                <a type="button" class="btn btn-sm btn-outline-secondary" href="https://blog.nav-com.ru/<? echo $link_rewrite ?>">
                                                                                    Читать
                                                                                </a>
                                                                            </div>
                                                                            <small class="text-muted">
                                                                                <? echo round($length/1500)+1; ?> мин
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </main>
                        <footer class="text-muted py-5">
                            <div class="container">
                                <p class="mb-1">
                                    <? 
                                        $nowYear = date(Y);
                                        $textYear = '';
                                        if ($nowYear == 2021) $textYear = "2021"; else $textYear = "2021-".$nowYear;
                                    ?>
                                    &copy; NAV-com, <? echo $textYear; ?>
                                </p>
                            </div>
                        </footer>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
                        <script>
                            [].forEach.call(document.querySelectorAll('img[data-src]'), function(img) {
                                img.setAttribute('src', img.getAttribute('data-src'));
                                img.onload = function() {
                                    img.removeAttribute('data-src');
                                };
                            });
                         </script>
                    </body>
                </html>
            <?
        } else {
            header("Location: https://blog.nav-com.ru/"); 
        }
    } else {
        ?>
        <!doctype html>
        <html lang="ru">
            <head>
                <meta name="yandex-verification" content="382e52e64bd7e557" />
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="">
                <meta name="author" content="NAV-com">
                <title>Блог | NAV-com</title>
                <link rel="shortcut icon" href="https://nav-com.ru/img/logo-round.png" type="image/png"> 
                
                <meta name="keywords" content="NAV;блог;Неграш;">
                <meta name="robots" content="index">
                <meta name="og:title" content="Блог | NAV-com">
                <meta name="og:type" content="website">
                <meta name="og:image" content="https://blog.nav-com.ru/img/defaultog.jpg">
                <meta name="og:url" content="https://blog.nav-com.ru/">
                <meta name="og:locale" content="ru_RU">
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                
                <!-- Bootstrap core CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                <meta name="theme-color" content="#7952b3">
                <style>
                    .bd-placeholder-img {
                        font-size: 1.125rem;
                        text-anchor: middle;
                        -webkit-user-select: none;
                        -moz-user-select: none;
                        user-select: none;
                    }
                
                    @media (min-width: 768px) {
                        .bd-placeholder-img-lg {
                            font-size: 3.5rem;
                        }
                    }
                </style>
            </head>
            <body>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="https://nav-com.ru/">
                            <img src="https://nav-com.ru/img/logo-round.png" style="width:40px!important;height:40px!important;">
                            NAV-com
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="https://blog.nav-com.ru/">Главная</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Категории
                                    </a>
                                    <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                        <?
                                        $q2 = "SELECT name, link_rewrite FROM categories WHERE 1";
                                        $res = mysqli_query($db1, $q2); 
                                        while ($row = mysqli_fetch_array($res)){
                                            $nameCat = $row['name'];
                                            $linkCat = $row['link_rewrite'];
                                            ?>
                                                <li><a class="dropdown-item" href="https://blog.nav-com.ru/<? echo $linkCat; ?>" style="color:white;"><? echo $nameCat; ?></a></li>
                                            <?
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                            <div style="padding-right:30px;">
                                <a href="https://vk.com/nav_com" style="margin-right:10px;text-decoration:none;">
                                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000px" height="25.000000px" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                            <path d="M2235 4019 c-336 -12 -449 -46 -528 -159 -26 -37 -21 -48 31 -59 106
                                            -23 181 -75 214 -147 63 -144 80 -491 39 -804 -21 -155 -61 -239 -121 -252
                                            -79 -17 -212 92 -325 266 -90 138 -342 625 -425 821 -52 123 -74 153 -136 185
                                            l-49 25 -400 -3 c-220 -1 -417 -5 -438 -8 -21 -3 -51 -17 -67 -31 -26 -21 -30
                                            -32 -30 -76 0 -42 14 -81 81 -231 253 -562 537 -1059 837 -1465 239 -324 382
                                            -475 583 -617 284 -201 498 -297 754 -339 122 -20 573 -20 628 -1 87 32 108
                                            73 118 241 12 200 57 318 147 388 88 68 175 14 414 -255 158 -178 238 -256
                                            317 -306 61 -39 148 -75 207 -87 46 -8 321 -7 666 4 l247 8 48 29 c55 34 73
                                            63 73 120 0 148 -130 327 -525 719 -292 290 -312 317 -302 408 9 70 41 119
                                            302 467 338 450 450 625 506 789 26 75 25 161 -1 189 -50 53 -57 54 -580 52
                                            -282 0 -500 -5 -522 -11 -51 -13 -78 -50 -128 -175 -24 -60 -88 -197 -142
                                            -304 -199 -398 -432 -723 -565 -787 -29 -15 -34 -14 -70 4 -25 13 -45 35 -60
                                            64 -40 77 -44 168 -32 624 12 451 9 500 -34 584 -12 25 -34 54 -48 64 -38 28
                                            -168 56 -284 62 -55 3 -122 7 -150 9 -27 1 -140 -1 -250 -5z"/>
                                        </g>
                                    </svg>
                                </a>
                                <a href="https://www.instagram.com/nav_com.ru/" style="text-decoration:none;">
                                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="25.000000px" height="25.000000px" viewBox="0 0 2200.000000 2200.000000" preserveAspectRatio="xMidYMid meet">
                                        <g transform="translate(0.000000,2200.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                            <path d="M8410 21477 c-3 -2 -198 -7 -435 -11 -236 -4 -446 -8 -465 -10 -19
                                            -3 -132 -7 -250 -11 -118 -3 -242 -8 -275 -10 -33 -2 -127 -7 -210 -10 -1266
                                            -51 -2209 -261 -3090 -689 -392 -190 -698 -389 -1055 -685 -143 -118 -533
                                            -507 -665 -661 -543 -639 -924 -1409 -1154 -2335 -184 -743 -249 -1495 -282
                                            -3250 -14 -762 -6 -5755 10 -6165 47 -1219 66 -1502 132 -1965 161 -1129 554
                                            -2122 1137 -2870 228 -292 541 -618 827 -861 367 -312 828 -595 1290 -792 837
                                            -357 1709 -533 2860 -577 83 -3 177 -8 210 -10 33 -3 152 -7 265 -11 113 -3
                                            225 -8 250 -10 343 -27 6730 -27 6980 1 19 2 132 6 250 10 118 3 242 8 275 10
                                            33 2 128 7 210 10 1259 50 2204 260 3080 684 559 271 1006 597 1470 1072 424
                                            434 713 841 966 1364 292 604 484 1249 588 1980 66 463 87 777 132 1970 16
                                            417 24 5400 10 6160 -26 1387 -73 2129 -172 2720 -150 889 -467 1732 -891
                                            2369 -378 568 -920 1113 -1484 1493 -680 458 -1549 781 -2494 927 -421 65
                                            -802 97 -1445 121 -82 3 -179 8 -215 10 -36 2 -175 7 -310 10 -135 4 -276 9
                                            -315 12 -80 7 -5728 16 -5735 10z m5410 -1901 c36 -2 207 -7 380 -10 173 -4
                                            342 -9 375 -11 33 -2 132 -7 220 -10 686 -24 1088 -59 1490 -131 596 -106
                                            1167 -323 1575 -597 418 -280 839 -729 1072 -1142 229 -406 401 -911 492
                                            -1445 72 -424 99 -785 136 -1825 38 -1052 38 -5765 0 -6810 -33 -933 -55
                                            -1260 -106 -1630 -105 -752 -343 -1413 -677 -1884 -258 -363 -633 -721 -993
                                            -949 -110 -69 -324 -180 -458 -237 -634 -271 -1270 -390 -2291 -430 -77 -3
                                            -174 -8 -215 -10 -41 -2 -172 -7 -290 -11 -118 -3 -237 -8 -265 -9 -429 -26
                                            -6304 -26 -6520 -1 -16 2 -142 7 -280 11 -137 3 -268 8 -290 10 -22 2 -114 7
                                            -205 10 -385 14 -712 40 -1005 81 -847 119 -1533 388 -2060 810 -146 117 -437
                                            410 -556 559 -438 549 -705 1255 -818 2165 -40 316 -63 698 -91 1520 -38 1075
                                            -38 5751 0 6805 37 1040 64 1401 136 1825 83 491 236 958 439 1347 287 551
                                            825 1096 1370 1388 648 348 1380 516 2460 565 127 5 271 12 320 15 50 2 187 7
                                            305 11 118 3 238 8 265 9 28 2 336 6 685 10 349 4 637 9 639 11 5 5 4682 -5
                                            4761 -10z"/>
                                            <path d="M16510 17853 c-240 -21 -430 -87 -623 -216 -99 -66 -239 -199 -304
                                            -287 -318 -437 -333 -1007 -38 -1455 77 -116 234 -273 349 -349 584 -385 1360
                                            -231 1747 346 143 215 212 442 212 703 1 679 -534 1234 -1213 1258 -52 2 -111
                                            2 -130 0z"/>
                                            <path d="M10805 16383 c-146 -5 -448 -33 -612 -58 -983 -149 -1881 -555 -2663
                                            -1205 -152 -127 -491 -463 -625 -620 -655 -770 -1076 -1690 -1229 -2690 -79
                                            -513 -79 -1108 0 -1620 173 -1122 676 -2133 1464 -2944 1130 -1162 2703 -1748
                                            4325 -1611 1116 95 2177 539 3035 1271 148 126 468 446 594 594 583 683 991
                                            1512 1175 2385 130 618 150 1299 56 1922 -176 1162 -722 2225 -1566 3048
                                            -1059 1032 -2459 1573 -3954 1528z m595 -1917 c258 -32 486 -83 720 -162 1210
                                            -409 2107 -1461 2319 -2719 36 -213 45 -335 45 -585 0 -250 -9 -372 -45 -585
                                            -183 -1087 -879 -2029 -1868 -2529 -1086 -549 -2386 -490 -3419 155 -147 91
                                            -367 258 -504 383 -568 516 -961 1236 -1087 1991 -36 215 -45 336 -45 585 0
                                            250 9 372 45 585 128 761 512 1465 1084 1988 576 526 1303 842 2090 907 146
                                            12 521 4 665 -14z"/>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
                <script>
                    $( document ).ready(function(){
                        $( ".dropdown-item" ).hover(function(){ // задаем функцию при наведении курсора на элемент	
                            $( this ).attr( "style", "background-color: rgba(255, 255, 255, .7);" ) ; 
                        }, function(){ // задаем функцию, которая срабатывает, когда указатель выходит из элемента 	
                            $( this ).attr( "style", "color:white" ) ; 
                        });
                    });
                </script>
                <main>
                    <section class="py-5 text-center container">
                        <div class="row py-lg-5">
                            <div class="col-lg-6 col-md-8 mx-auto">
                                <h1 class="fw-light">
                                    <?
                                        $now = array(date(m),date(Y));
                                        $birthday = array(3, 2018);
                                        $years = $now[1] - $birthday[1];
                                        if ($now[0] < $birthday[0]) $years--;
                                    ?>
                                    NAV-com 
                                </h1>
                                <p class="lead text-muted">
                                    Уже более <? echo $years; ?> лет занимаемся созданием сайтов и мобильных приложений к ним. 
                                    А в конце 2020 года было принято решение создать блог со справочными статьями, которые помогут программистам всех уровней разрабатывать качественное ПО.
                                </p>
                                <p>
                                    <a href="#" class="btn btn-primary rounded-pill">Заказать сайт в NAV-com</a>
                                </p>
                            </div>
                        </div>
                    </section>
                
                    <div class="album py-5 bg-light">
                        <div class="container">
                            <h2 class="display-5">Категории блога</h2>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                <?
                                    $q1 = "SELECT c.name, c.link_rewrite, c.img_back, (SELECT COUNT(*) FROM posts as p WHERE p.id_category=c.id_category) as articles FROM categories as c ORDER BY c.name DESC";
                                    $res = mysqli_query($db1, $q1); 
                                    while ($row = mysqli_fetch_array($res)){
                                        $nameCategory       = $row['name'];
                                        $linkCategory       = $row['link_rewrite'];
                                        $imgCategory        = $row['img_back'];
                                        $countPosts         = $row['articles'];
                                        $toCP = " статей";
                                        $fuckingRussin = array(11,12,13,14);
                                        if (!in_array($countPosts%100, $fuckingRussin)) {
                                            if ($countPosts%10 > 1 && $countPosts%10 < 5){
                                                $toCP = " статьи";
                                            }
                                            if ($countPosts%10 == 1) $toCP = " статья";
                                        }
                                        ?>
                                            <div class="col">
                                                <div class="card shadow-sm">
                                                    <img class="bd-placeholder-img card-img-top" src="https://blog.nav-com.ru/img/categories/<? echo $imgCategory; ?>" width="30em" height="auto"  onError="this.src='https://blog.nav-com.ru/img/categories/default-category.jpg'">
                                                    <div class="card-body">
                                                        <p class="card-text">
                                                            <? echo $nameCategory; ?>
                                                        </p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="btn-group">
                                                                <a type="button" class="btn btn-sm btn-outline-secondary" href="https://blog.nav-com.ru/<? echo $linkCategory ?>">
                                                                    Просмотр
                                                                </a>
                                                            </div>
                                                            <small class="text-muted">
                                                                <? echo $countPosts.$toCP; ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="album py-5 bg-light">
                        <div class="container">
                            <h2 class="display-5">Последние статьи</h2>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                                <?
                                    $q1 = "SELECT name_post, date_post, link_rewrite, LENGTH(text) as length, img_back FROM posts ORDER BY date_post DESC LIMIT 6";
                                    $res = mysqli_query($db1, $q1); 
                                    while ($row = mysqli_fetch_array($res)){
                                        $name_post      = $row['name_post'];
                                        $date_post      = $row['date_post'];
                                        $link_rewrite   = $row['link_rewrite'];
                                        $length         = $row['length'];
                                        $img_back       = $row['img_back'];
                                        ?>
                                            <div class="col">
                                                <div class="card shadow-sm">
                                                    <img class="bd-placeholder-img card-img-top" src="https://blog.nav-com.ru/img/posts/<? echo $img_back; ?>" width="30em" height="auto" onError="this.src='https://blog.nav-com.ru/img/posts/default-post.png'">
                                                    <div class="card-body">
                                                        <p class="card-text">
                                                            <? echo $name_post; ?>
                                                        </p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="btn-group">
                                                                <a type="button" class="btn btn-sm btn-outline-secondary" href="https://blog.nav-com.ru/<? echo $link_rewrite ?>">
                                                                    Читать
                                                                </a>
                                                            </div>
                                                            <small class="text-muted">
                                                                <? echo round($length/1500)+1; ?> мин
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
                
                <footer class="text-muted py-5">
                    <div class="container">
                        <p class="mb-1">
                            <? 
                                $nowYear = date(Y);
                                $textYear = '';
                                if ($nowYear == 2021) $textYear = "2021"; else $textYear = "2021-".$nowYear;
                            ?>
                            &copy; NAV-com, <? echo $textYear; ?>
                        </p>
                    </div>
                </footer>
                
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
                
            </body>
        </html>
        <?
    }
?>
    
