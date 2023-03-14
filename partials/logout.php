<?php
session_start();

if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != null) {
    $_SESSION["user_id"] = NULL; //так стираємо нашу сесію присвоюючи їй нічого NULL
    $_SESSION['cart'] = NULL;
    header("Location: /index.php");
}

if(isset($_COOKIE["user_id"]) && $_COOKIE["user_id"] != null) {
    setcookie('user_id', '', 0, '/');; //так стираємо нашi cookie 
    header("Location: /index.php");
}