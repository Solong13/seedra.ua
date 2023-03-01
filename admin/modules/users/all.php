<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Products List | Add Product
            <a href="?page=add" class="btn btn-info float-end"><i class="fas fa-journal-whills"></i></a>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Content</th>
                    <th>Img</th>
                    <th>Price</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // не показувати користовачів приховуючи ззаписи
                $sql = "SELECT price, img, products.* FROM catalog 
                        JOIN products ON catalog.id_product = products.id";

                $result = $db->prepare($sql);
                $result->execute();
                $rows = $result->fetchAll();

                foreach($rows as $key => $row):?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['slug'] ?></td>
                        <td><?php echo $row['content'] ?></td>
                        <td><?php echo $row['img'] ?></td>
                        <td><?php echo $row['price'] ?>$</td>
                        <td>   <!-- зсилаємося на ту сторінку де ми зараз знаходимося через GET параметр -->
                            <a href="?page=edit&id=<?= $row['id']; ?>"  class="btn btn-warning" ><i class="fas fa-edit"></i>Edit</a>
                            <a href="/admin/modules/users/deleted.php?id=<?= $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i>Deleted</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
                                  