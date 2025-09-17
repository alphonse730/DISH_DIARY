<!-- editrecipe.php -->
 <!-- users edit recipe -->


<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}
$user_id = $_SESSION['id'];
include 'db.php';

$upload_error = '';
$update_error = '';

// Get recipe_id from query string
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("Invalid recipe ID.");
}
$recipe_id = intval($_GET['id']);

// Fetch dropdowns
$categories = $conn->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);
$difficulties = $conn->query("SELECT * FROM difficultylevels")->fetch_all(MYSQLI_ASSOC);

// Fetch recipe details for this user
$stmt = $conn->prepare("SELECT * FROM recipes WHERE recipe_id = ? AND id = ?");
$stmt->bind_param("ii", $recipe_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();
$stmt->close();

if (!$recipe) {
  die("Recipe not found or you do not have permission to edit it.");
}

// Populate variables
$title = $recipe['title'];
$description = $recipe['description'];
$steps = $recipe['steps'];
$prep_time_min = $recipe['prep_time_min'];
$cook_time_min = $recipe['cook_time_min'];
$nutrition_info = $recipe['nutrition_info'];
$difficulty_id = $recipe['difficulty_id'];
$category_id = $recipe['category_id'];
$image_url = $recipe['image_url'] ?? '';

// ✅ Handle update form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $steps = trim($_POST['steps']);
  $prep_time_min = intval($_POST['prep_time_min']);
  $cook_time_min = intval($_POST['cook_time_min']);
  $nutrition_info = trim($_POST['nutrition_info']);
  $difficulty_id = intval($_POST['difficulty_id']);
  $category_id = intval($_POST['category_id']);
  $new_image_path = $image_url; // keep old image if no new upload

  if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == UPLOAD_ERR_OK) {
    $img_name = basename($_FILES['image_file']['name']);
    $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $new_filename = 'recipe_' . time() . '.' . $ext;
    $target_dir = 'uploads/';
    $target_file = $target_dir . $new_filename;

    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
      $new_image_path = $target_file;
    } else {
      $upload_error = 'Image upload failed.';
    }
  }

  if (empty($upload_error)) {
    $stmt = $conn->prepare("UPDATE recipes 
      SET title=?, description=?, steps=?, prep_time_min=?, cook_time_min=?, nutrition_info=?, image_url=?, difficulty_id=?, category_id=?
      WHERE recipe_id=? AND id=?");
    $stmt->bind_param("sssiiissiii", 
      $title, $description, $steps, $prep_time_min, $cook_time_min, $nutrition_info, 
      $new_image_path, $difficulty_id, $category_id, $recipe_id, $user_id
    );

    if ($stmt->execute()) {
      header("Location: myrecipes.php");
      exit();
    } else {
      $update_error = "Something went wrong while updating the recipe.";
    }
  }
}
?>

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
    /* Navbar Start */ /* ====== NAVBAR CSS START ====== */ header.navbar { position: fixed; top: 0; left: 0; right: 0; height: 115px; width: 100%; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(0, 0, 0, 0.05); z-index: 1000; display: flex; align-items: center; } .container.nav-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; display: flex; justify-content: space-between; align-items: center; height: 100%; gap: 2rem; } .brand-title { font-family: 'Pacifico', cursive; font-size: 2rem; color: #ff6b35; text-decoration: none; white-space: nowrap; transition: transform 0.3s ease; } .brand-title:hover { transform: scale(1.05); } .nav-menu { display: flex; gap: 2rem; } .nav-link { text-decoration: none; color: #2c3e50; font-weight: 500; padding: 0.5rem 1rem; border-radius: 25px; transition: all 0.3s ease; position: relative; overflow: hidden; } .nav-link::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); transition: left 0.3s ease; z-index: -1; } .nav-link:hover::before, .nav-link.active::before { left: 0; } .nav-link:hover, .nav-link.active { color: #fff; transform: translateY(-2px); } .nav-icons { display: flex; align-items: center; gap: 1.2rem; } .icon-btn { background: none; border: none; cursor: pointer; font-size: 1.3rem; color: #ff6b35; transition: color 0.2s; } .icon-btn:hover { color: #f7931e; } .sign-in-btn { background: linear-gradient(90deg, #ff6b35, #f7931e); color: #fff; border: none; border-radius: 8px; padding: 0.5em 1.2em; font-size: 1.05em; font-weight: 600; box-shadow: 0 2px 12px #ff6b6b22; cursor: pointer; margin-left: 0.5em; text-decoration: none; display: flex; align-items: center; transition: background 0.2s, box-shadow 0.2s; } .sign-in-btn:hover { background: linear-gradient(90deg, #f7931e, #ff6b35); } .mobile-menu-btn { display: none; } /* Responsive */ @media (max-width: 900px) { .container.nav-container { flex-direction: column; height: auto; padding: 0 10px; } .nav-menu { display: none; } .mobile-menu-btn { display: flex !important; } } @media (max-width: 600px) { .brand-title { font-size: 1.3rem; } .nav-menu { flex-wrap: wrap; gap: 0.5rem; } } /* Active mobile menu */ .nav-menu.active { position: absolute; top: 90px; right: 1rem; background: #fff; display: flex; flex-direction: column; gap: 1.5rem; box-shadow: 0 6px 24px rgba(0,0,0,0.12); border-radius: 12px; padding: 1.5rem 2rem; z-index: 100; } /* Body padding to offset fixed navbar */ body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #f8ffae 0%, #ef9206 100%); min-height: 100vh; padding-top: 115px; padding-left: 1rem; padding-right: 1rem; } /* ====== NAVBAR CSS END ====== */ /* FOOTER CSS START*/ /* ===== Footer (solid, full-width, dark) ===== */ .footer{ width:100vw; margin-left:calc(-50vw + 50%); /* full-bleed */ background:#1f2937; /* solid slate/navy */ color:#e5e7eb; padding:64px 24px 28px; position:relative; z-index:2; /* sits above blurred bg */ } .footer-wrapper{ max-width:1200px; margin:0 auto; } .footer-main{ display:flex; flex-wrap:wrap; gap:48px; justify-content:space-between; } .footer-col{ flex:1 1 220px; min-width:220px; } .footer-col h3{ color:#ffffff; font-size:1.05rem; font-weight:700; margin:0 0 14px; } .foot-brand{ font-family:'Pacifico', cursive; font-size:2rem; color:#ff6b35; display:inline-block; margin-bottom:12px; } .footer-desc{ color:#cbd5e1; font-size:.95rem; line-height:1.6; margin:8px 0 18px; } .footer-col ul{ list-style:none; padding:0; margin:0; } .footer-col ul li{ margin:10px 0; color:#cbd5e1; } .footer-col ul li a{ color:#cbd5e1; text-decoration:none; transition:color .2s ease; } .footer-col ul li a:hover{ color:#ffffff; } /* social icons like the other page */ .footer-socials a{ display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; margin-right:10px; border-radius:50%; background:rgba(255,255,255,.08); color:#e5e7eb; transition:transform .2s ease, background .2s ease, color .2s ease; } .footer-socials a:hover{ transform:translateY(-2px); background:rgba(255,255,255,.14); color:#ffffff; } /* divider & bottom row */ .footer hr{ border:none; border-top:1px solid rgba(255,255,255,.08); margin:34px 0 18px; } .footer-bottom{ display:flex; gap:16px; align-items:center; justify-content:space-between; flex-wrap:wrap; color:#9ca3af; font-size:.92rem; } .footer-bottom .footer-links a{ color:#9ca3af; text-decoration:none; margin-left:26px; } .footer-bottom .footer-links a:hover{ color:#ffffff; } /* responsive stack */ @media (max-width: 780px){ .footer-main{gap:28px;} .footer-col{flex:1 1 100%; min-width:unset;} .footer-bottom{flex-direction:column; align-items:flex-start;} } /* FOOTER CSS END */ .edit-recipe-container { max-width: 540px; margin: 3rem auto; background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #ff6b6b11; padding: 2.5rem 2.2rem 2rem; } .edit-recipe-title { font-family: var(--font-brand); color: var(--primary); font-size: 2rem; margin-bottom: 1.5rem; } .edit-recipe-form label { display: block; margin-bottom: 0.5em; font-weight: 500; color: #444; } .edit-recipe-form input, .edit-recipe-form textarea, .edit-recipe-form select { width: 100%; padding: 0.7em; border-radius: 7px; border: 1px solid #ddd; margin-bottom: 1.2em; font-size: 1em; } .edit-recipe-form textarea { min-height: 90px; resize: vertical; } .edit-recipe-form .submit-btn { background: linear-gradient(90deg, var(--primary), var(--secondary)); color: #fff; border: none; border-radius: 8px; padding: 0.7em 2em; font-size: 1.1em; font-weight: 600; box-shadow: 0 2px 12px #ff6b6b22; cursor: pointer; transition: background 0.2s, box-shadow 0.2s; } .edit-recipe-form .submit-btn:hover { background: linear-gradient(90deg, var(--secondary), var(--primary)); } .edit-recipe-form .img-preview { margin-bottom: 1em; } .edit-recipe-form .img-preview img { max-width: 100%; max-height: 120px; border-radius: 8px; }
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
       <a href="profile.php" class="sign-in-btn">Profile</a>
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
        <option value="<?= $d['difficulty_id'] ?>"<?= $d['difficulty_id'] == $difficulty_id ? ' selected' : '' ?>>
          <?= htmlspecialchars($d['level_name']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label for="categoryInput">Category</label>
    <select name="category_id" id="categoryInput" required>
      <?php foreach ($categories as $c): ?>
        <option value="<?= $c['category_id'] ?>"<?= $c['category_id'] == $category_id ? ' selected' : '' ?>>
          <?= htmlspecialchars($c['category_name']) ?>
        </option>
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
</body>
</html>
