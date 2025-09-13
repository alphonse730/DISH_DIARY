<?php
session_start();
include 'db.php'; // adjust if needed

// Check if recipe_id is provided
if (!isset($_GET['recipe_id'])) {
    die("Recipe ID not provided.");
}
$recipe_id = intval($_GET['recipe_id']);

// Fetch recipe
$stmt = $conn->prepare("SELECT * FROM recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$recipe = $stmt->get_result()->fetch_assoc();

if (!$recipe) {
    die("Recipe not found.");
}

// Fetch categories & difficulty levels
$categories = $conn->query("SELECT category_id, category_name FROM categories")->fetch_all(MYSQLI_ASSOC);
$difficulties = $conn->query("SELECT difficulty_id, level_name, description FROM difficultylevels")->fetch_all(MYSQLI_ASSOC);

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $steps = $_POST['steps'];
    $prep_time = intval($_POST['prep_time_min']);
    $cook_time = intval($_POST['cook_time_min']);
    $nutrition = $_POST['nutrition_info'];
    $status = $_POST['status'];
    $category_id = intval($_POST['category_id']);
    $difficulty_id = intval($_POST['difficulty_id']);

    // Handle image upload if a new one is provided
    $image_url = $recipe['image_url']; // keep old image by default
    if (!empty($_FILES['image_file']['name'])) {
        $target_dir = "uploads/";
        $image_name = time() . "_" . basename($_FILES['image_file']['name']);
        $target_file = $target_dir . $image_name;
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
            $image_url = $image_name; // only store filename
        }
    }

    $stmt = $conn->prepare("UPDATE recipes 
        SET title=?, description=?, steps=?, prep_time_min=?, cook_time_min=?, 
            nutrition_info=?, status=?, category_id=?, difficulty_id=?, image_url=? 
        WHERE recipe_id=?");
    $stmt->bind_param(
        "sssiiisissi", 
        $title, $description, $steps, $prep_time, $cook_time, 
        $nutrition, $status, $category_id, $difficulty_id, $image_url, $recipe_id
    );

    if ($stmt->execute()) {
        header("Location: manage-recipes.php");
        exit();
    } else {
        echo "Error updating recipe.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Recipe - Dish Diary</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">Edit Recipe</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" value="<?= htmlspecialchars($recipe['title']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($recipe['description']) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Steps</label>
      <textarea name="steps" class="form-control" rows="5"><?= htmlspecialchars($recipe['steps']) ?></textarea>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Prep Time (min)</label>
        <input type="number" name="prep_time_min" value="<?= $recipe['prep_time_min'] ?>" class="form-control">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Cook Time (min)</label>
        <input type="number" name="cook_time_min" value="<?= $recipe['cook_time_min'] ?>" class="form-control">
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Nutrition Info</label>
      <textarea name="nutrition_info" class="form-control" rows="3"><?= htmlspecialchars($recipe['nutrition_info']) ?></textarea>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select">
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id']==$recipe['category_id']?'selected':'' ?>>
              <?= htmlspecialchars($cat['category_name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Difficulty</label>
        <select name="difficulty_id" class="form-select">
          <?php foreach ($difficulties as $diff): ?>
            <option value="<?= $diff['difficulty_id'] ?>" <?= $diff['difficulty_id']==$recipe['difficulty_id']?'selected':'' ?>>
              <?= htmlspecialchars($diff['level_name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="pending" <?= $recipe['status']=='pending'?'selected':'' ?>>Pending</option>
        <option value="approved" <?= $recipe['status']=='approved'?'selected':'' ?>>Approved</option>
        <option value="rejected" <?= $recipe['status']=='rejected'?'selected':'' ?>>Rejected</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label><br>
      <?php if (!empty($recipe['image_url'])): ?>
        <?php 
          $imgPath = (strpos($recipe['image_url'], 'uploads/') === 0) 
                      ? $recipe['image_url'] 
                      : 'uploads/' . $recipe['image_url'];
        ?>
        <img src="<?= htmlspecialchars($imgPath) ?>" 
             alt="Recipe Image" width="150" class="mb-2" 
             onerror="this.src='no-image.png'"><br>
      <?php endif; ?>
      <input type="file" name="image_file" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Update Recipe</button>
    <a href="manage-recipes.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
