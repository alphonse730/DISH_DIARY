<!-- test.php -->


<?php
session_start();
if (!isset($_SESSION['id'])) {
  // If not logged in, redirect to login page
  header('Location: login.php');
  exit();
}
// Optionally, fetch user info here for the profile button (e.g., $_SESSION['username'])
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Profile';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dish Diary - Food Recipe Management System</title>
  <link rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <script>
    var isLoggedIn = true;
  </script>
</head>
<body>
<!-- Navigation Bar -->
<header class="navbar">
  <div class="container nav-container">
    <div class="brand">
      <a href="#" class="brand-title">Dish Diary</a>
    </div>
    <nav class="nav-menu" id="mainNav">
      <a href="#" class="nav-link">Home</a>
      <a href="recipes.php" class="nav-link">Recipes</a>
      <a href="#" class="nav-link">Categories</a>
      <a href="#" class="nav-link">Cooking tips</a>
      <a href="#" class="nav-link">About</a>
      <a href="#" class="nav-link">Contact</a>
    </nav>
    <div class="nav-icons">
      <div class="icon-btn"><i class="ri-search-line ri-lg"></i></div>
      <div class="icon-btn"><i class="ri-heart-line ri-lg"></i></div>
      <!-- Profile Button (instead of login/signup) -->
      <a href="profile.php" class="sign-in-btn" style="display: flex; align-items: center;">
        <i class="ri-user-line" style="margin-right: 6px;"></i>
        <?php echo htmlspecialchars($username); ?>
      </a>
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
    <div class="quick-tags">
      <span>Quick Dinner</span>
      <span>Vegetarian</span>
      <span>Desserts</span>
      <span>Healthy</span>
      <span>Italian</span>
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
      <div class="category-card">
        <img src="https://readdy.ai/api/search-image?query=A%20beautifully%20arranged%20plate%20of%20Italian%20pasta%20with%20fresh%20tomato%20sauce%2C%20basil%20leaves%2C%20and%20parmesan%20cheese.%20The%20pasta%20is%20perfectly%20cooked%20and%20the%20sauce%20is%20rich%20and%20vibrant%20red.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=300&height=300&seq=2&orientation=squarish" alt="Italian">
        <div class="category-overlay"><span>Italian</span></div>
        <div class="category-info">
          <h3>Italian</h3>
          <p>248 recipes</p>
        </div>
      </div>
      <div class="category-card">
        <img src="https://readdy.ai/api/search-image?query=A%20colorful%20Asian%20stir-fry%20dish%20with%20vibrant%20vegetables%2C%20tofu%2C%20and%20noodles.%20The%20dish%20is%20garnished%20with%20green%20onions%20and%20sesame%20seeds.%20Steam%20is%20rising%20from%20the%20hot%20food.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=300&height=300&seq=3&orientation=squarish" alt="Asian">
        <div class="category-overlay"><span>Asian</span></div>
        <div class="category-info">
          <h3>Asian</h3>
          <p>186 recipes</p>
        </div>
      </div>
      <div class="category-card">
        <img src="https://readdy.ai/api/search-image?query=A%20healthy%20vegetarian%20salad%20bowl%20with%20fresh%20greens%2C%20avocado%2C%20quinoa%2C%20chickpeas%2C%20and%20colorful%20vegetables.%20The%20salad%20is%20dressed%20with%20a%20light%20vinaigrette.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=300&height=300&seq=4&orientation=squarish" alt="Vegetarian">
        <div class="category-overlay"><span>Vegetarian</span></div>
        <div class="category-info">
          <h3>Vegetarian</h3>
          <p>312 recipes</p>
        </div>
      </div>
      <div class="category-card">
        <img src="https://readdy.ai/api/search-image?query=A%20decadent%20chocolate%20dessert%20with%20layers%20of%20cake%2C%20mousse%2C%20and%20ganache.%20The%20dessert%20is%20garnished%20with%20fresh%20berries%20and%20a%20dusting%20of%20powdered%20sugar.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=300&height=300&seq=5&orientation=squarish" alt="Desserts">
        <div class="category-overlay"><span>Desserts</span></div>
        <div class="category-info">
          <h3>Desserts</h3>
          <p>275 recipes</p>
        </div>
      </div>
      <div class="category-card">
        <img src="https://readdy.ai/api/search-image?query=A%20traditional%20Mexican%20dish%20with%20colorful%20ingredients%20including%20tacos%2C%20guacamole%2C%20salsa%2C%20and%20lime.%20The%20dish%20is%20arranged%20on%20a%20rustic%20wooden%20surface.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=300&height=300&seq=6&orientation=squarish" alt="Mexican">
        <div class="category-overlay"><span>Mexican</span></div>
        <div class="category-info">
          <h3>Mexican</h3>
          <p>198 recipes</p>
        </div>
      </div>
      <div class="category-card">
        <img src="https://readdy.ai/api/search-image?query=A%20quick%20and%20easy%20breakfast%20dish%20with%20eggs%2C%20toast%2C%20avocado%2C%20and%20fresh%20fruit.%20The%20dish%20is%20arranged%20on%20a%20white%20plate.%20The%20background%20is%20simple%20and%20clean%20to%20highlight%20the%20dish.&width=300&height=300&seq=7&orientation=squarish" alt="Breakfast">
        <div class="category-overlay"><span>Breakfast</span></div>
        <div class="category-info">
          <h3>Breakfast</h3>
          <p>167 recipes</p>
        </div>
      </div>
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
<script src="main.js"></script>
</body>
</html>