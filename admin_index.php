<?php
session_start();

// Redirect non-admin users to login
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'user_management');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle status toggle requests
if (isset($_GET['user_id']) && isset($_GET['status'])) {
    $user_id = $_GET['user_id'];
    $status = $_GET['status'];
    $toggle_sql = "UPDATE users SET status = $status WHERE id = $user_id";
    $conn->query($toggle_sql);
    header("Location: admin_index.php");
    exit();
}

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <?php include 'admin_header.php'; ?>
  <div class="container mt-5">
    <h1>Admin Dashboard</h1>
    <h3>Manage Users</h3>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['status'] == 1 ? 'Enabled' : 'Disabled'; ?></td>
            <td>
              <a href="admin_index.php?user_id=<?php echo $row['id']; ?>&status=1" class="btn btn-success">Enable</a>
              <a href="admin_index.php?user_id=<?php echo $row['id']; ?>&status=0" class="btn btn-danger">Disable</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <?php include 'admin_footer.php'; ?>
</body>
</html>

<?php
$conn->close();
?>
