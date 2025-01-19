<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_management');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$sql = "INSERT INTO users (username, email, password, status) VALUES ('$username', '$email', '$password', 1)";

if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $username;
    header("Location: profile.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
