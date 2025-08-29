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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
     header.navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      height: 110px;
      width: 100%;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      z-index: 1000;
      display: flex;
      align-items: center;
    }

    .container.nav-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 100%;
      gap: 2rem;
    }

    .brand-title {
      font-family: 'Pacifico', cursive;
      font-size: 2rem;
      color: #ff6b35;
      text-decoration: none;
      white-space: nowrap;
      transition: transform 0.3s ease;
    }

    .brand-title:hover {
      transform: scale(1.05);
    }

    .nav-menu {
      display: flex;
      gap: 2rem;
    }

    .nav-link {
      text-decoration: none;
      color: #2c3e50;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 25px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
      transition: left 0.3s ease;
      z-index: -1;
    }

    .nav-link:hover::before,
    .nav-link.active::before {
      left: 0;
    }

    .nav-link:hover,
    .nav-link.active {
      color: #fff;
      transform: translateY(-2px);
    }

    .nav-icons {
      display: flex;
      align-items: center;
      gap: 1.2rem;
    }

    .icon-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1.3rem;
      color: #ff6b35;
      transition: color 0.2s;
    }

    .icon-btn:hover {
      color: #f7931e;
    }

    .sign-in-btn {
      background: linear-gradient(90deg, #ff6b35, #f7931e);
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 0.5em 1.2em;
      font-size: 1.05em;
      font-weight: 600;
      box-shadow: 0 2px 12px #ff6b6b22;
      cursor: pointer;
      margin-left: 0.5em;
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: background 0.2s, box-shadow 0.2s;
    }

    .sign-in-btn:hover {
      background: linear-gradient(90deg, #f7931e, #ff6b35);
    }

    .mobile-menu-btn {
      display: none;
    }

    /* Responsive */
    @media (max-width: 900px) {
      .container.nav-container {
        flex-direction: column;
        height: auto;
        padding: 0 10px;
      }
      .nav-menu {
        display: none;
      }
      .mobile-menu-btn {
        display: flex !important;
      }
    }

    @media (max-width: 600px) {
      .brand-title {
        font-size: 1.3rem;
      }
      .nav-menu {
        flex-wrap: wrap;
        gap: 0.5rem;
      }
    }

    /* Active mobile menu */
    .nav-menu.active {
      position: absolute;
      top: 90px;
      right: 1rem;
      background: #fff;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      box-shadow: 0 6px 24px rgba(0,0,0,0.12);
      border-radius: 12px;
      padding: 1.5rem 2rem;
      z-index: 100;
    }

    /* Body padding to offset fixed navbar */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f8ffae 0%, #ef9206 100%);
      min-height: 100vh;
      padding-top: 110px;
      padding-left: 1rem;
      padding-right: 1rem;
    }


    .profile-avatar {
      animation: avatarBounce 1.8s infinite alternate cubic-bezier(.68,-0.55,.27,1.55);
      color: #fff;
      background: linear-gradient(135deg, #ffb366 0%, #ff6b35 100%) !important;
      border: 4px solid #fff3e0;
      min-width: 90px;
      min-height: 90px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    @keyframes avatarBounce {
      0% { transform: scale(1) rotate(-8deg); }
      50% { transform: scale(1.08) rotate(8deg); }
      100% { transform: scale(1) rotate(-8deg); }
    }
  </style>
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
      <a href="index.php" class="brand-title">Dish Diary</a>
    </div>
    <nav class="nav-menu" id="mainNav">
      <a href="index.php" class="nav-link">Home</a>
  <a href="recipes.php" class="nav-link login-required">Recipes</a>
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
