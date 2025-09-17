<!-- get_user_favorites.php -->


<?php
include 'db.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['id'];

// ✅ Fetch user's favorited recipes
$sql = "
  SELECT r.*
  FROM recipes r
  INNER JOIN favorites f ON r.id = f.recipe_id
  WHERE f.user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$favorites = [];
while ($row = $result->fetch_assoc()) {
    $favorites[] = $row;
}

echo json_encode(['status' => 'success', 'favorites' => $favorites]);
