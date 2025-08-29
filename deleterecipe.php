
<!-- deleterecipe.php -->


<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}
if (!isset($_POST['recipe_id']) || !is_numeric($_POST['recipe_id'])) {
  die('Invalid recipe ID.');
}
$recipe_id = (int)$_POST['recipe_id'];
$user_id = $_SESSION['id'];
$conn = new mysqli('localhost', 'root', '', 'dish_diary');
if ($conn->connect_error) {
  die('Database connection failed: ' . $conn->connect_error);
}
// Only allow delete if recipe belongs to user
$stmt = $conn->prepare('DELETE FROM recipes WHERE recipe_id = ? AND id = ?');
$stmt->bind_param('ii', $recipe_id, $user_id);
$stmt->execute();
$stmt->close();
$conn->close();
echo "<script>console.log('Recipe deleted 🗑️'); alert('🗑️ Recipe deleted successfully! '); window.location.href='myrecipes.php?msg=deleted';</script>";
exit();
