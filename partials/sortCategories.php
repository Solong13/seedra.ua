<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
session_start();

$category = $_GET['category'];
var_dump($category);

if(!empty($_GET['category'])){
    $sql = "";
}