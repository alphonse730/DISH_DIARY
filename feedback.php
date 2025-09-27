<!-- feedback.php -->


<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['id'];
$message = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message']);
    $rating = intval($_POST['rating']);

    if (!empty($message) && $rating >= 1 && $rating <= 5) {
        $stmt = $conn->prepare("INSERT INTO feedback (user_id, message, rating) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $user_id, $message, $rating);
        if ($stmt->execute()) {
            $success = "Thank you for your feedback!";
            $message = '';
        } else {
            $success = "Error: Could not save feedback.";
        }
    } else {
        $success = "Please provide feedback and a rating.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback - Dish Diary</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="recipes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .feedback-container {
            max-width: 600px;
            margin: 140px auto 60px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        .feedback-container h2 {
            font-family: 'Pacifico', cursive;
            font-size: 28px;
            margin-bottom: 20px;
            color: #ff6b6b;
        }
        .feedback-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .star-rating {
            display: flex;
            justify-content: center;
            direction: rtl;
            font-size: 28px;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            cursor: pointer;
            color: #ddd;
            transition: color 0.3s;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ff6b6b;
        }
        .feedback-form textarea {
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            resize: none;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
        }
        .feedback-form textarea:focus {
            border-color: #ff6b6b;
        }
        .feedback-btn {
            background: linear-gradient(90deg, #ff6b6b, #ff8e53);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }
        .feedback-btn:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #ff8e53, #ff6b6b);
        }
        .feedback-message {
            margin-bottom: 15px;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
<!-- NAVBAR START -->
<header class="navbar">
    <div class="container nav-container">
        <div class="brand">
            <a href="index.php" class="brand-title">Dish Diary</a>
        </div>
        <nav class="nav-menu" id="mainNav">
            <a href="index.php" class="nav-link">Home</a>
            <a href="recipes.php" class="nav-link login-required">Recipes</a>
            <a href="categories.php" class="nav-link login-required">Categories</a>
            <a href="cookingtips.php" class="nav-link login-required">Cooking Tips</a>
            <a href="about.php" class="nav-link login-required">About</a>
            <a href="feedback.php" class="nav-link login-required">feedback</a>
        </nav>
        <div class="nav-icons">
            <a href="profile.php" class="sign-in-btn">Profile</a>

        </div>
    </div>
</header>
<!-- NAVBAR END -->

<div class="feedback-container">
    <h2>Share Your Feedback</h2>
    <?php if ($success) echo "<p class='feedback-message'>$success</p>"; ?>
    <form method="post" class="feedback-form">
        <div class="star-rating">
            <input type="radio" id="star5" name="rating" value="5" required><label for="star5">★</label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
        </div>
        <textarea name="message" rows="5" placeholder="Write your feedback..." required><?php echo htmlspecialchars($message); ?></textarea>
        <button type="submit" class="feedback-btn">Submit</button>
    </form>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-wrapper">
        <div class="footer-main">
            <div class="footer-col">
                <span class="foot-brand">Dish Diary</span>
                <p class="footer-desc">Discover, create, and share amazing recipes with food enthusiasts around the world.</p>
                <div class="footer-socials">
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    <a href="#"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-twitter-x-line"></i></a>
                    <a href="#"><i class="ri-pinterest-line"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="recipes.php">Recipes</a></li>
                    <li><a href="categories.php">Categories</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Cooking Tips</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="ri-map-pin-line"></i> 123 Recipe Street, Foodville, CA 90210</li>
                    <li><i class="ri-mail-line"></i> info@dishdiary.com</li>
                    <li><i class="ri-phone-line"></i> +1 (234) 567-890</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
