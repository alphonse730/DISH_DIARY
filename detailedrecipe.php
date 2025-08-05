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
  <style>
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
</body>
</html>
