<!-- manage-users.php -->


<?php
session_start();
include 'db.php'; // adjust path if needed

// Handle role update
if (isset($_POST['update_role'])) {
  $user_id = intval($_POST['user_id']);
  $role = $_POST['role'];

  $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
  $stmt->bind_param("si", $role, $user_id);
  $stmt->execute();
  header("Location: manage-users.php?msg=role");
  exit();
}

// Handle delete user
if (isset($_GET['delete'])) {
  $user_id = intval($_GET['delete']);
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  header("Location: manage-users.php?msg=deleted");
  exit();
}

// Fetch users
$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - Dish Diary</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }
    .sidebar {
      background-color: #212529;
      min-height: 100vh;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      width: 220px;
    }
    .sidebar h3 {
      font-size: 1.5rem;
      margin-bottom: 30px;
      font-weight: bold;
      text-align: center;
    }
    .sidebar .nav-link {
      font-size: 1rem;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background 0.2s ease;
    }
    .sidebar .nav-link:hover {
      background: rgba(255, 255, 255, 0.1);
    }
    .sidebar .nav-link.active {
      background: #0d6efd;
      color: #fff !important;
    }
    .main-content {
      margin-left: 240px;
      padding: 30px;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .table {
      border-radius: 10px;
      overflow: hidden;
      background: #fff;
    }
    .table th {
      background: #0d6efd;
      color: #fff;
    }
    .table td, .table th {
      vertical-align: middle;
    }
    .btn-sm {
      border-radius: 6px;
      padding: 4px 10px;
    }
    .btn-success {
      background-color: #198754;
    }
    .btn-danger {
      background-color: #dc3545;
    }
    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        min-height: auto;
      }
      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar text-white">
  <h3>Admin Panel</h3>
  <ul class="nav flex-column">
    <li class="nav-item"><a href="admin-dashboard.php" class="nav-link text-white">Dashboard</a></li>
    <li class="nav-item"><a href="manage-users.php" class="nav-link active text-white">Manage Users</a></li>
    <li class="nav-item"><a href="manage-recipes.php" class="nav-link text-white">Manage Recipes</a></li>
    <li class="nav-item"><a href="graphical-insights.php" class="nav-link text-white">Graphical Insights</a></li>
    <li class="nav-item"><a href="admin-feedback.php" class="nav-link text-white">View Feedback</a></li>
    <li class="nav-item"><a href="user-admin.php" class="nav-link text-danger">Logout</a></li>
  </ul>
</div>

<!-- Main Content -->
<div class="main-content">
  <h2 class="mb-4">Manage Users</h2>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td>
          <form method="post" class="d-flex">
            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
            <select name="role" class="form-select form-select-sm me-2">
              <option value="user" <?= $row['role']=='user'?'selected':'' ?>>User</option>
              <option value="admin" <?= $row['role']=='admin'?'selected':'' ?>>Admin</option>
            </select>
            <button type="submit" name="update_role" class="btn btn-sm btn-primary">Update</button>
          </form>
        </td>
       
        <td>
          <a href="manage-users.php?delete=<?= $row['id'] ?>" 
             onclick="return confirm('Are you sure you want to delete this user?')" 
             class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</table>
<script>
  // Show alert for role update or delete
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('msg') === 'deleted') {
    alert('User deleted successfully!');
  } else if (urlParams.get('msg') === 'role') {
    alert('User role updated successfully!');
  }
</script>
</div>
</body>
</html>
