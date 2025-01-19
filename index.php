<?php
session_start();
if (isset($_SESSION['username'])) {
  if ($_SESSION['username'] === 'admin') {
    header("Location: admin_index.php");
    exit();
  }
  header("Location: profile.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <?php include 'header_guest.php'; ?>
  <div class="container" style="min-height:500px">
    <h1>Welcome to User Management Application</h1>
    <p><a href="register.php">Register</a> or <a href="login.php">Login</a></p>
  </div>
  <?php include 'footer_guest.php'; ?>
</body>
</html>
