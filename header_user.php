
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">User Management</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">
      <?php if ($_SESSION['username'] === 'admin'): ?>
        <li class="nav-item">
          <a class="nav-link" href="admin_index.php">Admin Dashboard</a>
        </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
