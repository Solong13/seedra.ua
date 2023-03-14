<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/CartModel.php');

    if(isset($_REQUEST['id'])){

        $status = [];
        $data = json_decode($_POST['id'], true);

        if(!isset($_SESSION['cart']) ){
            $_SESSION['cart'] = [];
        }

        if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])){
            $sessionUser = $_SESSION['user_id'] ?? null;
            $cookieUser = $_COOKIE['user_id'] ?? null;

            $user_id =  $sessionUser ?? $cookieUser;

            if (isset($_SESSION['cart']) && array_search($data, $_SESSION['cart']) === false){
                $sql = "INSERT INTO cart ( `id_user`, `id_product`) 
                VALUES (:id_user, :id_product)";
                $params = [
                    'id_user' => $user_id,
                    'id_product' => $data
                ];
                dbRequest($sql, $params);

                $_SESSION['cart'][] = $data;
            }
            $status['message'] = "Added to cart";
            $status['cart'] = count($_SESSION['cart']);
            $status['result'] = 1;

            echo json_encode($status);
        }else{

            if (isset($_SESSION['cart']) && array_search($data, $_SESSION['cart']) === false){
                $_SESSION['cart'][] = $data;
            }
            $status['message'] = "Added to cart";
            $status['cart'] = count($_SESSION['cart']);
            $status['result'] = 1;

            echo json_encode($status);
            exit();
        }// дод функціонал для анрег

    }else{
        $status['error'] = 'error';
        echo json_encode($status, JSON_UNESCAPED_UNICODE);
    }

