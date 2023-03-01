<?php
//$servername = "localhost";
//$database = "seedra";
//$username = "root";
//$password = "";
//
//$conn = mysqli_connect($servername, $username, $password, $database);
//
//$conn->set_charset("utf8");
//
//if(!$conn){
//    die("Conection failed: " . mysqli_connect_error());
//}
////echo "Connected successfully!";
static $db;
$db = new PDO('mysql:host=localhost; dbname=seedra', 'root', '');
return $db;
//$sql = "SELECT * FROM users";
////Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
//$statment = $db->prepare($sql);
//// mетод execute() параметры и их значения в виде ассоциативного массива:
//$statment->execute();
////Выбирает оставшиеся строки из набора результатов
//$data = $statment->fetchAll();
//var_dump($data);