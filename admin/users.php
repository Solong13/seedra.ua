<?php
require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/header.php');
?>
		
 <!-- Page Wrapper -->
 <div id="wrapper">
 	
 <?php
require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/sitebar.php');
?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                   

                    <!-- Topbar Search -->
                 

                    <!-- Topbar Navbar -->
                    
                        <!-- Nav Item - Alerts -->
                       

                        <!-- Nav Item - Messages -->
                        

                      

                        <!-- Nav Item - User Information -->
                        

                </nav>
                <!-- End of Topbar -->



                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                    if(empty($_GET)) {// перевірка $_GET чи пустий він
                        require($_SERVER['DOCUMENT_ROOT'] . '/admin/modules/users/AllOfUsers.php');
                    } else {
                        switch ($_GET['page']) {//перевірка  суперглобальний масива з ключем page
                            case 'edit':// тоді підключаємо сторінку edit.php
                                require($_SERVER['DOCUMENT_ROOT'] . '/admin/modules/users/editOfUsers.php');
                                break;
                            case 'add':
                                require($_SERVER['DOCUMENT_ROOT'] . '/admin/modules/users/addOfUsers.php');
                                break;
                        
                        }
                    }
                    

                    ?>
                </div>




                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Seedra 2022 - 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->


<?php
require($_SERVER['DOCUMENT_ROOT'] . '/admin/partials/footer.php');
?>


			


