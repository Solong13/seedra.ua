<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/CartModel.php');


if(isset($_REQUEST['id']) == $_REQUEST['id']){

    $delete_status = [];

   $productId = $_REQUEST['id'];
   foreach ($_SESSION['cart'] as $key => $value){
        if ($_SESSION['cart'][$key] == $productId){
            unset($_SESSION['cart'][$key]);
            $sql = "DELETE FROM `cart` WHERE `id_product` =:id_product";
            $params = [
                'id_product' => $productId
            ];
            dbRequest($sql, $params);
        }
   }
    $delete_status['cart'] = count(array_keys($_SESSION['cart']));

    $delete_status['result'] = 1;
    echo json_encode($delete_status);
}else{
    $delete_status['error'] = "Помилка при замовленні";
    echo json_encode($delete_status, JSON_UNESCAPED_UNICODE);
}

//$id_products_cart = implode(',', $_SESSION['cart']);

// Вивід кількості товарів
//$getProducts = getProductsFromArray($id_products_cart);

// Вивід загальної суми товарів в корзині
//$allPrice = check($id_products_cart);


