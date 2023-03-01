<?php

 include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');


    function dbRequest(string $sql, $params = []): PDOStatement{
    global $db;

    $sendReview = $db->prepare($sql);
    $sendReview->execute($params);
    return $sendReview;
    }
