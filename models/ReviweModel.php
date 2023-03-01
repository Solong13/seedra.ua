<?php

 include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

var_dump($db);
function dbRequest(string $sql, $params = []): PDOStatement{



global $db;



        $sendReview = $db->prepare($sql);
        $sendReview->execute($params);

        return $sendReview;
    }
$sql = "INSERT INTO reviews (`id_user`, `text`) VALUES (:id_user, :text)";
$params = ['id_user' => 15,
    'text' => 'sssfsdfsd'
];
dbRequest($sql, $params);