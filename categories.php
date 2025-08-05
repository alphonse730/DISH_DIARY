<?php
$conn = new mysqli("localhost", "root", "", "dish_diary");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$categories = $conn->query("SELECT * FROM categories ORDER BY category_name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Diary - Categories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #f8ffae 0%, #ef9206 100%); min-height: 100vh; padding: 2rem 1rem; }
        .page-title { text-align: center; font-size: 3rem; font-weight: 700; color: #4a3c00; margin-bottom: 2.5rem; }
        .category-list { display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; max-width: 1200px; margin: 0 auto; }
        .category-card { background: #fffbe9; border-radius: 18px; box-shadow: 0 2px 12px rgba(239,146,6,0.10); padding: 2rem 2.5rem; text-align: center; font-size: 1.3rem; font-weight: 600; color: #ef9206; cursor: pointer; transition: box-shadow 0.2s, transform 0.2s; min-width: 220px; }
        .category-card:hover { box-shadow: 0 8px 24px rgba(239,146,6,0.18); transform: translateY(-4px) scale(1.04); background: #ffe0b2; }
    </style>
</head>
<body>
    <h1 class="page-title">All Categories</h1>
    <div class="category-list">
        <?php while ($cat = $categories->fetch_assoc()): ?>
            <a href="category.php?category_id=<?= urlencode($cat['category_id']) ?>" class="category-card">
                <i class="fa-solid fa-utensils" style="margin-bottom:10px;font-size:2rem;"></i><br>
                <?= htmlspecialchars($cat['category_name']) ?>
            </a>
        <?php endwhile; ?>
    </div>
</body>
</html>
