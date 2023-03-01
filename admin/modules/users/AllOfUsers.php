 
 
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
    <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users List | Add New User
                                <a href="?page=add" class="btn btn-info float-end"><i class="fas fa-journal-whills"></i></a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>user</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>role</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        $sql = "SELECT * FROM users";// не показувати користовачів приховуючи ззаписи
                                        $result = $db->prepare($sql);
                                        $result->execute();
                                        $row = $result->fetchAll();

                                        foreach($row as $key => $item):?>
                                            <tr>
                                                <td><?= $item['id'] ?></td>
                                                <td><?= $item['user'] ?></td>
                                                <td><?= $item['Email'] ?></td>
                                                <td><?= $item['Password'] ?></td>
                                                <td><?= $item['role'] ?></td>
                                            <td>   <!-- зсилаємося на ту сторінку де ми зараз знаходимося через GET параметр -->    
                                                <a href="?page=edit&id=<?php echo $item['id']; ?>"  class="btn btn-warning" ><i class="fas fa-edit"></i>Edit</a>
                                                <a href="/admin/modules/users/deletedOfUsers.php?id=<?php echo $item['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i>Deleted</a>
                                            </td>
                                            </tr>
                                            
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                  