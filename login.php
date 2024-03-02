<?php
$login = false;
$error = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include 'partials/_db_connect.php';
  $username = $_POST['username'];
  $password = $_POST['password'];
  //  $sql = "select * from `login` where `username` = '$username' AND `password` = '$password'";
   $sql = "select * from `login` where `username` = '$username'";
   $result = mysqli_query($conn, $sql);
   $num = mysqli_num_rows($result);

   if($num == 1){
    while($fetch = mysqli_fetch_assoc($result)){
      if(password_verify($password, $fetch['password'])){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: welcome.php");
      }
      else{
        $error = true;

      }
    }
 
   }
   else{
    $error = true;
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

    <title>Login page</title>
  </head>
  <body>
  <?php require 'partials/_nav.php'; ?>
  <?php
  if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are logged in
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  
  ?>
    <?php
  if($error){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Danger!</strong> Invalid Credentials
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  
  ?>
    <div class="container my-4">
      <h3>Login to our website</h3>
      <!-- forms -->
      <form method="post" action=" <?php $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div id="emailHelp" class="form-text">We'll never share your password to any one</div>
        <button type="submit" class="btn btn-success mt-2">Login</button>
      </form>
  </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>