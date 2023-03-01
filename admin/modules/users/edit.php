<?php

if(!empty($_POST)) {

        $sql = "UPDATE products SET `name` = :name, 
        `slug` = :slug,
        `content` = :content
        WHERE `id` = :id";

        $params = [
            'name' => $_POST['name'],
            'slug' => $_POST['slug'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ];

        $result = $db->prepare($sql);

         if ($result->execute($params)) {
             header("Location: /admin/products.php");
             exit();
        } else {
            echo "Error: " . $sql . "<br>" . $db->errorInfo();
        }
  
}

$sql = "SELECT * FROM products WHERE  id = :id";


$result = $db->prepare($sql);
$result->execute(['id' => $_GET['id']]);
$rows = $result->fetchAll();


?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
    </div>

<div class="card-body">
<?php foreach ($rows as $key => $row): ?>
<form action="?page=edit&id=<?= $_GET['id']; ?>" method="POST" class="form"><!-- через GET парамтр редірект ?page=edit&id=  -->

            <div class="mb-3">
                <label for="user" class="form-label">Title</label>
                <input type="text" name="name" class="form-control" id="title" placeholder="Enter your title"  value="<?php echo $row['name'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter your slug"  value="<?php echo $row['slug']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="product" class="form-label">Content</label>
                <input type="text" name="content" class="form-control" id="content" placeholder="Enter your content"  value="<?php echo $row['content']; ?>" required>
            </div>

            <button type="submit" class="btn btn-success btn-lg">Edit</button><!-- btn-lg робить кнопку більшою -->
        </form>
</div>
<?php endforeach; ?>

