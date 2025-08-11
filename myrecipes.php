<!-- myrecipes.php -->

<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}
$user_id = $_SESSION['id'];
$conn = new mysqli('localhost', 'root', '', 'dish_diary');
if ($conn->connect_error) {
  die('Database connection failed: ' . $conn->connect_error);
}

$recipes = $conn->prepare('SELECT recipe_id, title, description, steps, prep_time_min, cook_time_min, nutrition_info, image_url, difficulty_id, category_id FROM recipes WHERE id = ? ORDER BY recipe_id DESC');
$recipes->bind_param('i', $user_id);
$recipes->execute();
$recipes_result = $recipes->get_result();
$recipes->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Recipes - Dish Diary</title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="profile.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <style>
    .myrecipes-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
    .myrecipes-title { font-family: var(--font-brand); color: var(--primary); font-size: 2.2rem; }
    .add-recipe-btn { background: linear-gradient(90deg, var(--primary), var(--secondary)); color: #fff; border: none; border-radius: 8px; padding: 0.6em 1.6em; font-size: 1.1em; font-weight: 600; box-shadow: 0 2px 12px #ff6b6b22; cursor: pointer; transition: background 0.2s, box-shadow 0.2s; display: flex; align-items: center; gap: 8px; }
    .add-recipe-btn:hover { background: linear-gradient(90deg, var(--secondary), var(--primary)); }
    .myrecipes-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 2rem; }
    .myrecipe-card { background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #ff6b6b11; overflow: hidden; display: flex; flex-direction: column; transition: box-shadow 0.2s, transform 0.2s; position: relative; }
    .myrecipe-card:hover { box-shadow: 0 8px 24px #ff6b6b22; transform: translateY(-4px) scale(1.02); }
    .myrecipe-img { width: 100%; height: 200px; object-fit: cover; background: #f3f4f6; }
    .myrecipe-content { padding: 1.2rem 1.5rem 1rem; flex: 1; display: flex; flex-direction: column; }
    .myrecipe-title { font-size: 1.2rem; font-weight: 600; color: var(--primary); margin-bottom: 0.5rem; }
    .myrecipe-desc { color: #555; font-size: 1rem; margin-bottom: 1.2rem; flex: 1; }
    .myrecipe-actions { display: flex; gap: 0.7em; justify-content: flex-end; }
    .edit-btn, .delete-btn { border: none; border-radius: 6px; padding: 0.4em 1.1em; font-size: 1em; font-weight: 500; cursor: pointer; transition: background 0.2s, color 0.2s; }
    .edit-btn { background: var(--secondary); color: #fff; }
    .edit-btn:hover { background: #3bb6a4; }
    .delete-btn { background: #ff6b6b; color: #fff; }
    .delete-btn:hover { background: #d94d4d; }
    /* Modal styles */
    .modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100vw; height: 100vh; overflow: auto; background: rgba(0,0,0,0.25); align-items: center; justify-content: center; }
    .modal.active { display: flex; }
    .modal-content { background: #fff; border-radius: 16px; padding: 2.5rem 2.2rem 2rem; box-shadow: 0 8px 40px #ff6b6b22; min-width: 340px; max-width: 95vw; position: relative; }
    .modal-close { position: absolute; top: 1.1rem; right: 1.1rem; background: none; border: none; font-size: 1.7rem; color: #ff6b6b; cursor: pointer; }
    .modal-title { font-family: var(--font-brand); color: var(--primary); font-size: 1.5rem; margin-bottom: 1.2rem; }
    .modal-form label { display: block; margin-bottom: 0.5em; font-weight: 500; color: #444; }
    .modal-form input, .modal-form textarea, .modal-form select { width: 100%; padding: 0.7em; border-radius: 7px; border: 1px solid #ddd; margin-bottom: 1.2em; font-size: 1em; }
    .modal-form textarea { min-height: 90px; resize: vertical; }
    .modal-form .submit-btn { background: linear-gradient(90deg, var(--primary), var(--secondary)); color: #fff; border: none; border-radius: 8px; padding: 0.7em 2em; font-size: 1.1em; font-weight: 600; box-shadow: 0 2px 12px #ff6b6b22; cursor: pointer; transition: background 0.2s, box-shadow 0.2s; }
    .modal-form .submit-btn:hover { background: linear-gradient(90deg, var(--secondary), var(--primary)); }
  </style>
</head>
<body>
<?php // HEADER (reuse from profile.php) ?>
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
      <a href="profile.php" class="sign-in-btn" style="display: flex; align-items: center;">
        <i class="ri-user-line" style="margin-right: 6px;"></i>
        <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Profile'; ?>
      </a>
      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>

<div class="container" style="margin-top: 3.5rem; margin-bottom: 2.5rem;">
  <div class="myrecipes-header">
    <div class="myrecipes-title">My Recipes</div>
    <button class="add-recipe-btn" onclick="openAddRecipeModal()"><i class="ri-add-line"></i>Add Recipe</button>
  </div>
  <div class="myrecipes-list">
    <?php while ($row = $recipes_result->fetch_assoc()): ?>
      <div class="myrecipe-card">
        <img src="<?= !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'https://readdy.ai/api/search-image?query=food&width=400&height=300' ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="myrecipe-img">
        <div class="myrecipe-content">
          <div class="myrecipe-title"><?= htmlspecialchars($row['title']) ?></div>
          <div class="myrecipe-desc"><?= htmlspecialchars(mb_strimwidth($row['description'], 0, 80, '...')) ?></div>
          <div class="myrecipe-actions">
            <a class="edit-btn" href="editrecipe.php?id=<?= urlencode($row['recipe_id']) ?>"><i class="ri-edit-2-line"></i> Edit</a>
            <form action="deleterecipe.php" method="post" style="display:inline;">
              <input type="hidden" name="recipe_id" value="<?= $row['recipe_id'] ?>">
              <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this recipe?');"><i class="ri-delete-bin-6-line"></i> Delete</button>
            </form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Add/Edit Recipe Modal -->
<div id="recipeModal" class="modal">
  <div class="modal-content">
    <button class="modal-close" onclick="closeRecipeModal()">&times;</button>
    <div class="modal-title" id="modalTitle">Add Recipe</div>
    <form class="modal-form" id="recipeForm" method="post" action="saverecipe.php" enctype="multipart/form-data">
      <input type="hidden" name="recipe_id" id="recipeIdInput">
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
      <select name="difficulty_id" id="difficultyInput" required></select>
      <label for="categoryInput">Category</label>
      <select name="category_id" id="categoryInput" required></select>
      <label for="imageFileInput">Image</label>
      <input type="file" name="image_file" id="imageFileInput" accept="image/*">
      <div id="imagePreview" style="margin-bottom:1em;"></div>
      <button type="submit" class="submit-btn">Save</button>
    </form>
  </div>
</div>

<script>
// Fetch dropdown data for modal
let difficulties = [], categories = [];
function fetchDropdowns(selectedDiff, selectedCat) {
  return fetch('fetch_recipe_form_data.php')
    .then(r => r.json())
    .then(data => {
      difficulties = data.difficulties;
      categories = data.categories;
      const diffSel = document.getElementById('difficultyInput');
      const catSel = document.getElementById('categoryInput');
      diffSel.innerHTML = '';
      catSel.innerHTML = '';
      difficulties.forEach(d => {
        diffSel.innerHTML += `<option value="${d.difficulty_id}"${selectedDiff==d.difficulty_id?' selected':''}>${d.difficulty_name}</option>`;
      });
      categories.forEach(c => {
        catSel.innerHTML += `<option value="${c.category_id}"${selectedCat==c.category_id?' selected':''}>${c.category_name}</option>`;
      });
    });
}
function openAddRecipeModal() {
  document.getElementById('modalTitle').textContent = 'Add Recipe';
  document.getElementById('recipeForm').reset();
  document.getElementById('recipeIdInput').value = '';
  document.getElementById('imagePreview').innerHTML = '';
  document.getElementById('recipeModal').style.display = 'none';
  fetchDropdowns().then(() => {
    document.getElementById('recipeModal').classList.add('active');
    document.getElementById('recipeModal').style.display = '';
  });
}
function openEditRecipeModal(recipe) {
  document.getElementById('modalTitle').textContent = 'Edit Recipe';
  document.getElementById('recipeForm').reset();
  document.getElementById('recipeIdInput').value = recipe.recipe_id;
  document.getElementById('titleInput').value = recipe.title;
  document.getElementById('descInput').value = recipe.description;
  document.getElementById('stepsInput').value = recipe.steps;
  document.getElementById('prepTimeInput').value = recipe.prep_time_min;
  document.getElementById('cookTimeInput').value = recipe.cook_time_min;
  document.getElementById('nutritionInput').value = recipe.nutrition_info || '';
  document.getElementById('imagePreview').innerHTML = recipe.image_url ? `<img src='${recipe.image_url}' style='max-width:100%;max-height:120px;border-radius:8px;'>` : '';
  document.getElementById('recipeModal').style.display = 'none';
  fetchDropdowns(recipe.difficulty_id, recipe.category_id).then(() => {
    document.getElementById('recipeModal').classList.add('active');
    document.getElementById('recipeModal').style.display = '';
  });
}
function closeRecipeModal() {
  document.getElementById('recipeModal').classList.remove('active');
}
// Image preview
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('imageFileInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(ev) {
        document.getElementById('imagePreview').innerHTML = `<img src='${ev.target.result}' style='max-width:100%;max-height:120px;border-radius:8px;'>`;
      };
      reader.readAsDataURL(file);
    } else {
      document.getElementById('imagePreview').innerHTML = '';
    }
  });
});
// Close modal on overlay click
window.onclick = function(event) {
  var modal = document.getElementById('recipeModal');
  if (event.target === modal) {
    closeRecipeModal();
  }
}
</script>

<?php // FOOTER (reuse from profile.php) ?>
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
