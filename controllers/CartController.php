<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seedra</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css"
          integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/forLog.css">
    <link rel="stylesheet" href="/assets/css/adptive.css">
    <link rel="stylesheet" href="/assets/css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/sass/cart.scss">
</head>
<?php
//$itemId = isset($_POST['id']) ? intval($_POST['id']) : null;
//if(! $itemId) return false;
//
//
//// дані які при додавати в корзину
//$resData = array();
//
//// якщо значення не знайдене, ми його додаєм
//if(isset($_SESSION['cart']) && array_search($itemId,
//        $_SESSION['cart']) === false) {
//    $_SESSION['cart'][] = $itemId;
//    // вивід кількості товарів в корзині
//    $resData['cntItems'] = count($_SESSION['cart']);
//    // функція відпрацювала - товар доданий
//    $resData['success'] = 1;
//} else{
//    $resData['success'] = 0;
//}
//
//// Возвращает JSON-представление данных , а потім будемо передавати їх в JS
//echo  json_encode($resData);


if(isset($_REQUEST['id'])){

    $data = json_decode($_POST['id'], true);

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart']) && array_search($data, $_SESSION['cart']) === false){
        $_SESSION['cart'][] = $data;
    }
    echo count($_SESSION['cart']);
}

