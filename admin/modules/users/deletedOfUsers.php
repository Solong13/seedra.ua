<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

if(!empty($_GET)) {

    $id = intval($_GET['id']);

    $sql = 'DELETE FROM users WHERE id =:id';

    $delUser = $db->prepare($sql);
    $stmnt =  $delUser->execute(['id' => $id]);
         if ($stmnt) {
             header("Location: /admin/users.php");
             exit();
         } else {
             echo "Error: " . $sql . "<br>" . $db->errorInfo();
         }
    $db = null;
}


