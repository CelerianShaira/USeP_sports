<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<?php
if(isset($_POST['login']))

{

$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT Email,Password FROM staff_table WHERE Email=:email and Password=:password";
$query= $dbh -> prepare($sql);

$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
    {
    $_SESSION['login']=$_POST['email'];
    $currentpage=$_SERVER['REQUEST_URI'];
    echo "<script type='text/javascript'> document.location = 'mainpage.php'; </script>";
    }else{
      
      echo "<script>alert('Invalid Details');</script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/head.php');?>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form  method="post"  name="signup">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In" style="cursor:pointer">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!--scripts-->
  <?php include('templates/scripts.php')?>

</body>

</html>
