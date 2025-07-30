<?php
$conn = new mysqli("localhost", "root", "", "dish_diary");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT r.*, c.category_name FROM recipes r LEFT JOIN categories c ON r.category_id = c.category_id ORDER BY r.title DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dish Diary - Recipes</title>
  <link rel="stylesheet" href="recipes.css">
</head>
<body>
  <h1 class="page-title">All Recipes</h1>
  <div class="recipe-container">
    <?php while ($row = $result->fetch_assoc()): ?>
      <a href="detailedrecipe.php?recipe_id=<?= urlencode($row['recipe_id']) ?>" class="recipe-card-link" style="text-decoration:none;color:inherit;">
        <div class="recipe-card" style="cursor:pointer;">
          <?php
            $imgSrc = !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'https://readdy.ai/api/search-image?query=A%20delicious%20homemade%20margherita%20pizza%20with%20fresh%20mozzarella%2C%20tomatoes%2C%20and%20basil%20leaves.%20The%20crust%20is%20perfectly%20baked%20with%20a%20slight%20char.%20Steam%20is%20rising%20from%20the%20hot%20pizza.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=400&height=300&seq=8&orientation=landscape';
          ?>
          <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($row['title']) ?>" style="width:120px;height:90px;object-fit:cover;border-radius:8px;">
          <h2><?= htmlspecialchars($row['title']) ?></h2>
          <p><?= htmlspecialchars(mb_strimwidth($row['description'], 0, 80, '...')) ?></p>
          <span class="category"><?= htmlspecialchars($row['category_name']) ?></span>
        </div>
      </a>
    <?php endwhile; ?>
  </div>
</body>
</html>