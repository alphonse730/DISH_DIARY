<!-- recipes.php -->


<!-- footer sheriyakkanammm -->



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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Diary - Recipes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>

        /* Navbar Start */
/* ====== NAVBAR CSS START ====== */
    header.navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      height: 115px;
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
      padding-top: 115px;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    /* ====== NAVBAR CSS END ====== */


    


    .page-title {
      text-align: center;
      font-size: 3rem;
      font-weight: 700;
      color: #4a3c00;
      margin-bottom: 2.5rem;
    }

    .category-list {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
      max-width: 1200px;
      margin: 0 auto;
    }

    .category-card {
      background: #fffbe9;
      border-radius: 18px;
      box-shadow: 0 2px 12px rgba(239,146,6,0.10);
      padding: 2rem 2.5rem;
      text-align: center;
      font-size: 1.3rem;
      font-weight: 600;
      color: #ef9206;
      cursor: pointer;
      transition: box-shadow 0.2s, transform 0.2s;
      min-width: 220px;
    }

    .category-card:hover {
      box-shadow: 0 8px 24px rgba(239,146,6,0.18);
      transform: translateY(-4px) scale(1.04);
      background: #ffe0b2;
    }
/* navbar  css end */






    body { padding-top: 110px; }
  
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #f8ffae 0%, #ef9206 100%); min-height: 100vh; padding: 2rem 1rem; }
        .page-title { text-align: center; font-size: 3.5rem; font-weight: 700; color: #4a3c00; text-shadow: 0 4px 20px rgba(239, 146, 6, 0.3); margin-bottom: 3rem; background: linear-gradient(45deg, #4a3c00, #6b5200); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .recipe-container { max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; padding: 1rem 0; }
        .recipe-card-link { text-decoration: none; color: inherit; display: block; }
        .recipe-card { background: rgba(255,255,255,0.94); backdrop-filter: blur(10px); border: 1px solid rgba(239, 146, 6, 0.22); border-radius: 20px; overflow: hidden; transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1); cursor: pointer; position: relative; height: 100%; display: flex; flex-direction: column; box-shadow: 0 8px 25px rgba(239, 146, 6, 0.15); }
        .recipe-card:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 40px rgba(239, 146, 6, 0.25); background: rgba(255,255,255,0.98); border-color: rgba(239, 146, 6, 0.4); }
        .recipe-card img { width: 100%; height: 200px; object-fit: cover; transition: transform 0.35s ease; }
        .recipe-card:hover img { transform: scale(1.08); }
        .recipe-card h2 { font-size: 1.25rem; font-weight: 600; color: #4a3c00; margin: 1.2rem 1.2rem 0.7rem; line-height: 1.3; }
        .recipe-card p { color: #6b5200; font-size: 1rem; line-height: 1.5; margin: 0 1.2rem 1rem; flex-grow: 1; }
        .recipe-card .category { background: linear-gradient(45deg, #ef9206, #d67b02); color: white; padding: 0.4rem 1rem; border-radius: 18px; font-size: 0.85rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(239, 146, 6, 0.18); margin: 0 1.2rem 1.2rem; display: inline-block; width: fit-content; }
        .floating-elements { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: -1; }
        .floating-circle { position: absolute; border-radius: 50%; background: rgba(239, 146, 6, 0.1); animation: float 6s ease-in-out infinite; }
        .floating-circle:nth-child(1) { width: 80px; height: 80px; top: 20%; left: 10%; animation-delay: 0s; }
        .floating-circle:nth-child(2) { width: 120px; height: 120px; top: 60%; right: 10%; animation-delay: 2s; }
        .floating-circle:nth-child(3) { width: 60px; height: 60px; bottom: 20%; left: 20%; animation-delay: 4s; }
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 33% { transform: translateY(-20px) rotate(120deg); } 66% { transform: translateY(10px) rotate(240deg); } }
        @media (max-width: 768px) { .page-title { font-size: 2.5rem; } .recipe-container { grid-template-columns: 1fr; gap: 1.5rem; } }
        @media (max-width: 480px) { body { padding: 1rem 0.5rem; } .page-title { font-size: 2rem; } .recipe-card h2 { margin: 1rem 1rem 0.5rem; font-size: 1.2rem; } .recipe-card p { margin: 0 1rem 0.8rem; } .recipe-card .category { margin: 0 1rem 1rem; } }
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
<!-- NAVBAR END -->







    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>


<br><br>
<main>
    <h1 class="page-title">All Recipes</h1>
    <div class="recipe-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <a href="detailedrecipe.php?recipe_id=<?= urlencode($row['recipe_id']) ?>" class="recipe-card-link">
                <div class="recipe-card">
                    <img src="<?= !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'https://readdy.ai/api/search-image?query=food&width=400&height=300' ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    <h2><?= htmlspecialchars($row['title']) ?></h2>
                    <p><?= htmlspecialchars(mb_strimwidth($row['description'], 0, 80, '...')) ?></p>
                    <span class="category"><?= htmlspecialchars($row['category_name']) ?></span>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
    </main>



    	 <!-- ✅ FULL-WIDTH FOOTER FIXED -->
<!-- FOOTER (use this HTML exactly if you want the one from canvas) -->
 <footer class="footer">
  <div class="footer-wrapper">
    <div class="footer-main">
      <div class="footer-col">
        <span class="foot-brand">Dish Diary</span>
        <p class="footer-desc">
          Discover, create, and share amazing recipes with food enthusiasts around the world.
        </p>
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
    <div class="footer-bottom">
      <span>© 2025 Dish Diary. All rights reserved.</span>
      <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>


<!-- FOOTER END -->



</body>
</html>