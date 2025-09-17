<!-- reject-recipe.php -->


<?php
include 'db.php';
if (!isset($_GET['id'])) {
    header('Location: admin-dashboard.php');
    exit();
}
$recipe_id = intval($_GET['id']);
$sql = "UPDATE recipes SET status='rejected' WHERE recipe_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $recipe_id);
$stmt->execute();
$stmt->close();
header('Location: admin-dashboard.php');
exit();
