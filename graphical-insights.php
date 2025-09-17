<!-- graphical-insights.php -->


<?php
session_start();
include 'db.php';

// Fetch user counts by role
$userData = $conn->query("SELECT role, COUNT(*) AS count FROM users GROUP BY role")->fetch_all(MYSQLI_ASSOC);

// Fetch recipe counts by status
$statusData = $conn->query("SELECT status, COUNT(*) AS count FROM recipes GROUP BY status")->fetch_all(MYSQLI_ASSOC);

// Fetch recipe counts by category
$categoryData = $conn->query("
  SELECT c.category_name, COUNT(r.recipe_id) AS count
  FROM recipes r
  LEFT JOIN categories c ON r.category_id = c.category_id
  GROUP BY c.category_name
")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Graphical Insights - Dish Diary</title>
</head>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>

<!-- Sidebar -->
<div class="sidebar text-white">
  <h3>Admin Panel</h3>
  <ul class="nav flex-column">
    <li class="nav-item"><a href="admin-dashboard.php" class="nav-link text-white">Dashboard</a></li>
    <li class="nav-item"><a href="manage-users.php" class="nav-link text-white">Manage Users</a></li>
    <li class="nav-item"><a href="manage-recipes.php" class="nav-link text-white">Manage Recipes</a></li>
    <li class="nav-item"><a href="graphical-insights.php" class="nav-link active text-white">Graphical Insights</a></li>
    <li class="nav-item"><a href="admin-feedback.php"  class="nav-link text-white">Feedback</a></li>
    <li class="nav-item"><a href="user-admin.php" class="nav-link text-danger">Logout</a></li>
  </ul>
</div>

<!-- Main Content -->
<div class="main-content">
  <h2 class="mb-4">Graphical Insights</h2>
  <div class="row">
    <!-- Users by Role -->
    <div class="col-md-6 mb-4">
      <div class="card p-3">
        <h5 class="card-title">Users by Role</h5>
        <canvas id="usersChart"></canvas>
      </div>
    </div>
    <!-- Recipes by Status -->
    <div class="col-md-6 mb-4">
      <div class="card p-3">
        <h5 class="card-title">Recipes by Status</h5>
        <canvas id="statusChart"></canvas>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- Recipes by Category -->
    <div class="col-md-12 mb-4">
      <div class="card p-3">
        <h5 class="card-title">Recipes by Category</h5>
        <canvas id="categoryChart"></canvas>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>

<script>
// Users by Role
const usersData = {
  labels: <?= json_encode(array_column($userData, 'role')) ?>,
  datasets: [{
    data: <?= json_encode(array_column($userData, 'count')) ?>,
    backgroundColor: ['#4e79a7','#f28e2b']
  }]
};
new Chart(document.getElementById('usersChart'), {
  type: 'doughnut',
  data: usersData
});

// Recipes by Status
const statusData = {
  labels: <?= json_encode(array_column($statusData, 'status')) ?>,
  datasets: [{
    data: <?= json_encode(array_column($statusData, 'count')) ?>,
    backgroundColor: ['#59a14f','#edc949','#e15759']
  }]
};
new Chart(document.getElementById('statusChart'), {
  type: 'pie',
  data: statusData
});

// Recipes by Category
const categoryData = {
  labels: <?= json_encode(array_column($categoryData, 'category_name')) ?>,
  datasets: [{
    label: 'Recipes',
    data: <?= json_encode(array_column($categoryData, 'count')) ?>,
    backgroundColor: [
      '#76b7b2','#59a14f','#edc949','#e15759','#f28e2b','#af7aa1','#ff9da7'
    ]
  }]
};
new Chart(document.getElementById('categoryChart'), {
  type: 'bar',
  data: categoryData,
  options: { responsive: true, plugins: { legend: { display: false } } }
});
</script>
</body>
</html>
