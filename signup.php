<?php

  $success = false;
  $samepass = false;
  // $error = false;
  $exits = false;

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'partials/_db_connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $exitSql = "SELECT * FROM `login` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $exitSql);
    $num = mysqli_num_rows($result);
    if($num > 0){
      $exits = true;
    }
    else{
      if($password == $cpassword){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `login` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
          $success = true;
        }
        // else{
        //   $error = true;
        // }
  
      }
      else{
        $samepass = true;
      }

    }
    
  }
?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>SignUP Page!</title>
  </head>
  <body>
  <?php require 'partials/_nav.php'; ?>
  <?php
  if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account has been created. you can now logged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  
  ?>
    <?php
  if($samepass){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Alert!</strong> Please enter both same password.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  
  ?>
    <?php
  if($exits){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Username is already exits. Please change it and try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  
  ?>

    <div class="container my-4">
      <h3>Signup to our website</h3>
      <!-- forms -->
      <form method="post" action=" <?php $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" Required class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" Required class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
          <label for="cpassword" class="form-label">Confirm Password</label>
          <input type="password" Required class="form-control" id="cpassword" name="cpassword">
        </div>
        <div id="emailHelp" class="form-text">We'll never share your password to any one</div>
        <button type="submit" class="btn btn-primary mt-2">Signup</button>
      </form>
  </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>