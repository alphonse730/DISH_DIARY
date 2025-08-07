<!-- profile.php -->


<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}

// Fetch user info from database using session id
$user_id = $_SESSION['id'];
$conn = new mysqli('localhost', 'root', '', 'dish_diary');
if ($conn->connect_error) {
  die('Database connection failed: ' . $conn->connect_error);
}
$stmt = $conn->prepare('SELECT name, email FROM users WHERE id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - Dish Diary</title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="profile.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
</head>
<body>
<?php // HEADER (same as main page) ?>
<header class="navbar">
  <div class="container nav-container">
    <div class="brand">
      <a href="#" class="brand-title">Dish Diary</a>
    </div>
    <nav class="nav-menu" id="mainNav">
      <a href="index.php" class="nav-link">Home</a>
      <a href="recipes.php" class="nav-link">Recipes</a>
      <a href="#" class="nav-link">Categories</a>
      <a href="#" class="nav-link">Cooking tips</a>
      <a href="#" class="nav-link">About</a>
      <a href="#" class="nav-link">Contact</a>
    </nav>
    <div class="nav-icons">
      <div class="icon-btn"><i class="ri-search-line ri-lg"></i></div>
      <div class="icon-btn"><i class="ri-heart-line ri-lg"></i></div>
      <a href="profile.php" class="sign-in-btn" style="display: flex; align-items: center;">
        <i class="ri-user-line" style="margin-right: 6px;"></i>
        <?php echo htmlspecialchars($username); ?>
      </a>
      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>

<!-- Profile Section -->
<!-- Profile Background -->
<div class="profile-bg"></div>
<section class="profile-section" style="position: relative; z-index: 1;">
  <div class="profile-container">
    <h2 style="font-family: var(--font-brand); color: var(--primary); margin-bottom: 2rem;">My Profile</h2>
    <div class="profile-card">
      <div class="profile-avatar">
        <i class="ri-user-3-fill"></i>
      </div>
      <div class="profile-info">
        <div class="profile-row"><span class="profile-label">Username:</span> <span><?php echo htmlspecialchars($username); ?></span></div>
        <div class="profile-row"><span class="profile-label">Email:</span> <span><?php echo htmlspecialchars($email); ?></span></div>
        <!-- Add more fields as needed -->
      </div>
      <div style="margin-top: 2rem; width: 100%; display: flex; flex-direction: column; align-items: center; gap: 1rem;">
        <a href="myrecipes.php" class="my-recipes-btn" style="display: inline-block; padding: 0.7em 2em; background: linear-gradient(90deg, var(--primary), var(--secondary)); color: #fff; border: none; border-radius: 8px; font-size: 1.1em; font-weight: 600; box-shadow: 0 2px 12px #ff6b6b22; text-decoration: none; transition: background 0.2s, box-shadow 0.2s;"> <i class="ri-restaurant-2-line" style="margin-right: 8px;"></i>My Recipes</a>
        <form action="logout.php" method="post" style="width: 100%; display: flex; justify-content: center;">
          <button type="submit" class="logout-btn">Logout</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php // FOOTER (same as main page) ?>
<footer class="footer">
  <div class="container">
    <div class="footer-main">
      <div class="footer-col">
        <a href="#" class="brand-title foot-brand">Dish Diary</a>
        <p class="footer-desc">Discover, create, and share amazing recipes with food enthusiasts around the world.</p>
        <div class="footer-socials">
          <a href="https://www.facebook.com/"><i class="ri-facebook-fill"></i></a>
          <a href="https://www.instagram.com/accounts/login/?next=https%3A%2F%2Fwww.instagram.com%2Faccounts%2Fedit%2F%3F__coig_login%3D1#"><i class="ri-instagram-line"></i></a>
          <a href="https://twitter.com/"><i class="ri-twitter-x-line"></i></a>
          <a href="https://www.pinterest.com/"><i class="ri-pinterest-line"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes.php">Recipes</a></li>
          <li><a href="categories.php">Categories</a></li>
          <li><a href="#">Cooking Tips</a></li>
          

        </ul>
      </div>
      <div class="footer-col">
        <h3>Resources</h3>
        <ul>
          <li><a href="#">Help Center</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Cooking Tips</a></li>
          <li><a href="#">Community</a></li>
          <li><a href="#">Recipe Guidelines</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h3>Contact Us</h3>
        <ul>
          <li><i class="ri-map-pin-line"></i>123 Recipe Street, Foodville, CA 90210</li>
          <li><i class="ri-mail-line"></i><a href="mailto:info@dishdiary.com">info@dishdiary.com</a></li>
          <li><i class="ri-phone-line"></i><a href="tel:+1234567890">+1 (234) 567-890</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2025 Dish Diary. All rights reserved.</p>
      <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>
<script src="main.js"></script>
</body>
</html>
