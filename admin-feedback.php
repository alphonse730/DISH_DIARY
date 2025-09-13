<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include 'db.php';

$result = $conn->query("SELECT f.feedback_id, f.message, f.rating, f.created_at, u.name 
                        FROM feedback f 
                        JOIN users u ON f.user_id = u.id 
                        ORDER BY f.created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Feedback Management - Dish Diary</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <style>
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
        
        .feedback-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .feedback-table th, .feedback-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .feedback-table th {
            background:  #0d6efd;
            color: #fff;
        }
        .feedback-table tr:hover {
            background: #f9f9f9;
        }
        .stars {
            color: #ffb400;
            font-size: 18px;
        }
        .stars.gray {
            color: #ddd;
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
                <li class="nav-item"><a href="manage-recipes.php" class="nav-link text-white">Manage Recipes</a></li>
                <li class="nav-item"><a href="graphical-insights.php" class="nav-link text-white">Graphical Insights</a></li>
                <li class="nav-item"><a href="admin-feedback.php" class="nav-link active text-white">Feedback</a></li>
                <li class="nav-item"><a href="user-admin.php" class="nav-link text-danger">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2>User Feedback</h2>
            <table class="feedback-table">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['feedback_id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td>
                            <?php 
                            $stars = intval($row['rating']);
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $stars ? "<span class='stars'>★</span>" : "<span class='stars gray'>★</span>";
                            }
                            ?>
                        </td>
                        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                        <td><?= $row['created_at'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
</body>
</html>
