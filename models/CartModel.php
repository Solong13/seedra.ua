<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
// Вивід кількості товарів
function getProductsFromArray(string $itemsIds):array
{
    global $db;

    $sql = "SELECT COUNT(id_product) FROM catalog 
    JOIN products ON catalog.id_product = products.id 
    WHERE products.id IN($itemsIds)";

    $result = $db->prepare($sql);
    $result->execute();
    return $result->fetchAll();
}

// Вивід загальної суми товарів в корзині
function check(string $id):array{
    global $db;

    $sql = "SELECT SUM(price) FROM catalog 
    JOIN products ON catalog.id_product = products.id WHERE products.id IN($id)";

    $result = $db->prepare($sql);
    $result->execute();
    return  $result->fetchAll();
}

function dbRequest(string $sql, $params = []): PDOStatement{
    global $db;

    $sendReview = $db->prepare($sql);
    $sendReview->execute($params);
    return $sendReview;
}
