<!-- favorites.php -->




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
  <link rel="stylesheet" href="recipes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Mobile navbar toggle
        var menuBtn = document.getElementById('mobileMenuBtn');
        var navMenu = document.getElementById('mainNav');
        if(menuBtn && navMenu) {
          menuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            navMenu.classList.toggle('active');
          });
        }
      });
    </script>
</head>
<body>
  <!-- NAVBAR START -->
  <header class="navbar">
    <div class="container nav-container">
      <div class="brand">
        <a href="index.php" class="brand-title">Dish Diary</a>
      </div>
      <nav class="nav-menu" id="mainNav">
        <a href="index.php" class="nav-link">Home</a>
        <a href="recipes.php" class="nav-link login-required">Recipes</a>
        <a href="categories.php" class="nav-link login-required">Categories</a>
        <a href="cookingtips.php" class="nav-link login-required">Cooking Tips</a>
        <a href="about.php" class="nav-link login-required">About</a>
        <a href="feedback.php" class="nav-link login-required">Feedback</a>
      </nav>
      <div class="nav-icons">
        <a href="profile.php" class="sign-in-btn">Profile</a>
        <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
      </div>
    </div>
  </header>
  <!-- NAVBAR END -->

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

<!-- FOOTER -->
<footer class="footer">
  <div class="footer-wrapper">
    <div class="footer-main">
      <div class="footer-col">
        <span class="foot-brand">Dish Diary</span>
        <p class="footer-desc">Discover, create, and share amazing recipes with food enthusiasts around the world.</p>
        <div class="footer-socials">
          <a href="#"><i class="ri-facebook-fill"></i></a>
          <a href="#"><i class="ri-instagram-line"></i></a>
          <a href="#"><i class="ri-twitter-x-line"></i></a>
          <a href="#"><i class="ri-pinterest-line"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes.php">Recipes</a></li>
          <li><a href="categories.php">Categories</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h3>Resources</h3>
        <ul>
          <li><a href="feedback.php">Feedback</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="cookingtips.php">Cooking Tips</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h3>Contact Us</h3>
        <ul>
          <li><i class="ri-map-pin-line"></i> 123 Recipe Street, Foodville, CA 90210</li>
          <li><i class="ri-mail-line"></i> info@dishdiary.com</li>
          <li><i class="ri-phone-line"></i> +1 (234) 567-890</li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
