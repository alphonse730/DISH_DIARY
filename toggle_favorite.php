<?php
session_start();
header('Content-Type: application/json');
include 'db.php';

// Check login
if (!isset($_SESSION['id'])) {
    echo json_encode([
        "success" => false,
        "message" => "Not logged in"
    ]);
    exit();
}

$user_id = $_SESSION['id'];
$recipe_id = $_POST['recipe_id'] ?? null;

// Validate recipe_id
if (!$recipe_id) {
    echo json_encode([
        "success" => false,
        "message" => "Recipe ID missing"
    ]);
    exit();
}

// Check if favorite already exists
// Use favorite_id instead of id for the favorites table primary key
$stmt = $conn->prepare("SELECT favorite_id FROM favorites WHERE user_id = ? AND recipe_id = ?");
$stmt->bind_param("ii", $user_id, $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Remove from favorites
    $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND recipe_id = ?");
    $stmt->bind_param("ii", $user_id, $recipe_id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "action" => "removed"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to remove favorite"]);
    }
} else {
    // Add to favorites
    $stmt = $conn->prepare("INSERT INTO favorites (user_id, recipe_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $recipe_id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "action" => "added"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add favorite"]);
    }
}
?>
