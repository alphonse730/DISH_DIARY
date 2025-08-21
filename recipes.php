<?php
$conn = new mysqli("localhost", "root", "", "dish_diary");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT r.*, c.category_name FROM recipes r LEFT JOIN categories c ON r.category_id = c.category_id ORDER BY r.title DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Diary - Recipes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #f8ffae 0%, #ef9206 100%); min-height: 100vh; padding: 2rem 1rem; }
        .page-title { text-align: center; font-size: 3.5rem; font-weight: 700; color: #4a3c00; text-shadow: 0 4px 20px rgba(239, 146, 6, 0.3); margin-bottom: 3rem; background: linear-gradient(45deg, #4a3c00, #6b5200); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .recipe-container { max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; padding: 1rem 0; }
        .recipe-card-link { text-decoration: none; color: inherit; display: block; }
        .recipe-card { background: rgba(255,255,255,0.94); backdrop-filter: blur(10px); border: 1px solid rgba(239, 146, 6, 0.22); border-radius: 20px; overflow: hidden; transition: all 0.35s cubic-bezier(0.23, 1, 0.320, 1); cursor: pointer; position: relative; height: 100%; display: flex; flex-direction: column; box-shadow: 0 8px 25px rgba(239, 146, 6, 0.15); }
        .recipe-card:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 40px rgba(239, 146, 6, 0.25); background: rgba(255,255,255,0.98); border-color: rgba(239, 146, 6, 0.4); }
        .recipe-card img { width: 100%; height: 200px; object-fit: cover; transition: transform 0.35s ease; }
        .recipe-card:hover img { transform: scale(1.08); }
        .recipe-card h2 { font-size: 1.25rem; font-weight: 600; color: #4a3c00; margin: 1.2rem 1.2rem 0.7rem; line-height: 1.3; }
        .recipe-card p { color: #6b5200; font-size: 1rem; line-height: 1.5; margin: 0 1.2rem 1rem; flex-grow: 1; }
        .recipe-card .category { background: linear-gradient(45deg, #ef9206, #d67b02); color: white; padding: 0.4rem 1rem; border-radius: 18px; font-size: 0.85rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(239, 146, 6, 0.18); margin: 0 1.2rem 1.2rem; display: inline-block; width: fit-content; }
        .floating-elements { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: -1; }
        .floating-circle { position: absolute; border-radius: 50%; background: rgba(239, 146, 6, 0.1); animation: float 6s ease-in-out infinite; }
        .floating-circle:nth-child(1) { width: 80px; height: 80px; top: 20%; left: 10%; animation-delay: 0s; }
        .floating-circle:nth-child(2) { width: 120px; height: 120px; top: 60%; right: 10%; animation-delay: 2s; }
        .floating-circle:nth-child(3) { width: 60px; height: 60px; bottom: 20%; left: 20%; animation-delay: 4s; }
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg); } 33% { transform: translateY(-20px) rotate(120deg); } 66% { transform: translateY(10px) rotate(240deg); } }
        @media (max-width: 768px) { .page-title { font-size: 2.5rem; } .recipe-container { grid-template-columns: 1fr; gap: 1.5rem; } }
        @media (max-width: 480px) { body { padding: 1rem 0.5rem; } .page-title { font-size: 2rem; } .recipe-card h2 { margin: 1rem 1rem 0.5rem; font-size: 1.2rem; } .recipe-card p { margin: 0 1rem 0.8rem; } .recipe-card .category { margin: 0 1rem 1rem; } }
    </style>
    
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>

    <h1 class="page-title">All Recipes</h1>
    <div class="recipe-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <a href="detailedrecipe.php?recipe_id=<?= urlencode($row['recipe_id']) ?>" class="recipe-card-link">
                <div class="recipe-card">
                    <img src="<?= !empty($row['image_url']) ? htmlspecialchars($row['image_url']) : 'https://readdy.ai/api/search-image?query=food&width=400&height=300' ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    <h2><?= htmlspecialchars($row['title']) ?></h2>
                    <p><?= htmlspecialchars(mb_strimwidth($row['description'], 0, 80, '...')) ?></p>
                    <span class="category"><?= htmlspecialchars($row['category_name']) ?></span>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</body>
</html>