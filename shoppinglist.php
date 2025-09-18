<!-- shopping list.php -->
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "dish_diary");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipe_id = $_GET['recipe_id'] ?? 0;

// Fetch recipe title
$stmt = $conn->prepare("SELECT title FROM recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$titleRes = $stmt->get_result()->fetch_assoc();

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

  <ul id="shoppingList" class="shopping-list">
    <?php while ($ing = $ingredients->fetch_assoc()): ?>
      <li>
        <input type="checkbox" class="ingredient-checkbox" value="<?= htmlspecialchars($ing['ingredient_name'] . ' - ' . $ing['quantity']) ?>" id="<?= htmlspecialchars($ing['ingredient_name']) ?>">
        <label for="<?= htmlspecialchars($ing['ingredient_name']) ?>">
          <?= htmlspecialchars($ing['ingredient_name']) ?> - <?= htmlspecialchars($ing['quantity']) ?>
        </label>
      </li>
    <?php endwhile; ?>
  </ul>

  <button id="downloadPdfBtn" class="pdf-btn">📄 Download PDF</button>

  <br><br>
  <div class="back-btn-center">
    <a href="recipes.php" class="back-btn">⬅ Back to Recipes</a>
  </div>
  <style>
    .back-btn-center {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
    }
    .back-btn {
      display: inline-block;
      padding: 8px 20px;
      background: linear-gradient(90deg, #f7931e 0%, #ff6b35 100%);
      color: #fff;
      border: none;
      border-radius: 24px;
      font-size: 1em;
      font-weight: 500;
      text-decoration: none;
      box-shadow: 0 2px 8px #ff6b6b22;
      transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
      cursor: pointer;
      letter-spacing: 0.01em;
      margin-bottom: 10px;
    }
    .back-btn:hover {
      background: linear-gradient(90deg, #ff6b35 0%, #f7931e 100%);
      box-shadow: 0 4px 16px #ff6b6b33;
      transform: translateY(-2px) scale(1.03);
      color: #fff;
      text-decoration: none;
    }
  </style>

  <script>
    const { jsPDF } = window.jspdf;

    document.getElementById('downloadPdfBtn').addEventListener('click', function(e) {
      e.preventDefault();

      const pdf = new jsPDF();
      const recipeTitle = "<?= htmlspecialchars($titleRes['title']) ?>";

      pdf.setFontSize(16);
      pdf.text(`Shopping List for: ${recipeTitle}`, 10, 20);

      pdf.setFontSize(12);
      let yPos = 30;

      // Get all checked ingredients
      const checkedItems = document.querySelectorAll('.ingredient-checkbox:checked');
      if (checkedItems.length === 0) {
        alert('Please select at least one ingredient!');
        return;
      }

      // Draw checkboxes visually in PDF
      checkedItems.forEach(item => {
        pdf.text('\u2022', 12, yPos); // bullet point
        pdf.text(item.value, 17, yPos); // ingredient text
        yPos += 10;
      });

      pdf.save(`ShoppingList_${recipeTitle}.pdf`);
    });
  </script>
</body>
</html>
