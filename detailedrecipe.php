<!-- detailedrecipe.php -->

<?php
// Get recipe_id from URL
if (!isset($_GET['recipe_id']) || !is_numeric($_GET['recipe_id'])) {
  die('Invalid recipe ID.');
}
$recipe_id = intval($_GET['recipe_id']);
$conn = new mysqli("localhost", "root", "", "dish_diary");
if ($conn->connect_error) {
  die("Connection failed: " . htmlspecialchars($conn->connect_error));
}
$sql = "SELECT r.*, c.category_name, d.level_name, u.name AS user_name FROM recipes r LEFT JOIN categories c ON r.category_id = c.category_id LEFT JOIN difficultylevels d ON r.difficulty_id = d.difficulty_id LEFT JOIN users u ON r.id = u.id WHERE r.recipe_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
  die("Query preparation failed: " . htmlspecialchars($conn->error));
}
$stmt->bind_param('i', $recipe_id);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();
$stmt->close();
$conn->close();
if (!$recipe) {
  die('Recipe not found.');
}
// Use image_url from database, fallback to default if missing
$imgSrc = !empty($recipe['image_url']) ? htmlspecialchars($recipe['image_url']) : 'https://readdy.ai/api/search-image?query=A%20delicious%20homemade%20margherita%20pizza%20with%20fresh%20mozzarella%2C%20tomatoes%2C%20and%20basil%20leaves.%20The%20crust%20is%20perfectly%20baked%20with%20a%20slight%20char.%20Steam%20is%20rising%20from%20the%20hot%20pizza.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=400&height=300&seq=8&orientation=landscape';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($recipe['title']) ?> - Dish Diary</title>
  <link rel="stylesheet" href="recipes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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


     /* FOOTER  CSS START*/
   /* ===== Footer (solid, full-width, dark) ===== */
.footer{
  width:100vw;
  margin-left:calc(-50vw + 50%);   /* full-bleed */
  background:#1f2937;              /* solid slate/navy */
  color:#e5e7eb;
  padding:64px 24px 28px;
  position:relative;
  z-index:2;                        /* sits above blurred bg */
}

.footer-wrapper{
  max-width:1200px;
  margin:0 auto;
}

.footer-main{
  display:flex;
  flex-wrap:wrap;
  gap:48px;
  justify-content:space-between;
}

.footer-col{
  flex:1 1 220px;
  min-width:220px;
}

.footer-col h3{
  color:#ffffff;
  font-size:1.05rem;
  font-weight:700;
  margin:0 0 14px;
}

.foot-brand{
  font-family:'Pacifico', cursive;
  font-size:2rem;
  color:#ff6b35;
  display:inline-block;
  margin-bottom:12px;
}

.footer-desc{
  color:#cbd5e1;
  font-size:.95rem;
  line-height:1.6;
  margin:8px 0 18px;
}

.footer-col ul{
  list-style:none;
  padding:0;
  margin:0;
}
.footer-col ul li{
  margin:10px 0;
  color:#cbd5e1;
}
.footer-col ul li a{
  color:#cbd5e1;
  text-decoration:none;
  transition:color .2s ease;
}
.footer-col ul li a:hover{
  color:#ffffff;
}

/* social icons like the other page */
.footer-socials a{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  width:36px; height:36px;
  margin-right:10px;
  border-radius:50%;
  background:rgba(255,255,255,.08);
  color:#e5e7eb;
  transition:transform .2s ease, background .2s ease, color .2s ease;
}
.footer-socials a:hover{
  transform:translateY(-2px);
  background:rgba(255,255,255,.14);
  color:#ffffff;
}

/* divider & bottom row */
.footer hr{
  border:none;
  border-top:1px solid rgba(255,255,255,.08);
  margin:34px 0 18px;
}
.footer-bottom{
  display:flex;
  gap:16px;
  align-items:center;
  justify-content:space-between;
  flex-wrap:wrap;
  color:#9ca3af;
  font-size:.92rem;
}
.footer-bottom .footer-links a{
  color:#9ca3af;
  text-decoration:none;
  margin-left:26px;
}
.footer-bottom .footer-links a:hover{
  color:#ffffff;
}

/* responsive stack */
@media (max-width: 780px){
  .footer-main{gap:28px;}
  .footer-col{flex:1 1 100%; min-width:unset;}
  .footer-bottom{flex-direction:column; align-items:flex-start;}
}

/* FOOTER CSS END */

    .detailed-container {
      max-width: 600px;
      margin: 40px auto;
      background: rgba(255,255,255,0.97);
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(239,146,6,0.10), 0 2px 12px rgba(0,0,0,0.10);
      padding: 36px 32px 28px 32px;
      text-align: left;
      transition: box-shadow 0.3s, transform 0.3s;
    }
    .detailed-container:hover {
      box-shadow: 0 12px 40px rgba(239,146,6,0.16), 0 2px 16px rgba(0,0,0,0.12);
      transform: translateY(-2px) scale(1.01);
    }
    .detailed-container img {
      width: 100%;
      max-width: 400px;
      height: auto;
      border-radius: 14px;
      margin-bottom: 24px;
      display: block;
      margin-left: auto;
      margin-right: auto;
      box-shadow: 0 2px 16px rgba(239,146,6,0.10);
      transition: box-shadow 0.3s, transform 0.3s;
    }
    .detailed-container img:hover {
      box-shadow: 0 8px 32px rgba(239,146,6,0.18);
      transform: scale(1.04);
    }
    .back-link {
      display: inline-block;
      margin-bottom: 24px;
      color: #ef9206;
      text-decoration: none;
      font-weight: bold;
      font-size: 1.1rem;
      transition: color 0.2s;
    }
    .back-link:hover {
      text-decoration: underline;
      color: #d17a00;
    }
    .recipe-steps p {
      background: #fffbe9;
      border-radius: 8px;
      padding: 10px 14px;
      margin-bottom: 10px;
      box-shadow: 0 1px 4px rgba(239,146,6,0.07);
      transition: box-shadow 0.2s, background 0.2s;
    }
    .recipe-steps p:hover {
      background: #ffe0b2;
      box-shadow: 0 4px 12px rgba(239,146,6,0.12);
    }
  </style>
</head>
<body>
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
  <div class="detailed-container">
    <a href="recipes.php" class="back-link">&larr; Back to Recipes</a>
    <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($recipe['title']) ?>">
    <h1><?= htmlspecialchars($recipe['title']) ?></h1>
    <p><strong>Category:</strong> <?= htmlspecialchars($recipe['category_name']) ?></p>
    <p><strong>Difficulty Level:</strong> <?= htmlspecialchars($recipe['level_name']) ?></p>
    <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
    <p><strong>Steps:</strong></p>
    <div class="recipe-steps">
      <?php
        $steps = preg_split('/\r?\n\r?\n/', trim($recipe['steps']));
        $stepNumber = 1;
        foreach ($steps as $stepBlock) {
          $lines = preg_split('/\r?\n/', trim($stepBlock));
          if (count($lines) > 0 && $lines[0] !== '') {
            // Remove leading number and dot from heading if present
            $heading = preg_replace('/^\d+\.\s*/', '', $lines[0]);
            $heading = htmlspecialchars($heading);
            $desc = '';
            if (count($lines) > 1) {
              $desc = htmlspecialchars(implode(' ', array_slice($lines, 1)));
            }
            echo '<p><strong>' . $stepNumber . '. ' . $heading . '</strong><br>' . ($desc ? $desc : '') . '</p>';
            $stepNumber++;
          }
        }
      ?>
    </div>
    <p><strong>Prep Time:</strong> <?= htmlspecialchars($recipe['prep_time_min']) ?> min</p>
    <p><strong>Cook Time:</strong> <?= htmlspecialchars($recipe['cook_time_min']) ?> min</p>
    <p><strong>Nutrition Info:</strong></p>
    <ul style="margin-top:0;">
      <?php
        $nutritionLines = preg_split('/\r?\n/', trim($recipe['nutrition_info']));
        foreach ($nutritionLines as $line) {
          $line = trim($line);
          if ($line !== '') {
            echo '<li>' . htmlspecialchars($line) . '</li>';
          }
        }
      ?>
    </ul>
    
   
    <p><strong>Uploaded by:</strong> <?= htmlspecialchars($recipe['user_name']) ?></p>
  </div>
  	 <!-- ✅ FULL-WIDTH FOOTER FIXED -->
<footer class="footer">
  <!-- Remove the limiting .container -->
  <div class="footer-wrapper">
    <div class="footer-main">
      <div class="footer-col">
        <a href="#" class="brand-title foot-brand login-required">Dish Diary</a>
        <p class="footer-desc">Discover, create, and share amazing recipes with food enthusiasts around the world.</p>
        <div class="footer-socials">
          <a href="https://www.facebook.com/"><i class="ri-facebook-fill"></i></a>
          <a href="https://www.instagram.com/accounts/login/?hl=en"><i class="ri-instagram-line"></i></a>
          <a href="https://x.com/"><i class="ri-twitter-x-line"></i></a>
          <a href="https://in.pinterest.com/"><i class="ri-pinterest-line"></i></a>
        </div>
      </div>

      <div class="footer-col">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes.php" class="login-required">Recipes</a></li>
          <li><a href="categories.php" class="login-required">Categories</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3>Resources</h3>
        <ul>
          <li><a href="#" class="login-required">Help Center</a></li>
          <li><a href="#" class="login-required">Blog</a></li>
          <li><a href="cookingtips.php" class="login-required">Cooking Tips</a></li>
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
        <a href="#" class="login-required">Privacy Policy</a>
        <a href="terms.php" class="login-required">Terms of Service</a>
        <a href="#" class="login-required">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>
<!-- FOOTER END -->

</body>
</html>
