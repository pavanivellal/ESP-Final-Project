<!DOCTYPE html>
<html lang="en">
<head>
  <title>Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<style>
body{
 background-image: url('/var/www/html/esp_proj/b111.jpg');
}
</style>
<body>

<?php
echo $_SESSION["ur_id"];
session_destroy();
echo $_SESSION["ur_id"];
?>

<div class="container">
  <h2>You are now Logged Out of your account</h2>
  <div class="alert alert-success">
    <strong>Welcome back soon!!</strong> You have been successfully logged out of your account.
  </div>
</div>

<div class="container">
  <a href="login.php"><button type="button" class="btn pull right" >Signin</button></a>
</div>


</body>
</html>

