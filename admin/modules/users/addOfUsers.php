<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

if(!empty($_POST)) {
        $sql = "INSERT INTO `users` (`user`, `Email`, `Password`, 
        `role`) VALUES (:user, :Email, :Password, :role)";

        $params = [
            'user' => $_POST['user'],
            'Email' => $_POST['Email'],
            'Password' => $_POST['Password'],
            'role' => $_POST['role']
        ];

        $addUser = $db->prepare($sql);
        $stmnt = $addUser->execute($params);
        if ($stmnt) {
            header("Location: /admin/users.php");
            exit();
        	//echo "<center><h2>Дані оновлено. <a href='/admin/users.php'>Повернутися</a></h2></center>";
        } else {
            echo "Error: " . $sql . "<br>" . $db->errorInfo();
        }


}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User List</h6>
    </div>

<div class="card-body">
<form action="?page=add" method="POST" class="form"><!-- через GET парамтр редірект ?page=edit&id=  -->
<div class="mb-3">
                <label for="user" class="form-label">User</label>
                <input type="text" name="user" class="form-control" id="ustitleer" placeholder="Enter your user"   required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Email</label>
                <input type="text" name="Email" class="form-control" id="slug" placeholder="Enter your Email"  required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Password</label>
                <input type="text" name="Password" class="form-control" id="user_id" placeholder="Enter your Password"  required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Role</label>
                <input type="text" name="role" class="form-control" id="user_id" placeholder="Enter your role"  required>
            </div>
            
            <button type="submit" class="btn btn-success btn-lg">Add</button><!-- btn-lg робить кнопку більшою -->
        </form>
</div>