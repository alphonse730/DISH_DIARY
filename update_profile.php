<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "dish_diary");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['id'];

// Check if file was uploaded
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
    $fileName = $_FILES['profile_pic']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Allowed extensions
    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($fileExtension, $allowedExts)) {
        // Generate unique filename (same as addrecipe method)
        $newFileName = uniqid("profile_" . $user_id . "_") . "." . $fileExtension;
        $uploadDir = "uploads/";

        // Create uploads folder if not exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Save filename in DB
            $stmt = $conn->prepare("UPDATE users SET profile_img = ? WHERE id = ?");
            $stmt->bind_param("si", $newFileName, $user_id);
            $stmt->execute();
            $stmt->close();

            header("Location: profile.php?success=1");
            exit();
        } else {
            die("Error moving uploaded file.");
        }
    } else {
        die("Invalid file type. Allowed: jpg, jpeg, png, gif.");
    }
} else {
    die("No file uploaded or upload error.");
}
?>
