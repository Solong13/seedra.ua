<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/partials/header.php');

    if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])){
      if(!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])){

          $login = strip_tags($_POST['login']);
          $login = htmlspecialchars($login);

          $email = $_POST['email'];
          $email= filter_var($email, FILTER_SANITIZE_EMAIL);
          $email = filter_var($email, FILTER_VALIDATE_EMAIL);

          $password = strip_tags($_POST['password']);
          $password = htmlspecialchars($password);

          $status = '';
          $error = '';
         $sql = "SELECT id FROM users WHERE  Email ='$email'";
         // $sql = "SELECT * FROM users ";
          $result = $db->prepare($sql);
          $result->execute();

          $log = $result->fetchAll();

    if($log){
        $error = 'користувач існує';
    }else{
        $sql = "INSERT INTO `users` ( `user`, `Email`, `Password`) VALUES (?,?,?);";
        $registeretion = $db->prepare($sql);
        $registeretion->execute([$login, $email, $password]);

        if($registeretion){
            $status = "Данные успешно добавлены";
            header("Location: /index.php");
        } else{
            echo "Ошибка: " . $db->error;
        }
        $dbh = null;
    }

//      $emailses = [];
//      foreach ($log as $reg){
//         $emailses[] =  $reg['Email'];
//      }
//      $em = $_POST['email'];
//       $key  = array_search($em,  $emailses);
//    if($key = false){
//        echo 'working';
//    }else{
//        echo 'night stuff';
//    }

      }

    } ?>

<section>
  <div class="container">
    <div class="table">
    <img src="/assets/img/ovochi-18929.jpg">
    <h3 class="mb">Registration Info</h3>

        <form class="register" action="" method="POST">
          <label class="form-label" for="form3Example1q">Login:</label>
          <input type="text" id="form3Example1q" name="login" class="form-control" placeholder="Write your Login" required />

          <label class="form-label" for="form3Example1q">Email:</label>
          <input type="email" id="form3Example1q" name="email" class="form-control" placeholder="Write your Email" required />
          
          <label class="form-label" for="form3Example1q">Password:</label>
          <input type="password" id="form3Example1q" name="password" class="form-control" placeholder="Write your Password" required />

          <label class="form-check-label" for="form2Example3">
           Remember me
            <input class="form-check-input" type="checkbox" value="" id="form2Example3c"/>
          </label>

          <button type="submit" class="btn btn-success btn-lg mb-1" >Submit</button>
        </form>
        <span style="padding: 10px; font-size: 18px; color: red;text-align: center;display: block;"><?= isset($error) ? $error : '' ?></span>
        <span style="padding: 10px; font-size: 18px; color: #23bf35;text-align: center;display: block;"><?= isset($status) ? $status : ''  ?></span>

    </div>
  </div>
</section>

<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php');
?>