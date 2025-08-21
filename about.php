<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About - Dish Diary</title>
	<link rel="stylesheet" href="index.css" />
	<link rel="stylesheet" href="profile.css" />
	<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
</head>
<body style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
	<div class="profile-bg"></div>
	<main style="margin-top:100px;">
		<section class="about-section" style="max-width:900px;margin:0 auto;padding:3rem 2rem;background:#fff;border-radius:2rem;box-shadow:0 8px 32px rgba(80,80,180,0.10),0 1.5px 8px rgba(80,80,180,0.07);">
			<h1 class="brand-title" style="font-size:2.5rem;text-align:center;color:#ff6b35;margin-bottom:1.5rem;">About Dish Diary</h1>
			<p style="font-size:1.2rem;color:#374151;text-align:center;margin-bottom:2rem;">Dish Diary is your personal food recipe management system. Discover, create, and share amazing recipes with food enthusiasts around the world. Our platform makes it easy to organize your favorite dishes, explore new cuisines, and connect with a vibrant cooking community.</p>
			<div style="display:flex;flex-wrap:wrap;gap:2rem;justify-content:center;margin-top:2rem;">
				<div style="flex:1;min-width:220px;text-align:center;">
					<i class="ri-restaurant-2-line" style="font-size:3rem;color:#ff6b35;"></i>
					<h3 style="margin-top:1rem;color:#4a3c00;">Discover Recipes</h3>
					<p>Browse thousands of recipes from home cooks around the world. Filter by cuisine, dietary needs, or ingredients. Search for inspiration and try something new every day!</p>
				</div>
				<div style="flex:1;min-width:220px;text-align:center;">
					<i class="ri-book-open-line" style="font-size:3rem;color:#ff6b35;"></i>
					<h3 style="margin-top:1rem;color:#4a3c00;">Create Recipe Books</h3>
					<p>Save your favorite recipes and organize them into custom recipe books for easy access. Build collections for family dinners, festive occasions, or healthy eating.</p>
				</div>
				<div style="flex:1;min-width:220px;text-align:center;">
					<i class="ri-share-line" style="font-size:3rem;color:#ff6b35;"></i>
					<h3 style="margin-top:1rem;color:#4a3c00;">Share Your Creations</h3>
					<p>Upload your own recipes, share them with the community, and get feedback from other food lovers. Inspire others and be inspired!</p>
				</div>
			</div>
			<hr style="margin:2.5rem 0; border:none; border-top:1px solid #eee;">
			<div style="margin-bottom:2.5rem;">
				<h2 style="color:#ff6b35;text-align:center;margin-bottom:1rem;">Our Mission</h2>
				<p style="font-size:1.13rem;color:#444;text-align:center;">We believe food brings people together. Dish Diary is built to help everyone—from beginners to master chefs—explore, organize, and share their culinary journey. Our mission is to make cooking accessible, fun, and social for all.</p>
			</div>
			<div style="margin-bottom:2.5rem;">
				<h2 style="color:#ff6b35;text-align:center;margin-bottom:1rem;">Meet the Team</h2>
				<div style="display:flex;flex-wrap:wrap;gap:2rem;justify-content:center;">
					<div style="flex:1;min-width:180px;text-align:center;">
						<img src="uploads/alp.jpg" alt="Alphonse" style="width:80px;height:80px;border-radius:50%;object-fit:cover;margin-bottom:0.7rem;">
						<h4 style="margin-bottom:0.3rem;">Alphonse</h4>
						<p style="font-size:0.98rem;color:#555;">Founder & Lead Developer</p>
					</div>
					
					<div style="flex:1;min-width:180px;text-align:center;">
						<img src="uploads/agnel.jpg" alt="Agnel" style="width:80px;height:80px;border-radius:50%;object-fit:cover;margin-bottom:0.7rem;">
						<h4 style="margin-bottom:0.3rem;">Agnel</h4>
						<p style="font-size:0.98rem;color:#555;">UI/UX Designer</p>
					</div>
				</div>
			</div>
			<div style="margin-bottom:2.5rem;">
				<h2 style="color:#ff6b35;text-align:center;margin-bottom:1rem;">Why Choose Dish Diary?</h2>
				<ul style="font-size:1.08rem;color:#444;line-height:1.7;max-width:700px;margin:0 auto;list-style:disc inside;">
					<li>Easy-to-use interface for all ages</li>
					<li>Advanced search and filtering options</li>
					<li>Personalized recipe recommendations</li>
					<li>Secure and private recipe storage</li>
					<li>Active and friendly cooking community</li>
					<li>Mobile-friendly design for cooking on the go</li>
				</ul>
			</div>
			<div style="margin-bottom:2.5rem;">
				<h2 style="color:#ff6b35;text-align:center;margin-bottom:1rem;">Contact Us</h2>
				<p style="font-size:1.13rem;color:#444;text-align:center;">Have questions, feedback, or partnership ideas? Reach out to us at <a href="mailto:info@dishdiary.com" style="color:#4ECDC4;text-decoration:underline;">info@dishdiary.com</a> or use our <a href="contact.php" style="color:#4ECDC4;text-decoration:underline;">Contact Page</a>.</p>
			</div>
		</section>
	</main>
	<?php include 'footer.php'; ?>
</body>
</html>
