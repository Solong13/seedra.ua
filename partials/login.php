<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/partials/header.php');
?>

<?php
$error = '';
if(!empty($_POST)){
    $sql = 'SELECT * FROM users WHERE Email=:Email AND Password=:Password';
    $result = $db->prepare($sql);
    $result->execute([':Email' => $_POST['email'], ':Password' => $_POST['password']]);
    $log = $result->fetchAll();

    foreach ($log as $key => $user){?>
      <?php if($user) {

        if(isset($_POST['remember'])){
          setcookie('user_id', $user['id'], time()+60*60*24*30, '/');
          //echo "<h2>" . $_COOKIE['user_id'] . "</h2>";
        }else{
          $_SESSION['user_id'] = $user['id'];
        }
          header("Location: /index.php");
          exit();
      }else{
        $_SESSION['user_id'] = NULL;
        setcookie('user_id', '', 0, '/');

      }?>
    <?php } $error = 'Користувач не знайдений'; ?>
<?php }?>

<section>
  <div class="container">
    <div class="table">
    <img src="/assets/img/ovochi-18929.jpg">
    <h3 class="mb">Registration Info</h3>
        <form class="register" action="" method="POST">
        <label class="form-label" for="form3Example1q">Email:</label>
          <input type="email" id="form3Example1q" name="email" class="form-control" placeholder="Write your Email" required />
          
          <label class="form-label" for="form3Example1q">Password:</label>
          <input type="password" id="form3Example1q" name="password" class="form-control" placeholder="Write your Password" required />
          
          <label class="form-check-label" for="form2Example3" >
           Remember me  <input class="form-check-input" type="checkbox" name="remember" value="remember" id="form2Example3c"/>  Or <a href="/partials/register.php">  Registration</a>
          </label>
            <span style="color: red; padding: 0 0 5px 0;"><?= $error ?></span>
          <button type="submit" class="btn btn-success btn-lg mb-1">Submit</button>
        </form>
    </div>
  </div>
</section>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'); ?>