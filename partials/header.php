<?php
    session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

$is_session = isset($_SESSION['user_id']) && $_SESSION['user_id'] != null;
$is_cookie = isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != null;

    if($is_session || $is_cookie) {

        $userID = $is_session ? $is_session  : $is_cookie;
    // вибираємо де вибраний айді буде дорівнювати нашому айді через сесію. Тобто шукаємо по id
        $sql = "SELECT * FROM users WHERE id=" . $userID;
        $result = $db->prepare($sql);// виконання запросу
        $result->execute();
        //$user = $result->fetchAll();// вивід всіх даних, а саме сесії

    } else {
        header("Locaton: /index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seedra</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/forLog.css">
    <link rel="stylesheet" href="/assets/css/adptive.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/sass/cart.scss">
    <link rel="stylesheet" href="/assets/slick/slick.css">
    <link rel="stylesheet" href="/assets/slick/slick-theme.css">
</head>
<body>
    <header class="header" id="header">
        <div class="wrraper">
            <div class="nav">
                
                <a href="/index.php"><img src="/assets/img/Logo.svg" alt="Seedra" class="logo"></a> 
                <div class="header_burger">
                    <span></span>
                </div>
                <nav class="header__menu">
                    <ul class="menu">
                        <li class="all"> <a href="#">ALL PRODUCTS</a></li>
                        <div class="vl"></div>
                        <li class="all"><a href="#">ABOUT SEEDRA</a></li>
                        <div class="vl"></div>
                        <li class="all"><a href="#">OUR BLOG</a></li>
                        <div class="vl"></div>
                        <li class="status"><a href="/partials/login.php" class="last">LOGIN</a>
                            
                                <?php
                                if($is_session || $is_cookie) { 
                                    $userID = $is_session ? $_SESSION['user_id'] : $_COOKIE['user_id'];

                                    $sql = "SELECT * FROM users WHERE id=" . $userID;// не показувати користовачів приховуючи ззаписи
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $row = $result->fetchAll();

                                    foreach ($row as $key => $valueLog):?>

                                
                                    <ul class="admin-status">
                                    <li class="status-us"><?php echo $valueLog['user'] ?></li>
                                    <div class="v3"></div>
                                    <li class="status-us"><?php echo $valueLog['role'] ?></li>
                                    <div class="v3"></div>
                                    <li> <a href="/partials/logout.php">LOGOUT</a></li>

                                    <?php
                                        if($valueLog['role'] == "admin") {
                                    ?>
                                        <li class="adminControl"><a href="admin">Admin Control</a></li>
                                    
                                    <?php
                                        }
                                    ?>
                                    </ul>
                                    <?php endforeach; ?>
                                <?php } ?>
                        </li>
                    </ul>
                </nav>

                <a href="#" class="likeInst">
                    <div class="contacts"></div>
                </a>

                <a href="#" class="likeFace">
                    <div class="contactsFace"></div>
                </a>
                
                 <div class="search-box">
                    <form action="" method="GET" class="formForSearch">
                        <button>
                            <a class="search-btn" href="#" name="search" value="search">
                                <img src="/assets/img/search.png" alt="">
                            </a>
                        </button>
                        <input class="search-txt" type="text" name="search" placeholder="Search">
                    </form>
                </div>

                <div class="like-cart">
                    <a href="/partials/like.php" class="likeLink"><img src="/assets/img/heart.png" alt=""></a>
                    <a href="/partials/cart.php" class="cartLink"><img src="/assets/img/icon_cart_simple .png" alt=""></a>
                       <span id="count_products_cart"><?= isset($_SESSION['cart']) ? count(array_keys($_SESSION['cart'])) : null ?></span>
                </div>
            </div>
        </div>
    </header >
 
