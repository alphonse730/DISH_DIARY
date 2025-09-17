<!-- admin-dashboard.php -->
<?php
session_start();
include 'db.php';

// ✅ Restrict access only to admin
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// ✅ Fetch admin name using session id
$adminId = $_SESSION['id'];
$stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
$stmt->bind_param("i", $adminId);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$adminName = $admin ? $admin['name'] : "Admin";

// Fetch some quick stats
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalRecipes = $conn->query("SELECT COUNT(*) AS total FROM recipes")->fetch_assoc()['total'];
$pendingRecipes = $conn->query("SELECT COUNT(*) AS total FROM recipes WHERE status='pending'")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Dish Diary</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* General styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    /* Sidebar */
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

    /* Main content */
    .main-content {
      margin-left: 240px; /* space for sidebar */
      padding: 30px;
    }

    /* Cards */
    .card {
      border-radius: 12px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    /* Tables */
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

    /* Buttons */
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

    /* Responsive */
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
    <li class="nav-item"><a href="admin-dashboard.php" class="nav-link active text-white">Dashboard</a></li>
    <li class="nav-item"><a href="manage-users.php" class="nav-link text-white">Manage Users</a></li>
    <li class="nav-item"><a href="manage-recipes.php" class="nav-link text-white">Manage Recipes</a></li>
    <li class="nav-item"><a href="graphical-insights.php" class="nav-link text-white">Graphical Insights</a></li>
    <li class="nav-item"><a href="admin-feedback.php" class="nav-link text-white">Feedback</a></li>
    <li class="nav-item"><a href="user-admin.php" class="nav-link text-danger">Logout</a></li>
  </ul>
</div>

<!-- Main Content -->
<div class="main-content">
  <h2>Welcome, <?php echo htmlspecialchars($adminName); ?> 👋</h2>
  <hr>

  <!-- Stats Cards -->
  <div class="row">
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5>Total Users</h5>
          <p class="display-6"><?php echo $totalUsers; ?></p>
        </div>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5>Total Recipes</h5>
          <p class="display-6"><?php echo $totalRecipes; ?></p>
        </div>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5>Pending Recipes</h5>
          <p class="display-6 text-warning"><?php echo $pendingRecipes; ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Recipes Quick View -->
  <div class="mt-5">
    <h4>Recent Pending Recipes</h4>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Recipe Name</th>
          <th>Submitted By</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT r.recipe_id, r.title, r.status, u.name AS username 
                FROM recipes r 
                JOIN users u ON r.id = u.id 
                WHERE r.status='pending' 
                ORDER BY r.recipe_id DESC 
                LIMIT 5";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['recipe_id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['username']}</td>
                    <td><span class='badge bg-warning'>{$row['status']}</span></td>
                    <td>
                      <a href='approve-recipe.php?id={$row['recipe_id']}' class='btn btn-success btn-sm'>Approve</a>
                      <a href='reject-recipe.php?id={$row['recipe_id']}' class='btn btn-danger btn-sm'>Reject</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='5' class='text-center'>No pending recipes</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
