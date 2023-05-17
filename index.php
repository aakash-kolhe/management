<?php

  session_start();

  if(!empty($_SESSION['email'])){
    header("Location:dashboard.php");
  }

  include 'config.php';

  if(isset($_POST['login']))
  {
    // echo "hii";exit;
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // print_r($_POST);exit;

    $sql = "SELECT * FROM users WHERE email ='$email' AND password = '$password'";

    // print_r($sql);exit();
    $res = mysqli_query($conn, $sql);
    // print_r($result);exit();

    $result = mysqli_fetch_array($res, MYSQLI_ASSOC);

    // echo "<pre>";
    // print_r($result);exit;
    error_reporting(E_ERROR | E_PARSE);

    $count = mysqli_num_rows($res);

    if($count > 0){
      $_SESSION['email'] = $result;
      header("Location:dashboard.php");
    }else{
      echo "Email or password incorrect";
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Management </b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <p class="mb-0">
              <a href="register.php" class="text-center">Register a new membership</a>
            </p>
            <!-- <button type="submit" class="btn btn-primary btn-block">Register here</button> -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
