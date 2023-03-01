<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

if(!empty($_GET)) {

    $sql = "DELETE FROM products WHERE id = :id";

    $result = $db->prepare($sql);
    $stmnt = $result->execute(['id' => $_GET['id']]);

         if ($stmnt) {
             header("Location: /admin/products.php");
         } else {
             echo "Error: " . $sql . "<br>" . $db->errorInfo();
         }
    $db = null;
}
?>

