<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/Reviwes.php');


    function writeReview(array $fields):bool{
        $sql = "INSERT INTO reviews (`id_user`, `text`) VALUES (:id_user, :text)";
        dbRequest($sql, $fields);
        return true;
    }