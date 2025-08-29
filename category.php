<?php
if (!isset($_GET['category_id']) || !is_numeric($_GET['category_id'])) {
    die('Invalid category ID.');
}
$category_id = intval($_GET['category_id']);
$conn = new mysqli("localhost", "root", "", "dish_diary");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cat_query = $conn->prepare("SELECT category_name FROM categories WHERE category_id = ?");
$cat_query->bind_param('i', $category_id);
$cat_query->execute();
$cat_result = $cat_query->get_result();
$category = $cat_result->fetch_assoc();
$cat_query->close();
if (!$category) { die('Category not found.'); }
$recipes = $conn->prepare("SELECT * FROM recipes WHERE category_id = ? ORDER BY title ASC");
$recipes->bind_param('i', $category_id);
$recipes->execute();
$recipes_result = $recipes->get_result();
$recipes->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($category['category_name']) ?> - Recipes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #f8ffae 0%, #ef9206 100%); min-height: 100vh; padding: 2rem 1rem; }
        .page-title { text-align: center; font-size: 3.5rem; font-weight: 700; color: #4a3c00; text-shadow: 0 4px 20px rgba(239, 146, 6, 0.3); margin-bottom: 3rem; background: linear-gradient(45deg, #4a3c00, #6b5200); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .recipe-list { max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 2rem; padding: 1rem 0; }
        .recipe-card-link { text-decoration: none; color: inherit; display: block; }
        .recipe-card { background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border: 1px solid rgba(239, 146, 6, 0.2); border-radius: 20px; overflow: hidden; transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1); cursor: pointer; position: relative; height: 100%; display: flex; flex-direction: column; box-shadow: 0 8px 25px rgba(239, 146, 6, 0.15); }
        .recipe-card:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 40px rgba(239, 146, 6, 0.25); background: rgba(255,255,255,0.95); border-color: rgba(239, 146, 6, 0.4); }
        .recipe-card img { width: 100%; height: 250px; object-fit: cover; transition: transform 0.4s ease; }
        .recipe-card:hover img { transform: scale(1.1); }
        .recipe-card h2 { font-size: 1.4rem; font-weight: 600; color: #4a3c00; margin: 1.5rem 1.5rem 0.8rem; line-height: 1.3; }
        .recipe-card p { color: #6b5200; font-size: 0.95rem; line-height: 1.5; margin: 0 1.5rem 1rem; flex-grow: 1; }
        .back-link { display: inline-block; margin-bottom: 2rem; color: #ef9206; text-decoration: none; font-weight: bold; font-size: 1.1rem; }
        .back-link:hover { text-decoration: underline; color: #d17a00; }
    </style>
</head>
<body>
    <a href="categories.php" class="back-link"><i class="fa fa-arrow-left"></i> Back to Categories</a>
    <h1 class="page-title">Category: <?= htmlspecialchars($category['category_name']) ?></h1>
    <div class="recipe-list">
        <?php while ($row = $recipes_result->fetch_assoc()): ?>
            <a href="detailedrecipe.php?recipe_id=<?= urlencode($row['recipe_id']) ?>" class="recipe-card-link">
                <div class="recipe-card">
                    <img src="<?= !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'https://readdy.ai/api/search-image?query=food&width=400&height=300' ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    <h2><?= htmlspecialchars($row['title']) ?></h2>
                    <p><?= htmlspecialchars(mb_strimwidth($row['description'], 0, 60, '...')) ?></p>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</body>
</html>