<!-- shoppinglist.php -->
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "dish_diary");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipe_id = $_GET['recipe_id'] ?? 0;

// ✅ Validate recipe ID
if (!is_numeric($recipe_id) || $recipe_id <= 0) {
    die("Invalid recipe ID.");
}

// Fetch recipe title
$stmt = $conn->prepare("SELECT title FROM recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$titleRes = $stmt->get_result()->fetch_assoc();

if (!$titleRes) {
    die("Recipe not found.");
}

// Fetch ingredients
$stmt2 = $conn->prepare("SELECT ingredient_name, quantity FROM recipe_ingredients WHERE recipe_id = ?");
$stmt2->bind_param("i", $recipe_id);
$stmt2->execute();
$ingredients = $stmt2->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping List - <?= htmlspecialchars($titleRes['title']) ?></title>
  <link rel="stylesheet" href="shoppinglist.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    h1 { margin-bottom: 20px; }
    .shopping-list li { margin-bottom: 10px; }
    .pdf-btn { margin-top: 20px; padding: 10px 20px; font-size: 16px; cursor: pointer; }
  </style>
</head>
<body>
  <h1>Shopping List for <?= htmlspecialchars($titleRes['title']) ?></h1>

  <?php if ($ingredients->num_rows > 0): ?>
    <ul id="shoppingList" class="shopping-list">
      <?php while ($ing = $ingredients->fetch_assoc()): ?>
        <li>
          <input type="checkbox" class="ingredient-checkbox" 
                 value="<?= htmlspecialchars($ing['ingredient_name'] . ' - ' . $ing['quantity']) ?>" 
                 id="<?= htmlspecialchars($ing['ingredient_name']) ?>">
          <label for="<?= htmlspecialchars($ing['ingredient_name']) ?>">
            <?= htmlspecialchars($ing['ingredient_name']) ?> - <?= htmlspecialchars($ing['quantity']) ?>
          </label>
        </li>
      <?php endwhile; ?>
    </ul>

    <button id="downloadPdfBtn" class="pdf-btn">📄 Download PDF</button>
  <?php else: ?>
    <p>No ingredients found for this recipe.</p>
  <?php endif; ?>

  <br><br>
  <a href="recipes.php">⬅ Back to Recipes</a>

  <script>
    const { jsPDF } = window.jspdf;

    document.getElementById('downloadPdfBtn')?.addEventListener('click', function(e) {
      e.preventDefault();

      const pdf = new jsPDF();
      const recipeTitle = "<?= htmlspecialchars($titleRes['title']) ?>";

      pdf.setFontSize(16);
      pdf.text(Shopping List for: ${recipeTitle}, 10, 20);

      pdf.setFontSize(12);
      let yPos = 30;

      const checkedItems = document.querySelectorAll('.ingredient-checkbox:checked');
      if (checkedItems.length === 0) {
        alert('Please select at least one ingredient!');
        return;
      }

      checkedItems.forEach(item => {
        pdf.text('• ' + item.value, 12, yPos);
        yPos += 10;
      });

      pdf.save(ShoppingList_${recipeTitle}.pdf);
    });
  </script>
</body>
</html>