<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'user_management');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username' AND status = 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Your account has been disabled. Please contact the admin.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <?php include 'header_user.php'; ?>
  <div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p>This is your profile page.</p>
  </div>
  <?php include 'footer_user.php'; ?>
</body>
</html>
