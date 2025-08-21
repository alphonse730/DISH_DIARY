<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
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
      <?php if (isset($_SESSION['id'])): ?>
        <a href="profile.php" class="sign-in-btn">Profile</a>
      <?php else: ?>
        <a href="signup.php" class="sign-in-btn">Signup</a>
        <a href="login.php" class="sign-in-btn">Login</a>
      <?php endif; ?>
      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>
<style>
.navbar {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      transition: all 0.3s ease;
    }
    .container.nav-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      align-items: center;
      height: 80px;
      gap: 2.5rem;
    }
    .brand {
      flex: 0 0 auto;
      margin-right: 2.5rem;
      display: flex;
      align-items: center;
    }
    .brand-title {
      font-family: 'Pacifico', cursive;
      font-size: 2rem;
      color: #ff6b35;
      text-decoration: none;
      transition: all 0.3s ease;
      white-space: nowrap;
      display: inline-block;
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
      gap: 1.2em;
    }
    .icon-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1.3em;
      color: #ff6b35;
      margin-right: 0.5em;
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
    @media (max-width: 900px) {
      .container.nav-container { flex-direction: column; height: auto; padding: 0 10px; }
      .nav-menu { gap: 1rem; }
    }
    @media (max-width: 600px) {
      .container.nav-container { flex-direction: column; height: auto; padding: 0 5px; }
      .nav-menu { flex-wrap: wrap; gap: 0.5rem; }
      .brand-title { font-size: 1.3rem; }
    }
    
</style>
