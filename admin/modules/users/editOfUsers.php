<?php

if(!empty($_POST)) {

        $sql = "UPDATE `users` SET `user` = :user,`Email` = :Email,`Password` = :Password,`role` = :role  WHERE `id` = :id";

        $params = [ 'user' => $_POST['user'],
            'Email' => $_POST['Email'],
            'Password' => $_POST['Password'],
            'role' => $_POST['role'],
            'id' => $_GET['id']
        ];

        $editUserInfo = $db->prepare($sql);
        $stmnt = $editUserInfo->execute($params);

         if ($stmnt) {
             header("Location: /admin/users.php");
             exit();
         } else {
            echo "Error: " . $sql . "<br>" . $db->errorInfo();
        }
  
}

$sql = "SELECT * FROM users WHERE id = :id";// не показувати користовачів приховуючи ззаписи
$result = $db->prepare($sql);
$result->execute(['id' => $_GET['id']]);
// виводить єдиний запис
$row = $result->fetch();

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
    </div>

<div class="card-body">
<form action="?page=edit&id=<?= $_GET['id']; ?>" method="POST" class="form"><!-- через GET парамтр редірект ?page=edit&id=  -->
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <input type="text" name="user" class="form-control" id="title" placeholder="Enter your user"  value="<?php echo $row['user'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Email</label>
                <input type="text" name="Email" class="form-control" id="slug" placeholder="Enter your Email"  value="<?php echo $row['Email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Password</label>
                <input type="text" name="Password" class="form-control" id="content" placeholder="Enter your Password"  value="<?php echo $row['Password']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Role</label>
                <input type="text" name="role" class="form-control" id="img" placeholder="Enter your role"  value="<?php echo $row['role']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success btn-lg">Edit</button><!-- btn-lg робить кнопку більшою -->
        </form>
</div>


