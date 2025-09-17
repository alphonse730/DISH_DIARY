<!-- addrecipe.php -->

<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}
include 'db.php';

$user_id = $_SESSION['id'];
$upload_error = '';
$add_error = '';

// Fetch dropdowns
$categories = $conn->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);
$difficulties = $conn->query("SELECT * FROM difficultylevels")->fetch_all(MYSQLI_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $steps = $_POST['steps'];
  $prep_time = $_POST['prep_time_min'];
  $cook_time = $_POST['cook_time_min'];
  $nutrition = $_POST['nutrition_info'];
  $difficulty_id = $_POST['difficulty_id'];
  $category_id = $_POST['category_id'];
  $image_path = '';

  if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == UPLOAD_ERR_OK) {
    $img_name = basename($_FILES['image_file']['name']);
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $new_filename = 'recipe_' . time() . '.' . $ext;
    $target_dir = 'uploads/';
    $target_file = $target_dir . $new_filename;

    if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
      $image_path = $target_file;
    } else {
      $upload_error = 'Image upload failed.';
    }
  }

  if (empty($upload_error)) {
    $stmt = $conn->prepare("INSERT INTO recipes (id, title, description, steps, prep_time_min, cook_time_min, nutrition_info, image_url, difficulty_id, category_id, status)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("isssiissii", $user_id, $title, $description, $steps, $prep_time, $cook_time, $nutrition, $image_path, $difficulty_id, $category_id);

    if ($stmt->execute()) {
      header("Location: myrecipes.php");
      exit();
    } else {
      $add_error = "Something went wrong while adding the recipe.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Recipe - Dish Diary</title>
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="profile.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* ====== NAVBAR ====== */
    header.navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      width: 100%;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      z-index: 1000;
    }
    .container.nav-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 12px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 2rem;
    }
    .brand-title {
      font-family: 'Pacifico', cursive;
      font-size: 2rem;
      color: #ff6b35;
      text-decoration: none;
      white-space: nowrap;
    }
    .nav-menu { display: flex; gap: 2rem; }
    .nav-link { text-decoration: none; color: #2c3e50; font-weight: 500; padding: 0.5rem 1rem; border-radius: 25px; position: relative; }
    .nav-link:hover { color: #fff; background: linear-gradient(135deg, #ff6b35, #f7931e); }
    .sign-in-btn {
      background: linear-gradient(90deg, #ff6b35, #f7931e);
      color: #fff; border: none; border-radius: 8px; padding: 0.5em 1.2em; font-size: 1.05em; font-weight: 600;
      box-shadow: 0 2px 12px #ff6b6b22; text-decoration: none;
    }

    /* ====== LAYOUT FIX (sticky footer) ====== */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f8ffae 0%, #ef9206 100%);
      margin: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-top: 80px; /* offset for fixed navbar */
    }
    main {
      flex: 1; /* push footer down */
      padding: 2rem 1rem;
    }

    /* ====== FORM CARD ====== */
    .edit-recipe-container {
      max-width: 540px;
      margin: 2rem auto;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 2px 12px #ff6b6b11;
      padding: 2.5rem 2.2rem 2rem;
    }
    .edit-recipe-title { font-family: 'Pacifico', cursive; color: #ff6b35; font-size: 2rem; margin-bottom: 1.5rem; }
    .edit-recipe-form label { display: block; margin-bottom: 0.5em; font-weight: 500; color: #444; }
    .edit-recipe-form input, .edit-recipe-form textarea, .edit-recipe-form select {
      width: 100%; padding: 0.7em; border-radius: 7px; border: 1px solid #ddd; margin-bottom: 1.2em; font-size: 1em;
    }
    .edit-recipe-form textarea { min-height: 90px; resize: vertical; }
    .edit-recipe-form .submit-btn {
      background: linear-gradient(90deg, #ff6b35, #f7931e);
      color: #fff; border: none; border-radius: 8px; padding: 0.7em 2em; font-size: 1.1em; font-weight: 600;
      box-shadow: 0 2px 12px #ff6b6b22; cursor: pointer;
    }
    .edit-recipe-form .submit-btn:hover { background: linear-gradient(90deg, #f7931e, #ff6b35); }

    /* ====== FOOTER ====== */
    .footer {
      background: #1f2937;
      color: #e5e7eb;
      padding: 3rem 2rem 2rem;
    }
    .footer-wrapper { max-width: 1200px; margin: 0 auto; }
    .footer-main {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 2rem;
      margin-bottom: 2rem;
    }
    @media (max-width: 1100px) { .footer-main { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 700px) { .footer-main { grid-template-columns: 1fr; } }
    .foot-brand { font-family: 'Pacifico', cursive; font-size: 2rem; color: #ff6b35; margin-bottom: 1rem; display: inline-block; }
    .footer-desc { color: #cbd5e1; margin-bottom: 1.2rem; }
    .footer-socials a { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;
      border-radius: 50%; background: rgba(255,255,255,.08); color: #e5e7eb; margin-right: 0.5rem; font-size: 1.2rem; }
    .footer-socials a:hover { background: #ff6b35; color: #fff; }
    .footer-col h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: #fff; }
    .footer-col ul { list-style: none; padding: 0; margin: 0; }
    .footer-col li { margin-bottom: 0.7rem; color: #cbd5e1; font-size: 0.95rem; display: flex; gap: 0.4em; }
    .footer-col li a { color: #cbd5e1; text-decoration: none; }
    .footer-col li a:hover { color: #fff; }
    .footer-bottom { border-top: 1px solid rgba(255,255,255,.1); padding-top: 1.5rem; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1rem; font-size: 0.9rem; color: #9ca3af; }
    .footer-links a { color: #9ca3af; margin-left: 1.5rem; text-decoration: none; }
    .footer-links a:hover { color: #fff; }
  </style>
</head>
<body>
<header class="navbar">
  <div class="container nav-container">
    <a href="index.php" class="brand-title">Dish Diary</a>
    <nav class="nav-menu">
      <a href="index.php" class="nav-link">Home</a>
      <a href="recipes.php" class="nav-link">Recipes</a>
      <a href="categories.php" class="nav-link">Categories</a>
      <a href="cookingtips.php" class="nav-link">Cooking Tips</a>
      <a href="about.php" class="nav-link">About</a>
      <a href="contact.php" class="nav-link">Contact</a>
    </nav>
    <a href="profile.php" class="sign-in-btn">Profile</a>
  </div>
</header>

<main>
  <div class="edit-recipe-container">
    <div class="edit-recipe-title">Add Recipe</div>
    <form class="edit-recipe-form" method="post" enctype="multipart/form-data">
      <label>Title</label>
      <input type="text" name="title" required>

      <label>Description</label>
      <textarea name="description" required></textarea>

      <label>Steps</label>
      <textarea name="steps" required></textarea>

      <div style="display: flex; gap: 1em;">
        <div style="flex:1;">
          <label>Prep Time (min)</label>
          <input type="number" name="prep_time_min" min="0" required>
        </div>
        <div style="flex:1;">
          <label>Cook Time (min)</label>
          <input type="number" name="cook_time_min" min="0" required>
        </div>
      </div>

      <label>Nutrition Info</label>
      <textarea name="nutrition_info"></textarea>

      <label>Difficulty</label>
      <select name="difficulty_id" required>
        <option value="">-- Select Difficulty --</option>
        <?php foreach ($difficulties as $d): ?>
          <option value="<?= $d['difficulty_id'] ?>"><?= htmlspecialchars($d['level_name']) ?></option>
        <?php endforeach; ?>
      </select>

      <label>Category</label>
      <select name="category_id" required>
        <option value="">-- Select Category --</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= $c['category_id'] ?>"><?= htmlspecialchars($c['category_name']) ?></option>
        <?php endforeach; ?>
      </select>

      <label>Image</label>
      <input type="file" name="image_file" accept="image/*">

      <?php if (!empty($upload_error)): ?>
        <div style="color: red; margin-bottom: 1em;"> <?= htmlspecialchars($upload_error) ?> </div>
      <?php endif; ?>
      <?php if (!empty($add_error)): ?>
        <div style="color: red; margin-bottom: 1em;"> <?= htmlspecialchars($add_error) ?> </div>
      <?php endif; ?>

      <button type="submit" class="submit-btn">Add Recipe</button>
      <a href="myrecipes.php" style="margin-left:1em;">Cancel</a>
    </form>
  </div>
</main>

<footer class="footer">
  <div class="footer-wrapper">
    <div class="footer-main">
      <div class="footer-col">
        <span class="foot-brand">Dish Diary</span>
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
          <li><a href="cookingtips.php">Cooking Tips</a></li>
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
      <p>© 2025 Dish Diary. All rights reserved.</p>
      <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="terms.php">Terms of Service</a>
        <a href="#">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
