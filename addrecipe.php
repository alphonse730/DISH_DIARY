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

<!-- HTML STARTS -->
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
    <style>

    /* Navbar Start */
/* ====== NAVBAR  CSS START ====== */
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

    /* ====== NAVBAR CSS END ====== */


     /* FOOTER  CSS START*/
    .footer-wrapper {
  width: 100%;
  padding-left: 2rem;
  padding-right: 2rem;
  margin: 0 auto;
}


.footer {
  background: var(--gray-800);
  color: var(--white);
  padding-top: 4rem;
  padding-bottom: 2rem;
  position: relative;
  margin: 0;
  padding-left: 0;
  padding-right: 0;
}

.footer-main {
  
  max-width: 1400px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  margin: 0 auto 3rem auto;
}
@media (max-width: 1100px) {
  .footer-main { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 700px) {
  .footer-main { grid-template-columns: 1fr; }
}
.foot-brand {
  color: #df6209ff;;
  margin-bottom: 1.5rem;
}
.footer-desc {
  color: var(--gray-400);
  margin-bottom: 1.5rem;
}
.footer-socials a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px; height: 40px;
  border-radius: 50%;
  background: var(--gray-700);
  color: var(--white);
  margin-right: 0.5rem;
  font-size: 1.25em;
  text-decoration: none;
  transition: background 0.2s, color 0.2s;
}
.footer-socials a:hover { background: var(--primary); }
.footer-col h3 {
  font-size: 1.15rem;
  font-weight: 600;
  margin-bottom: 1.2rem;
}
.footer-col ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.footer-col li {
  color: var(--gray-400);
  margin-bottom: 0.7rem;
  font-size: 1em;
  display: flex;
  align-items: flex-start;
  gap: 0.4em;
}
.footer-col li a {
  color: var(--gray-400);
  text-decoration: none;
  transition: color 0.2s;
}
.footer-col li a:hover { color: var(--white); }
.footer-bottom {
  border-top: 1px solid var(--gray-700);
  padding-top: 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}
.footer-bottom {
  max-width: 1400px;
  margin: 0 auto;
  padding-top: 2rem;
  border-top: 1px solid var(--gray-700);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}
.footer-bottom p {
  color: var(--gray-400);
  font-size: 0.98em;
  margin: 0;
}
.footer-links {
  display: flex;
  gap: 2rem;
}
.footer-links a {
  color: var(--gray-400);
  text-decoration: none;
  font-size: 0.98em;
  transition: color 0.2s;
}
.footer-links a:hover { color: var(--white); }
/* FOOTER CSS END */
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
  </style>
</head>
<body>

<!-- ✅ Navbar -->
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

<!-- ✅ Add Recipe Form -->
<div class="edit-recipe-container">
  <div class="edit-recipe-title">Add Recipe</div>
  <form class="edit-recipe-form" method="post" enctype="multipart/form-data">
    <label for="titleInput">Title</label>
    <input type="text" name="title" id="titleInput" required>

    <label for="descInput">Description</label>
    <textarea name="description" id="descInput" required></textarea>

    <label for="stepsInput">Steps</label>
    <textarea name="steps" id="stepsInput" required></textarea>

    <div style="display: flex; gap: 1em;">
      <div style="flex:1;">
        <label for="prepTimeInput">Prep Time (min)</label>
        <input type="number" name="prep_time_min" id="prepTimeInput" min="0" required>
      </div>
      <div style="flex:1;">
        <label for="cookTimeInput">Cook Time (min)</label>
        <input type="number" name="cook_time_min" id="cookTimeInput" min="0" required>
      </div>
    </div>

    <label for="nutritionInput">Nutrition Info</label>
    <textarea name="nutrition_info" id="nutritionInput" placeholder="e.g. Calories: 200, Protein: 10g, ..."></textarea>

    <label for="difficultyInput">Difficulty</label>
    <select name="difficulty_id" id="difficultyInput" required>
      <option value="">-- Select Difficulty --</option>
      <?php foreach ($difficulties as $d): ?>
        <option value="<?= $d['difficulty_id'] ?>"><?= htmlspecialchars($d['level_name']) ?></option>
      <?php endforeach; ?>
    </select>

    <label for="categoryInput">Category</label>
    <select name="category_id" id="categoryInput" required>
      <option value="">-- Select Category --</option>
      <?php foreach ($categories as $c): ?>
        <option value="<?= $c['category_id'] ?>"><?= htmlspecialchars($c['category_name']) ?></option>
      <?php endforeach; ?>
    </select>

    <label for="imageFileInput">Image</label>
    <input type="file" name="image_file" id="imageFileInput" accept="image/*">

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

<!-- ✅ Footer -->
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
  </div>
</footer>


</body>
</html>
