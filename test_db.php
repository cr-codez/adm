<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_management');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user data and check if the account is enabled
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($row['status'] == 0) {
        echo "Your account is disabled. Please contact the admin.";
        exit();
    }

    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        header("Location: profile.php");
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username.";
}

$conn->close();
?>
