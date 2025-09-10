<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id'])) {
    die("Please log in to view your favorites.");
}

$user_id = $_SESSION['id'];

$sql = "
  SELECT r.recipe_id, r.title, r.description, r.image_url, c.category_name, f.favorite_id
  FROM recipes r
  INNER JOIN favorites f ON r.recipe_id = f.recipe_id
  LEFT JOIN categories c ON r.category_id = c.category_id
  WHERE f.user_id = ?
  ORDER BY r.title ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Favorites - Dish Diary</title>
  <link rel="stylesheet" href="favorites.css">
</head>
<body>
  <header class="header">
    <h1>My Favorite Recipes ❤️</h1>
    <a href="index.php" class="back-btn">← Back to Home</a>
  </header>

  <main class="favorites-container">
    <?php if ($result->num_rows > 0): ?>
      <div class="recipe-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="recipe-card">
            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Recipe Image">
            <div class="recipe-info">
              <h2><?php echo htmlspecialchars($row['title']); ?></h2>
              <p><?php echo htmlspecialchars($row['description']); ?></p>
              <span class="category">
                <?php echo htmlspecialchars($row['category_name']); ?>
              </span>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="empty-msg">💔 You haven’t added any favorites yet.</p>
    <?php endif; ?>
  </main>
</body>
</html>
