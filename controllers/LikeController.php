<?php

session_start();
// замінити на коремий контролел додавання лайків
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/CartModel.php');

if(isset($_REQUEST['id'])){
    //var_dump($_REQUEST['id']);

    $status = [];
    $data = json_decode($_POST['id'], true);

    if(!isset($_SESSION['like']) ){
        $_SESSION['like'] = [];
    }

    if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])){
        $sessionUser = $_SESSION['user_id'] ?? null;
        $cookieUser = $_COOKIE['user_id'] ?? null;

        $user_id = $sessionUser ?? $cookieUser;

        if(isset($_SESSION['like']) && array_search($data, $_SESSION['like']) === false){
            $sql = "INSERT INTO `likes` (`id_user`, `id_product`)
            VALUES (:id_user, :id_product)";
            $params = [
                'id_user' => $user_id,
                'id_product' => $data
            ];

            dbRequest($sql, $params);
            $_SESSION['like'][] = $data; 
            $status['result'] = 1;
        }else{
            
            foreach ($_SESSION['like'] as $key => $value){
                if ($_SESSION['like'][$key] == $data){
                    unset($_SESSION['like'][$key]);
                    $sql = "DELETE FROM `likes` WHERE `id_product` =:id_product";
                    $params = [
                        'id_product' => $data
                    ];
                    dbRequest($sql, $params);
                    $status['del'] = 1;
                }
            }
        }
        
        echo json_encode($status);

    }else{
        if (isset($_SESSION['like']) && array_search($data, $_SESSION['like']) === false){
            $_SESSION['like'][] = $data;
        }
    
        $status['result'] = 1;
        echo json_encode($status);
        exit();
    }
}
