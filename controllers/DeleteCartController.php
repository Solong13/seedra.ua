<?php
session_start();

if(isset($_REQUEST['id']) == $_REQUEST['id']){
    $productId = $_REQUEST['id'];
   foreach ($_SESSION['cart'] as $key => $value){
        if ($_SESSION['cart'][$key] == $productId){
            unset($_SESSION['cart'][$key]);
        }
   }
    echo count(array_keys($_SESSION['cart']));
}else{
    echo 'Error';
}
//echo  json_encode($_SESSION['cart']);
//var_dump($_SESSION['cart']);
//var_dump($_SESSION['cart']);

