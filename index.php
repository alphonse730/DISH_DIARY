<!-- index.php -->

<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    // User not logged in → show login modal instead of treating admin as user
    $is_logged_in = false;
} else {
    $is_logged_in = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dish Diary - Food Recipe Management System</title>
  <link rel="stylesheet" href="index.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

  <style>
    /* ===== NAVBAR CSS START ===== */
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
      height: 90px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
      width: 100%;
      box-sizing: border-box;
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
    .brand-title:hover { transform: scale(1.05); }
    .nav-menu { display: flex; gap: 2rem; }
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
      top: 0; left: -100%;
      width: 100%; height: 100%;
      background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
      transition: left 0.3s ease;
      z-index: -1;
    }
    .nav-link:hover::before,
    .nav-link.active::before { left: 0; }
    .nav-link:hover,
    .nav-link.active {
      color: #fff;
      transform: translateY(-2px);
    }
    .nav-icons {
      display: flex;
      align-items: center;
      gap: 1.2rem;
      flex-wrap: nowrap;
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
    .icon-btn:hover { color: #f7931e; }
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
    .sign-in-btn:hover { background: linear-gradient(90deg, #f7931e, #ff6b35); }
    @media (max-width: 900px) {
      .container.nav-container { flex-direction: column; height: auto; padding: 0 10px; }
      .nav-menu { gap: 1rem; }
    }
    @media (max-width: 600px) {
      .container.nav-container { flex-direction: column; height: auto; padding: 0 5px; }
      .nav-menu { flex-wrap: wrap; gap: 0.5rem; }
      .brand-title { font-size: 1.3rem; }
    }
    body { padding-top: 90px; }
    /* ===== NAVBAR CSS END ===== */
    /* CTA Section */
.cta-section {
  padding: 60px 20px;
}
.cta-wrap {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap; /* allows stacking on smaller screens */
  gap: 2rem;
}
.cta-content {
  flex: 1 1 400px;
}
.cta-image {
  flex: 1 1 400px;
  text-align: center;
}
.cta-image img {
  max-width: 100%;
  height: auto;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

  </style>

  <script>
    var isLoggedIn = <?php echo $is_logged_in ? 'true' : 'false'; ?>;
  </script>
</head>
<body>

<!-- Login Modal -->
<div id="loginModal" class="login-modal">
  <div class="modal-overlay"></div>
  <div class="modal-box">
    <button class="modal-close" onclick="closeLoginModal()">×</button>
    <h2>Login Required</h2>
    <p>Please login to access this feature and explore all the delicious recipes, cooking tips, and community features we have to offer.</p>
    <div class="modal-buttons">
      <a href="login.php" class="modal-login-btn">Login Now</a>
      <button class="modal-cancel-btn" onclick="closeLoginModal()">Cancel</button>
    </div>
  </div>
</div>

<!-- Navigation Bar -->
<header class="navbar">
  <div class="container nav-container">
    <div class="brand"><a href="index.php" class="brand-title">Dish Diary</a></div>
    <nav class="nav-menu" id="mainNav">
      <a href="index.php" class="nav-link">Home</a>
      <a href="recipes.php" class="nav-link login-required">Recipes</a>
      <a href="categories.php" class="nav-link login-required">Categories</a>
      <a href="cookingtips.php" class="nav-link login-required">Cooking Tips</a>
      <a href="about.php" class="nav-link login-required">About</a>
      <a href="feedback.php" class="nav-link login-required">feedback</a>
    </nav>
    <div class="nav-icons">
  <!-- Search icon removed as requested -->
      <a href="favorites.php" class="icon-btn login-required"><i class="ri-heart-line ri-lg"></i></a>
      <?php if ($is_logged_in): ?>
        <a href="profile.php" class="sign-in-btn">Profile</a>
      <?php else: ?>
        <a href="signup.php" class="sign-in-btn">Signup</a>
        <a href="login.php" class="sign-in-btn">Login</a>
      <?php endif; ?>
      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>

<!-- Hero Section -->
<section class="hero-section">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="container hero-content">
    <h1>Discover &amp; Share Amazing Recipes</h1>
    <p>Find inspiration for your next meal with thousands of recipes from home cooks around the world.</p>
    <div class="search-bar">
      <form method="GET" action="index.php" 
      class="login-required" 
      id="searchForm" 
      style="display: flex; align-items: center; gap: 0.5em;">
  <i class="ri-search-line"></i>
  <input type="text" name="search" placeholder="Search for recipes by title..." 
         value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
  <button type="submit">Search</button>
</form>
    </div>
  </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
  <div class="container">
    <div class="section-header">
      <h2>Popular Categories</h2>
      <a href="recipes.php" class="view-all login-required">View All <i class="ri-arrow-right-line"></i></a>
    </div>
    <div class="categories-grid">
      <a href="category.php?category_id=1" class="category-card login-required">
        <img src="https://media.istockphoto.com/id/1292563627/photo/assorted-south-indian-breakfast-foods-on-wooden-background-ghee-dosa-uttappam-medhu-vada.jpg?s=612x612&w=0&k=20&c=HvuYT3RiWj5YsvP2_pJrSWIcZUXhnTKqjKhdN3j_SgY=" alt="Breakfast">
        <div class="category-overlay"><span>Breakfast</span></div>
        <div class="category-info"><h3>Breakfast</h3></div>
      </a>

      <a href="category.php?category_id=2" class="category-card login-required">
        <img src="https://t3.ftcdn.net/jpg/06/53/02/64/360_F_653026495_ZmK9aF4vLIbScED62p6BlzrluL0Q9IJo.jpg" alt="Lunch">
        <div class="category-overlay"><span>Lunch</span></div>
        <div class="category-info"><h3>Lunch</h3></div>
      </a>

      <a href="category.php?category_id=3" class="category-card login-required">
        <img src="https://st.depositphotos.com/1006627/2011/i/450/depositphotos_20112143-stock-photo-indian-food.jpg" alt="Dinner">
        <div class="category-overlay"><span>Dinner</span></div>
        <div class="category-info"><h3>Dinner</h3></div>
      </a>

      <a href="category.php?category_id=5" class="category-card login-required">
        <img src="https://media.istockphoto.com/id/1054228718/photo/indian-sweets-in-a-plate-includes-gulab-jamun-rasgulla-kaju-katli-morichoor-bundi-laddu.jpg?s=612x612&w=0&k=20&c=hYWCXLaldKvhxdBa83M0RnUij7BCmhf-ywWdvyIXR40=" alt="Desserts">
        <div class="category-overlay"><span>Desserts</span></div>
        <div class="category-info"><h3>Desserts</h3></div>
      </a>

      <a href="category.php?category_id=4" class="category-card login-required">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHMGRPQhJ6e_lQlEjZk_SD2_asAyh6__TlCQ&s" alt="Snacks">
        <div class="category-overlay"><span>Snacks</span></div>
        <div class="category-info"><h3>Snacks</h3></div>
      </a>

      <a href="category.php?category_id=6" class="category-card login-required">
        <img src="https://media.istockphoto.com/id/1253099922/photo/assortment-of-fresh-fruits-and-vegetables-juices-in-rainbow-colors.jpg?s=612x612&w=0&k=20&c=lFC0lAcR0FoPegoMTuJxc3fEAISbJVwZ1VmWNHzVEX8=" alt="Juices">
        <div class="category-overlay"><span>Juices</span></div>
        <div class="category-info"><h3>Juices</h3></div>
      </a>
    </div>
  </div>
</section>


<!-- Featured Recipes Section -->
<section class="featured-section">
  <div class="container">
    <div class="section-header">
      <h2>
        <?php if (!empty($_GET['search'])): ?>
          Search Results for "<?= htmlspecialchars($_GET['search']) ?>"
        <?php else: ?>
          Featured Recipes
        <?php endif; ?>
      </h2>
    </div>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'dish_diary');
    if ($conn->connect_error) { die('Database connection failed: ' . $conn->connect_error); }

    $search = trim($_GET['search'] ?? '');
    if ($search !== '') {
      $stmt = $conn->prepare("SELECT r.*, c.category_name, u.name AS user_name 
                              FROM recipes r 
                              LEFT JOIN categories c ON r.category_id = c.category_id 
                              LEFT JOIN users u ON r.id = u.id 
                              WHERE r.title LIKE ? ORDER BY r.title ASC");
      $like = "%$search%";
      $stmt->bind_param("s", $like);
      $stmt->execute();
      $result = $stmt->get_result();
    } else {
      $sql = "SELECT r.*, c.category_name, u.name AS user_name 
              FROM recipes r 
              LEFT JOIN categories c ON r.category_id = c.category_id 
              LEFT JOIN users u ON r.id = u.id 
              ORDER BY RAND() LIMIT 3";
      $result = $conn->query($sql);
    }
    ?>
    <div class="featured-grid">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <?php
          $is_favorited = false;
          if ($is_logged_in) {
              $stmtFav = $conn->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND recipe_id = ?");
              $stmtFav->bind_param("ii", $_SESSION['id'], $row['recipe_id']);
              $stmtFav->execute();
              $is_favorited = $stmtFav->get_result()->num_rows > 0;
              $stmtFav->close();
          }
          ?>
          <div class="recipe-card">
            <div class="recipe-img-wrap">
              <img src="<?= !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'https://readdy.ai/api/search-image?query=food&width=400&height=300' ?>" 
                   alt="<?= htmlspecialchars($row['title']) ?>">
              <div class="fav-btn login-required" data-recipe-id="<?= $row['recipe_id'] ?>">
                <i class="<?= $is_favorited ? 'ri-heart-fill' : 'ri-heart-line' ?>"></i>
              </div>
              <div class="recipe-label <?= strtolower(htmlspecialchars($row['category_name'])) ?>">
                <?= htmlspecialchars($row['category_name']) ?>
              </div>
            </div>
            <div class="recipe-info">
              <h3><?= htmlspecialchars($row['title']) ?></h3>
              <p><?= htmlspecialchars(mb_strimwidth($row['description'], 0, 80, '...')) ?></p>
              <div class="recipe-meta">
                <span><i class="ri-time-line"></i> <?= htmlspecialchars($row['prep_time_min'] + $row['cook_time_min']) ?> mins</span>
                <span><i class="ri-fire-line"></i> 
                  <?= isset($row['difficulty_id']) ? ($row['difficulty_id'] == 1 ? 'Easy' : ($row['difficulty_id'] == 2 ? 'Medium' : 'Hard')) : '' ?>
                </span>
              </div>
              <div class="recipe-footer">
               
                <a href="detailedrecipe.php?recipe_id=<?= urlencode($row['recipe_id']) ?>" 
                   class="view-recipe-link login-required">View Recipe</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="text-align:center; color:#d67b02; font-size:1.2em;">
          No recipes found for "<?= htmlspecialchars($search) ?>".
        </p>
      <?php endif; ?>
    </div>
    <?php $conn->close(); ?>
  </div>
</section>

<!-- How It Works Section -->
<section class="how-section">
  <div class="container">
    <div class="center-text">
      <h2>How Dish Diary Works</h2>
      <p>Discover, create, and share your favorite recipes with our easy-to-use platform.</p>
    </div>
    <div class="how-grid">
      <div class="how-card"><div class="how-icon"><i class="ri-search-line"></i></div><h3>Discover Recipes</h3><p>Browse thousands of recipes...</p></div>
      <div class="how-card"><div class="how-icon"><i class="ri-book-open-line"></i></div><h3>Create Recipe Books</h3><p>Save your favorite recipes...</p></div>
      <div class="how-card"><div class="how-icon"><i class="ri-share-line"></i></div><h3>Share Your Creations</h3><p>Upload your own recipes...</p></div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
  <div class="container">
    <div class="cta-wrap">
      <div class="cta-content">
        <h2>Ready to Start Your Culinary Journey?</h2>
        <p>Join thousands of food enthusiasts who are discovering, creating, and sharing amazing recipes every day.</p>
        <div class="cta-btn-group">
          <a href="cookingtips.php" class="cta-btn-primary">Cooking Tips </a>
          <a href="about.php" class="cta-btn-outline login-required">Learn More</a>
        </div>
      </div>
      <div class="cta-image">
        <!-- Default CTA image -->
        <img src="https://readdy.ai/api/search-image?query=A%20diverse%20group%20of%20people%20cooking%20together%20in%20a%20modern%20kitchen.%20They%20are%20smiling%20and%20collaborating%20on%20preparing%20various%20dishes.%20The%20kitchen%20is%20bright%20and%20well-equipped%20with%20modern%20appliances.%20The%20atmosphere%20is%20warm%20and%20inviting.&width=600&height=400&seq=14&orientation=landscape" alt="People cooking together">
      </div>
    </div>
  </div>
</section>


<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="footer-main">
      <div class="footer-col">
        <a href="#" class="brand-title foot-brand login-required">Dish Diary</a>
        <p class="footer-desc">Discover, create, and share amazing recipes with food enthusiasts around the world.</p>
        <div class="footer-socials">
          <a href="https://www.facebook.com/"><i class="ri-facebook-fill"></i></a>
          <a href="https://www.instagram.com/"><i class="ri-instagram-line"></i></a>
          <a href="https://x.com/"><i class="ri-twitter-x-line"></i></a>
          <a href="https://in.pinterest.com/"><i class="ri-pinterest-line"></i></a>
        </div>
      </div>
      <div class="footer-col"><h3>Quick Links</h3>
        <ul><li><a href="index.php">Home</a></li><li><a href="recipes.php" class="login-required">Recipes</a></li><li><a href="categories.php" class="login-required">Categories</a></li></ul>
      </div>
      <div class="footer-col"><h3>Resources</h3>
        <ul><li><a href="#" class="login-required">Help Center</a></li><li><a href="#" class="login-required">Blog</a></li><li><a href="cookingtips.php" class="login-required">Cooking Tips</a></li></ul>
      </div>
      <div class="footer-col"><h3>Contact Us</h3>
        <ul><li><i class="ri-map-pin-line"></i>123 Recipe Street, Foodville</li><li><i class="ri-mail-line"></i><a href="mailto:info@dishdiary.com">info@dishdiary.com</a></li><li><i class="ri-phone-line"></i><a href="tel:+1234567890">+1 (234) 567-890</a></li></ul>
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

<script>
  function openLoginModal() {
    document.getElementById("loginModal").style.display = "flex";
  }
  function closeLoginModal() {
    document.getElementById("loginModal").style.display = "none";
  }

  // Restrict all login-required links/buttons for non-logged-in users
 // Restrict all login-required links/buttons/forms for non-logged-in users
document.querySelectorAll('a.login-required, button.login-required, form.login-required').forEach(function(el) {
  el.addEventListener('click', function(e) {
    if (!isLoggedIn) {
      e.preventDefault();
      openLoginModal();
    }
  });
  el.addEventListener('submit', function(e) { // catch form submissions
    if (!isLoggedIn) {
      e.preventDefault();
      openLoginModal();
    }
  });
});


  // Add scroll effect to navbar
  window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
      navbar.style.background = 'rgba(255, 255, 255, 0.98)';
      navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
    } else {
      navbar.style.background = 'rgba(255, 255, 255, 0.95)';
      navbar.style.boxShadow = 'none';
    }
  });
</script>

</body>
</html>
