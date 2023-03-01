<?php
require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

$visibility = true;
$visibility_all = false;
if(!empty($_POST)) {
/*
    Створити єдину сторінку запиту
    та спочатку виконувати запит товару потім його категорію
*/
    ?>
    <?php
    //INSERT INTO `catalog` (`id`, `id_product`, `id_category`, `price`, `img`, `imageLike`)
    // VALUES (NULL, '7', '1', '12.56', 'fddddddddddddddd', 'fddddddddddddddddd');
        $sql = "INSERT INTO products (`name`, `slug`, `content`)
        VALUES (:name, :slug, :content)";

        $params = [
                'name' => $_POST['name'],
                'slug' => $_POST['slug'],
                'content' => $_POST['content']
        ];

        $res = $db->prepare($sql);
        $res->execute($params);

        if($res) {


//                $visibility = false;
//
//                $visibility_all = true;
//                $sql = "SELECT * FROM category";
//                $getCatalog = $db->prepare($sql);
//                $getCatalog->execute();
//                $catal = $getCatalog->fetchAll();
//
//                $sql2 = "SELECT * FROM products";
//                $getProducts = $db->prepare($sql2);
//                $getProducts->execute();
//                $prod = $getProducts->fetchAll();
//
//                $namePhoto = $_FILES['images'];
//                var_dump($_POST['id_category']);
//            var_dump($_POST['id_product']);
//                var_dump($namePhoto);
//                $path = $_SERVER['DOCUMENT_ROOT'].'/assets/img/';
//
//                if( $namePhoto['error'] == 0){
//                    move_uploaded_file($namePhoto['tmp_name'], $path.$namePhoto['name']);
//                }
//
//




            header("Location: /admin/products.php");
            exit();
       } else {
            echo "Error: " . $sql . "<br>" . $db->errorInfo();
        }
}
?>



<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
    </div>

    <div class="card-body">
        <form action="?page=add" method="POST" class="form"><!-- через GET парамтр редірект ?page=edit&id=  -->
            <div class="mb-3">
                <label for="user" class="form-label">Title</label>
                <input type="text" name="name" class="form-control" id="ustitleer" placeholder="Enter your name product"   required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter your slug"  required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Content</label>
                <input type="text" name="content" class="form-control" id="user_id" placeholder="Enter your content"  required>
            </div>

            <button type="submit" class="btn btn-success btn-lg">Add</button><!-- btn-lg робить кнопку більшою -->
        </form>
    </div>
