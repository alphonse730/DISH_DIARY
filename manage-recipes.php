<!-- manage-recipes.php -->

<?php
session_start();
include 'db.php'; // adjust if needed


// Handle delete recipe
if (isset($_GET['delete'])) {
  $recipe_id = intval($_GET['delete']);
  $stmt = $conn->prepare("DELETE FROM recipes WHERE recipe_id = ?");
  $stmt->bind_param("i", $recipe_id);
  $stmt->execute();
  header("Location: manage-recipes.php?msg=deleted");
  exit();
}

// Handle inline status update
if (isset($_POST['update_status'])) {
  $recipe_id = intval($_POST['recipe_id']);
  $status = $_POST['status'];

  $stmt = $conn->prepare("UPDATE recipes SET status=? WHERE recipe_id=?");
  $stmt->bind_param("si", $status, $recipe_id);
  $stmt->execute();
  header("Location: manage-recipes.php?msg=status");
  exit();
}

// Fetch recipes with user info
$sql = "SELECT r.recipe_id, r.title, r.status, r.image_url, u.name AS user_name 
        FROM recipes r
        JOIN users u ON r.id = u.id
        ORDER BY r.recipe_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Recipes - Dish Diary</title>
  
</head>
<body>
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
    <li class="nav-item"><a href="manage-users.php" class="nav-link text-white">Manage Users</a></li>
    <li class="nav-item"><a href="manage-recipes.php" class="nav-link active text-white">Manage Recipes</a></li>
    <li class="nav-item"><a href="graphical-insights.php" class="nav-link text-white">Graphical Insights</a></li>
    <li class="nav-item"><a href="admin-feedback.php" class="nav-link text-white">View Feedback</a></li>
    <li class="nav-item"><a href="user-admin.php" class="nav-link text-danger">Logout</a></li>
  </ul>
</div>

<!-- Main Content -->
<div class="main-content">
  <h2 class="mb-4">Manage Recipes</h2>
  <table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Recipe Title</th>
        <th>Uploaded By</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['recipe_id'] ?></td>
        <td>
          <?php if (!empty($row['image_url'])): ?>
            <?php 
              $imgPath = (strpos($row['image_url'], 'uploads/') === 0) 
                          ? $row['image_url'] 
                          : 'uploads/' . $row['image_url'];
            ?>
            <img src="<?= htmlspecialchars($imgPath) ?>" 
                 alt="Recipe Image" width="60" height="60" style="object-fit:cover;" 
                 onerror="this.src='no-image.png'">
          <?php else: ?>
            <img src="no-image.png" alt="No Image" width="60" height="60" style="object-fit:cover;">
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['user_name']) ?></td>
        <td>
          <form method="post" class="d-flex">
            <input type="hidden" name="recipe_id" value="<?= $row['recipe_id'] ?>">
            <select name="status" class="form-select form-select-sm me-2">
              <option value="pending" <?= $row['status']=='pending'?'selected':'' ?>>Pending</option>
              <option value="approved" <?= $row['status']=='approved'?'selected':'' ?>>Approved</option>
              <option value="rejected" <?= $row['status']=='rejected'?'selected':'' ?>>Rejected</option>
            </select>
            <button type="submit" name="update_status" class="btn btn-sm btn-success">Update</button>
          </form>
        </td>
        <td>
          <a href="manage-recipes.php?delete=<?= $row['recipe_id'] ?>" 
             onclick="return confirm('Are you sure you want to delete this recipe?')" 
             class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
<script>
  // Show alert for status update or delete
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('msg') === 'deleted') {
    alert('Recipe deleted successfully!');
  } else if (urlParams.get('msg') === 'status') {
    alert('Recipe status updated successfully!');
  }
  // Show alert for edit
  if (localStorage.getItem('editMsg') === '1') {
    alert('Redirecting to edit recipe page...');
    localStorage.removeItem('editMsg');
  }
</script>
</body>
</html>
</body>
</html>
