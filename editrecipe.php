<!-- editrecipe.php -->


<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}
$user_id = $_SESSION['id'];
// ...existing code...
?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Recipe - Dish Diary</title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .edit-recipe-container { max-width: 540px; margin: 3rem auto; background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #ff6b6b11; padding: 2.5rem 2.2rem 2rem; }
    .edit-recipe-title { font-family: var(--font-brand); color: var(--primary); font-size: 2rem; margin-bottom: 1.5rem; }
    .edit-recipe-form label { display: block; margin-bottom: 0.5em; font-weight: 500; color: #444; }
    .edit-recipe-form input, .edit-recipe-form textarea, .edit-recipe-form select { width: 100%; padding: 0.7em; border-radius: 7px; border: 1px solid #ddd; margin-bottom: 1.2em; font-size: 1em; }
    .edit-recipe-form textarea { min-height: 90px; resize: vertical; }
    .edit-recipe-form .submit-btn { background: linear-gradient(90deg, var(--primary), var(--secondary)); color: #fff; border: none; border-radius: 8px; padding: 0.7em 2em; font-size: 1.1em; font-weight: 600; box-shadow: 0 2px 12px #ff6b6b22; cursor: pointer; transition: background 0.2s, box-shadow 0.2s; }
    .edit-recipe-form .submit-btn:hover { background: linear-gradient(90deg, var(--secondary), var(--primary)); }
    .edit-recipe-form .img-preview { margin-bottom: 1em; }
    .edit-recipe-form .img-preview img { max-width: 100%; max-height: 120px; border-radius: 8px; }
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
      <a href="recipes.php" class="nav-link">Recipes</a>
      <a href="categories.php" class="nav-link">Categories</a>
      <a href="#" class="nav-link">Cooking tips</a>
      <a href="#" class="nav-link">About</a>
      <a href="#" class="nav-link">Contact</a>
    </nav>
    <div class="nav-icons">
      <div class="icon-btn"><i class="ri-search-line ri-lg"></i></div>
      <div class="icon-btn"><i class="ri-heart-line ri-lg"></i></div>
      <a href="profile.php" class="sign-in-btn" style="display: flex; align-items: center;">
        <i class="ri-user-line" style="margin-right: 6px;"></i>
        <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Profile'; ?>
      </a>
      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>
<div class="edit-recipe-container">
  <div class="edit-recipe-title">Edit Recipe</div>
  <form class="edit-recipe-form" method="post" enctype="multipart/form-data">
    <label for="titleInput">Title</label>
    <input type="text" name="title" id="titleInput" value="<?= htmlspecialchars($title) ?>" required>
    <label for="descInput">Description</label>
    <textarea name="description" id="descInput" required><?= htmlspecialchars($description) ?></textarea>
    <label for="stepsInput">Steps</label>
    <textarea name="steps" id="stepsInput" required><?= htmlspecialchars($steps) ?></textarea>
    <div style="display: flex; gap: 1em;">
      <div style="flex:1;">
        <label for="prepTimeInput">Prep Time (min)</label>
        <input type="number" name="prep_time_min" id="prepTimeInput" min="0" value="<?= htmlspecialchars($prep_time_min) ?>" required>
      </div>
      <div style="flex:1;">
        <label for="cookTimeInput">Cook Time (min)</label>
        <input type="number" name="cook_time_min" id="cookTimeInput" min="0" value="<?= htmlspecialchars($cook_time_min) ?>" required>
      </div>
    </div>
    <label for="nutritionInput">Nutrition Info</label>
    <textarea name="nutrition_info" id="nutritionInput" placeholder="e.g. Calories: 200, Protein: 10g, ..."><?= htmlspecialchars($nutrition_info) ?></textarea>
    <label for="difficultyInput">Difficulty</label>
    <select name="difficulty_id" id="difficultyInput" required>
      <?php foreach ($difficulties as $d): ?>
        <option value="<?= $d['difficulty_id'] ?>"<?= $d['difficulty_id'] == $difficulty_id ? ' selected' : '' ?>><?= htmlspecialchars($d['level_name']) ?></option>
      <?php endforeach; ?>
    </select>
    <label for="categoryInput">Category</label>
    <select name="category_id" id="categoryInput" required>
      <?php foreach ($categories as $c): ?>
        <option value="<?= $c['category_id'] ?>"<?= $c['category_id'] == $category_id ? ' selected' : '' ?>><?= htmlspecialchars($c['category_name']) ?></option>
      <?php endforeach; ?>
    </select>
    <label for="imageFileInput">Image</label>
    <input type="file" name="image_file" id="imageFileInput" accept="image/*">
    <?php if (!empty($upload_error)): ?>
      <div style="color: red; margin-bottom: 1em;"> <?= htmlspecialchars($upload_error) ?> </div>
    <?php endif; ?>
    <?php if (!empty($update_error)): ?>
      <div style="color: red; margin-bottom: 1em;"> <?= htmlspecialchars($update_error) ?> </div>
    <?php endif; ?>
    <div class="img-preview">
      <?php if (!empty($image_url) && file_exists(__DIR__ . '/' . $image_url)): ?>
        <img src="<?= htmlspecialchars($image_url) ?>" alt="Recipe Image">
      <?php endif; ?>
    </div>
    <button type="submit" class="submit-btn">Save Changes</button>
    <a href="myrecipes.php" style="margin-left:1em;">Cancel</a>
  </form>
</div>
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
</body>
</html>
