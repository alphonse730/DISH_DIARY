<!-- index.php -->

<?php
session_start();
$is_logged_in = isset($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dish Diary - Food Recipe Management System</title>
  <link rel="stylesheet" href="index.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <script>
    var isLoggedIn = <?php echo $is_logged_in ? 'true' : 'false'; ?>;
  </script>
</head>
<body>
  <!-- Login Alert (hidden by default) -->
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
    <div class="brand">
      <a href="#" class="brand-title">Dish Diary</a>
    </div>
    <nav class="nav-menu" id="mainNav">
      <a href="index.php" class="nav-link">Home</a>
      <a href="recipes.php" class="nav-link">Recipes</a>
      <a href="categories.php" class="nav-link">Categories</a>
      <a href="#" class="nav-link">Cooking tips</a>
      <a href="#" class="nav-link">About</a>
      <a href="#" class="nav-link">Contact</a>
    </nav>
    <div class="nav-icons">
      <div class="icon-btn"><i class="ri-search-line ri-lg"></i></div>
      <div class="icon-btn"><i class="ri-heart-line ri-lg"></i></div>

      <?php if (isset($_SESSION['id'])): ?>
        <!-- Logged in -->
        <a href="profile.php" class="sign-in-btn">Profile</a>
      <?php else: ?>
        <!-- Not logged in -->
        <a href="signup.php" class="sign-in-btn">Signup</a>
        <a href="login.php" class="sign-in-btn">Login</a>
      <?php endif; ?>

      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>

<!-- Hero Section with Background Image and Overlay -->
<section class="hero-section">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="container hero-content">
    <h1>Discover &amp; Share Amazing Recipes</h1>
    <p>Find inspiration for your next meal with thousands of recipes from home cooks around the world.</p>
    <div class="search-bar">
      <i class="ri-search-line"></i>
      <input type="text" placeholder="Search for recipes, ingredients, cuisines...">
      <button>Search</button>
    </div>
    
  </div>
</section>
<!-- Categories Section -->
<section class="categories-section">
  <div class="container">
    <div class="section-header">
      <h2>Popular Categories</h2>
      <a href="#" class="view-all">View All <i class="ri-arrow-right-line"></i></a>
    </div>
    <div class="categories-grid">
      <a href="category.php?category_id=1" class="category-card">
        <img src="https://media.istockphoto.com/id/1292563627/photo/assorted-south-indian-breakfast-foods-on-wooden-background-ghee-dosa-uttappam-medhu-vada.jpg?s=612x612&w=0&k=20&c=HvuYT3RiWj5YsvP2_pJrSWIcZUXhnTKqjKhdN3j_SgY=" alt="Breakfast">
        <div class="category-overlay"><span>Breakfast</span></div>
        <div class="category-info">
          <h3>Breakfast</h3>
        </div>
      </a>
      <a href="category.php?category_id=2" class="category-card">
        <img src="https://t3.ftcdn.net/jpg/06/53/02/64/360_F_653026495_ZmK9aF4vLIbScED62p6BlzrluL0Q9IJo.jpg" alt="Lunch">
        <div class="category-overlay"><span>Lunch</span></div>
        <div class="category-info">
          <h3>Lunch</h3>
        </div>
      </a>
      <a href="category.php?category_id=3" class="category-card">
        <img src="https://st.depositphotos.com/1006627/2011/i/450/depositphotos_20112143-stock-photo-indian-food.jpg" alt="Dinner">
        <div class="category-overlay"><span>Dinner</span></div>
        <div class="category-info">
          <h3>Dinner</h3>
        </div>
      </a>
      <a href="category.php?category_id=5" class="category-card">
        <img src="https://media.istockphoto.com/id/1054228718/photo/indian-sweets-in-a-plate-includes-gulab-jamun-rasgulla-kaju-katli-morichoor-bundi-laddu.jpg?s=612x612&w=0&k=20&c=hYWCXLaldKvhxdBa83M0RnUij7BCmhf-ywWdvyIXR40=" alt="Desserts">
        <div class="category-overlay"><span>Desserts</span></div>
        <div class="category-info">
          <h3>Desserts</h3>
        </div>
      </a>
      <a href="category.php?category_id=4" class="category-card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHMGRPQhJ6e_lQlEjZk_SD2_asAyh6__TlCQ&s" alt="Snacks">
        <div class="category-overlay"><span>Snacks</span></div>
        <div class="category-info">
          <h3>Snacks</h3>
        </div>
      </a>
      <a href="category.php?category_id=6" class="category-card">
        <img src="https://media.istockphoto.com/id/1253099922/photo/assortment-of-fresh-fruits-and-vegetables-juices-in-rainbow-colors.jpg?s=612x612&w=0&k=20&c=lFC0lAcR0FoPegoMTuJxc3fEAISbJVwZ1VmWNHzVEX8=" alt="Juices">
        <div class="category-overlay"><span>Juices</span></div>
        <div class="category-info">
          <h3>Juices</h3>
        </div>
      </a>
    </div>
  </div>
</section>
<!-- Featured Recipes Section -->
<section class="featured-section">
  <div class="container">
    <div class="section-header">
      <h2>Featured Recipes</h2>
      <div class="filter-btn-group">
        <button class="filter-btn active">All</button>
        <button class="filter-btn">Latest</button>
        <button class="filter-btn">Popular</button>
      </div>
    </div>
    <div class="featured-grid">
      <div class="recipe-card">
        <div class="recipe-img-wrap">
          <img src="https://readdy.ai/api/search-image?query=A%20delicious%20homemade%20margherita%20pizza%20with%20fresh%20mozzarella%2C%20tomatoes%2C%20and%20basil%20leaves.%20The%20crust%20is%20perfectly%20baked%20with%20a%20slight%20char.%20Steam%20is%20rising%20from%20the%20hot%20pizza.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=400&height=300&seq=8&orientation=landscape" alt="Homemade Margherita Pizza">
          <div class="fav-btn"><i class="ri-heart-line"></i></div>
          <div class="recipe-label italian">Italian</div>
        </div>
        <div class="recipe-info">
          <div class="stars"><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-fill"></i><span>(128)</span></div>
          <h3>Homemade Margherita Pizza</h3>
          <p>Classic Italian pizza with fresh mozzarella, tomatoes, and basil on a homemade crust.</p>
          <div class="recipe-meta">
            <span><i class="ri-time-line"></i> 30 mins</span>
            <span><i class="ri-fire-line"></i> Medium</span>
            <span><i class="ri-user-line"></i> 4 servings</span>
          </div>
          <div class="recipe-footer">
            <div class="author">
              <img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20of%20a%20female%20chef%20with%20brown%20hair%20and%20a%20friendly%20smile%2C%20wearing%20a%20white%20chefs%20coat.%20The%20background%20is%20neutral%20and%20the%20lighting%20is%20soft%20and%20flattering.&width=50&height=50&seq=9&orientation=squarish" alt="Chef">
              <span>Emily Rodriguez</span>
            </div>
            <a href="#" class="view-recipe-link">View Recipe</a>
          </div>
        </div>
      </div>
      <div class="recipe-card">
        <div class="recipe-img-wrap">
          <img src="https://readdy.ai/api/search-image?query=A%20bowl%20of%20creamy%20mushroom%20risotto%20garnished%20with%20parmesan%20cheese%20and%20fresh%20herbs.%20The%20risotto%20has%20a%20rich%2C%20creamy%20texture%20with%20visible%20mushroom%20pieces.%20Steam%20is%20rising%20from%20the%20hot%20dish.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=400&height=300&seq=10&orientation=landscape" alt="Creamy Mushroom Risotto">
          <div class="fav-btn"><i class="ri-heart-line"></i></div>
          <div class="recipe-label italian">Italian</div>
        </div>
        <div class="recipe-info">
          <div class="stars"><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-line"></i><span>(94)</span></div>
          <h3>Creamy Mushroom Risotto</h3>
          <p>Creamy Arborio rice slowly cooked with mushrooms, white wine, and Parmesan cheese.</p>
          <div class="recipe-meta">
            <span><i class="ri-time-line"></i> 45 mins</span>
            <span><i class="ri-fire-line"></i> Medium</span>
            <span><i class="ri-user-line"></i> 4 servings</span>
          </div>
          <div class="recipe-footer">
            <div class="author">
              <img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20of%20a%20male%20chef%20with%20dark%20hair%20and%20a%20beard%2C%20wearing%20a%20black%20chefs%20coat.%20The%20background%20is%20neutral%20and%20the%20lighting%20is%20soft%20and%20flattering.&width=50&height=50&seq=11&orientation=squarish" alt="Chef">
              <span>Michael Chen</span>
            </div>
            <a href="#" class="view-recipe-link">View Recipe</a>
          </div>
        </div>
      </div>
      <div class="recipe-card">
        <div class="recipe-img-wrap">
          <img src="https://readdy.ai/api/search-image?query=A%20beautifully%20arranged%20plate%20of%20grilled%20salmon%20with%20asparagus%20and%20lemon.%20The%20salmon%20has%20perfect%20grill%20marks%20and%20is%20garnished%20with%20fresh%20herbs.%20The%20dish%20is%20served%20on%20a%20white%20plate.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=400&height=300&seq=12&orientation=landscape" alt="Grilled Salmon with Asparagus">
          <div class="fav-btn"><i class="ri-heart-line"></i></div>
          <div class="recipe-label seafood">Seafood</div>
        </div>
        <div class="recipe-info">
          <div class="stars"><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><span>(156)</span></div>
          <h3>Grilled Salmon with Asparagus</h3>
          <p>Fresh salmon fillets grilled to perfection and served with roasted asparagus and lemon.</p>
          <div class="recipe-meta">
            <span><i class="ri-time-line"></i> 25 mins</span>
            <span><i class="ri-fire-line"></i> Easy</span>
            <span><i class="ri-user-line"></i> 2 servings</span>
          </div>
          <div class="recipe-footer">
            <div class="author">
              <img src="https://readdy.ai/api/search-image?query=Professional%20headshot%20of%20a%20female%20chef%20with%20blonde%20hair%20tied%20back%2C%20wearing%20a%20gray%20chefs%20coat.%20The%20background%20is%20neutral%20and%20the%20lighting%20is%20soft%20and%20flattering.&width=50&height=50&seq=13&orientation=squarish" alt="Chef">
              <span>Sophia Williams</span>
            </div>
            <a href="#" class="view-recipe-link">View Recipe</a>
          </div>
        </div>
      </div>
    </div>
    <div class="center-btn">
      <a href="#" class="outline-btn">View All Recipes</a>
    </div>
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
      <div class="how-card">
        <div class="how-icon"><i class="ri-search-line"></i></div>
        <h3>Discover Recipes</h3>
        <p>Browse thousands of recipes from home cooks around the world. Filter by cuisine, dietary needs, or ingredients.</p>
      </div>
      <div class="how-card">
        <div class="how-icon"><i class="ri-book-open-line"></i></div>
        <h3>Create Recipe Books</h3>
        <p>Save your favorite recipes and organize them into custom recipe books for easy access.</p>
      </div>
      <div class="how-card">
        <div class="how-icon"><i class="ri-share-line"></i></div>
        <h3>Share Your Creations</h3>
        <p>Upload your own recipes, share them with the community, and get feedback from other food lovers.</p>
      </div>
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
          <a href="#" class="cta-btn-primary">Sign Up Free</a>
          <a href="#" class="cta-btn-outline">Learn More</a>
        </div>
      </div>
      <div class="cta-image">
        <img src="https://readdy.ai/api/search-image?query=A%20diverse%20group%20of%20people%20cooking%20together%20in%20a%20modern%20kitchen.%20They%20are%20smiling%20and%20collaborating%20on%20preparing%20various%20dishes.%20The%20kitchen%20is%20bright%20and%20well-equipped%20with%20modern%20appliances.%20The%20atmosphere%20is%20warm%20and%20inviting.&width=600&height=400&seq=14&orientation=landscape" alt="People cooking together">
      </div>
    </div>
  </div>
</section>
<!-- Newsletter Section -->
<section class="newsletter-section">
  <div class="container">
    <div class="newsletter-content">
      <h2>Subscribe to Our Newsletter</h2>
      <p>Get weekly recipe inspiration, cooking tips, and exclusive content delivered to your inbox.</p>
      <div class="newsletter-form">
        <input type="email" placeholder="Enter your email address">
        <button>Subscribe</button>
      </div>
      <div class="newsletter-checkbox">
        <label class="custom-checkbox">
          <input type="checkbox">
          <span class="checkmark"></span>
          I agree to receive emails from Dish Diary
        </label>
      </div>
    </div>
  </div>
</section>
<!-- Footer -->
<footer class="footer">
  <div class="container">
    <div class="footer-main">
      <div class="footer-col">
        <a href="#" class="brand-title foot-brand">Dish Diary</a>
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
          <li><a href="#">Home</a></li>
          <li><a href="#">Recipes</a></li>
          <li><a href="#">Categories</a></li>
          <li><a href="#">Popular</a></li>
          <li><a href="#">Latest</a></li>
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

<script>
  function openLoginModal() {
    document.getElementById("loginModal").style.display = "flex";
  }
  function closeLoginModal() {
    document.getElementById("loginModal").style.display = "none";
  }

  // Restrict nav links and category cards to logged-in users
  document.querySelectorAll('.nav-menu .nav-link').forEach(function(link) {
    link.addEventListener('click', function(e) {
      if (!isLoggedIn) {
        e.preventDefault();
        openLoginModal();
      }
    });
  });
  document.querySelectorAll('.categories-grid .category-card').forEach(function(card) {
    card.addEventListener('click', function(e) {
      if (!isLoggedIn) {
        e.preventDefault();
        openLoginModal();
      }
    });
  });
</script>

</body>
</html>