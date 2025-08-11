<!-- fetch_recipe_form_data.php -->

<?php
// Fetch difficulties and categories for the recipe modal dropdowns
$conn = new mysqli('localhost', 'root', '', 'dish_diary');
if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(['error' => 'Database connection failed']);
  exit();
}
$difficulties = [];
$categories = [];
$res = $conn->query('SELECT difficulty_id, difficulty_name FROM difficulty');
while ($row = $res->fetch_assoc()) {
  $difficulties[] = $row;
}
$res->close();
$res = $conn->query('SELECT category_id, category_name FROM categories');
while ($row = $res->fetch_assoc()) {
  $categories[] = $row;
}
$res->close();
$conn->close();
header('Content-Type: application/json');
echo json_encode([
  'difficulties' => $difficulties,
  'categories' => $categories
]);
