<?php
session_start();
$conn = new mysqli("localhost", "root", "", "dish_diary");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['id'] ?? 0; // logged-in user id

// Fetch recipes with favorite status for this user
$sql = "
  SELECT r.*, c.category_name,
    CASE WHEN f.recipe_id IS NOT NULL THEN 1 ELSE 0 END AS is_favorited
  FROM recipes r
  LEFT JOIN categories c ON r.category_id = c.category_id
  LEFT JOIN favorites f ON r.recipe_id = f.recipe_id AND f.user_id = $user_id
  ORDER BY r.title DESC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dish Diary - Recipes</title>
   <link rel="stylesheet" href="recipes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    /* (keeping all your existing CSS unchanged, just showing relevant updates) */

    .favorite-btn {
      position: absolute;
      right: 1.2rem;
      bottom: 1.2rem;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1.5rem;
      color: #ef9206;
      transition: color 0.2s;
      z-index: 2;
    }
    .favorite-btn.favorited i {
      color: #d67b02;
    }
  </style>
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
      <a href="recipes.php" class="nav-link login-required active">Recipes</a>
      <a href="categories.php" class="nav-link login-required">Categories</a>
      <a href="cookingtips.php" class="nav-link login-required">Cooking Tips</a>
      <a href="about.php" class="nav-link login-required">About</a>
      <a href="contact.php" class="nav-link login-required">Contact</a>
    </nav>
    <div class="nav-icons">
      <div class="icon-btn"><i class="ri-search-line ri-lg"></i></div>
      <div class="icon-btn"><i class="ri-heart-line ri-lg"></i></div>
      <a href="profile.php" class="sign-in-btn">Profile</a>
      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>
<!-- NAVBAR END -->

<div class="floating-elements">
  <div class="floating-circle"></div>
  <div class="floating-circle"></div>
  <div class="floating-circle"></div>
</div>

<main>
  <h1 class="page-title">All Recipes</h1>
  <div class="recipe-container">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="recipe-card">
        <a href="detailedrecipe.php?recipe_id=<?= urlencode($row['recipe_id']) ?>" class="recipe-card-link">
          <img src="<?= !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'https://readdy.ai/api/search-image?query=food&width=400&height=300' ?>" alt="<?= htmlspecialchars($row['title']) ?>">
          <h2><?= htmlspecialchars($row['title']) ?></h2>
          <p><?= htmlspecialchars(mb_strimwidth($row['description'], 0, 80, '...')) ?></p>
          <span class="category"><?= htmlspecialchars($row['category_name']) ?></span>
        </a>

        <!-- Heart button with dynamic state -->
        <button class="favorite-btn <?= $row['is_favorited'] ? 'favorited' : '' ?>" 
                data-recipe-id="<?= $row['recipe_id'] ?>" 
                title="Toggle favorite">
          <i class="<?= $row['is_favorited'] ? 'ri-heart-fill' : 'ri-heart-line' ?>"></i>
        </button>
      </div>
    <?php endwhile; ?>
  </div>
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
          <li><a href="#">Help Center</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Cooking Tips</a></li>
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

<script>
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".favorite-btn").forEach(button => {
    button.addEventListener("click", function () {
      const recipeId = this.getAttribute("data-recipe-id");
      const btn = this;

      fetch("toggle_favorite.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "recipe_id=" + recipeId
      })
      .then(response => response.json())
      .then(data => {
        if (!data.success && data.message === "Not logged in") {
          alert("Please log in to favorite recipes!");
          window.location.href = "login.php"; // redirect to login page
          return;
        }

        if (data.success) {
          if (data.action === "added") {
            btn.classList.add("favorited");
            btn.innerHTML = '<i class="ri-heart-fill"></i>';
          } else if (data.action === "removed") {
            btn.classList.remove("favorited");
            btn.innerHTML = '<i class="ri-heart-line"></i>';
          }
        } else {
          alert(data.message || "Could not update favorite.");
        }
      })
      .catch(error => console.error("Error:", error));
    });
  });
});
</script> 
</body>
</html>
