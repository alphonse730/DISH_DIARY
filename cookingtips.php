<!-- cookingtips.php -->



<!DOCTYPE html>
<html lang="en">
<head>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cooking Tips - Dish Diary</title>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary-color: #ff6b35;
      --secondary-color: #f7931e;
      --accent-color: #27ae60;
      --dark-color: #2c3e50;
      --light-color: #ecf0f1;
      --white: #ffffff;
      --gradient-1: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
      --gradient-2: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --gradient-3: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      --shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    body {
      font-family: 'Poppins', sans-serif;
      line-height: 1.6;
      color: var(--dark-color);
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
    }

          /* Navbar Start */
/* ====== NAVBAR CSS START ====== */
    header.navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      height: 115px;
      width: 100%;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      z-index: 1000;
      display: flex;
      align-items: center;
    }

    .container.nav-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 100%;
      gap: 2rem;
    }

    .brand-title {
      font-family: 'Pacifico', cursive;
      font-size: 2rem;
      color: #ff6b35;
      text-decoration: none;
      white-space: nowrap;
      transition: transform 0.3s ease;
    }

    .brand-title:hover {
      transform: scale(1.05);
    }

    .nav-menu {
      display: flex;
      gap: 2rem;
    }

    .nav-link {
      text-decoration: none;
      color: #2c3e50;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 25px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
      transition: left 0.3s ease;
      z-index: -1;
    }

    .nav-link:hover::before,
    .nav-link.active::before {
      left: 0;
    }

    .nav-link:hover,
    .nav-link.active {
      color: #fff;
      transform: translateY(-2px);
    }

    .nav-icons {
      display: flex;
      align-items: center;
      gap: 1.2rem;
    }

    .icon-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1.3rem;
      color: #ff6b35;
      transition: color 0.2s;
    }

    .icon-btn:hover {
      color: #f7931e;
    }

    .sign-in-btn {
      background: linear-gradient(90deg, #ff6b35, #f7931e);
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 0.5em 1.2em;
      font-size: 1.05em;
      font-weight: 600;
      box-shadow: 0 2px 12px #ff6b6b22;
      cursor: pointer;
      margin-left: 0.5em;
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: background 0.2s, box-shadow 0.2s;
    }

    .sign-in-btn:hover {
      background: linear-gradient(90deg, #f7931e, #ff6b35);
    }

    .mobile-menu-btn {
      display: none;
    }

    /* Responsive */
    @media (max-width: 900px) {
      .container.nav-container {
        flex-direction: column;
        height: auto;
        padding: 0 10px;
      }
      .nav-menu {
        display: none;
      }
      .mobile-menu-btn {
        display: flex !important;
      }
    }

    @media (max-width: 600px) {
      .brand-title {
        font-size: 1.3rem;
      }
      .nav-menu {
        flex-wrap: wrap;
        gap: 0.5rem;
      }
    }

    /* Active mobile menu */
    .nav-menu.active {
      position: absolute;
      top: 90px;
      right: 1rem;
      background: #fff;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      box-shadow: 0 6px 24px rgba(0,0,0,0.12);
      border-radius: 12px;
      padding: 1.5rem 2rem;
      z-index: 100;
    }

    /* Body padding to offset fixed navbar */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f8ffae 0%, #ef9206 100%);
      min-height: 100vh;
      padding-top: 115px;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    /* ====== NAVBAR CSS END ====== */

    .page-title {
      text-align: center;
      font-size: 3rem;
      font-weight: 700;
      color: #4a3c00;
      margin-bottom: 2.5rem;
    }

    .category-list {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
      max-width: 1200px;
      margin: 0 auto;
    }

    .category-card {
      background: #fffbe9;
      border-radius: 18px;
      box-shadow: 0 2px 12px rgba(239,146,6,0.10);
      padding: 2rem 2.5rem;
      text-align: center;
      font-size: 1.3rem;
      font-weight: 600;
      color: #ef9206;
      cursor: pointer;
      transition: box-shadow 0.2s, transform 0.2s;
      min-width: 220px;
    }

    .category-card:hover {
      box-shadow: 0 8px 24px rgba(239,146,6,0.18);
      transform: translateY(-4px) scale(1.04);
      background: #ffe0b2;
    }
/* navbar css end */


/* FOOTER CSS START */
.footer{
  width:100vw;
  margin-left:calc(-50vw + 50%);   /* full-bleed */
  background:#1f2937;              /* solid slate/navy */
  color:#e5e7eb;
  padding:64px 24px 28px;
  position:relative;
  z-index:2;                        /* sits above blurred bg */
}

.footer-wrapper{
  max-width:1200px;
  margin:0 auto;
}

.footer-main{
  display:flex;
  flex-wrap:wrap;
  gap:48px;
  justify-content:space-between;
}

.footer-col{
  flex:1 1 220px;
  min-width:220px;
}

.footer-col h3{
  color:#ffffff;
  font-size:1.05rem;
  font-weight:700;
  margin:0 0 14px;
}

.foot-brand{
  font-family:'Pacifico', cursive;
  font-size:2rem;
  color:#ff6b35;
  display:inline-block;
  margin-bottom:12px;
}

.footer-desc{
  color:#cbd5e1;
  font-size:.95rem;
  line-height:1.6;
  margin:8px 0 18px;
}

.footer-col ul{
  list-style:none;
  padding:0;
  margin:0;
}
.footer-col ul li{
  margin:10px 0;
  color:#cbd5e1;
}
.footer-col ul li a{
  color:#cbd5e1;
  text-decoration:none;
  transition:color .2s ease;
}
.footer-col ul li a:hover{
  color:#ffffff;
}

/* social icons like the other page */
.footer-socials a{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  width:36px; height:36px;
  margin-right:10px;
  border-radius:50%;
  background:rgba(255,255,255,.08);
  color:#e5e7eb;
  transition:transform .2s ease, background .2s ease, color .2s ease;
}
.footer-socials a:hover{
  transform:translateY(-2px);
  background:rgba(255,255,255,.14);
  color:#ffffff;
}

/* divider & bottom row */
.footer hr{
  border:none;
  border-top:1px solid rgba(255,255,255,.08);
  margin:34px 0 18px;
}
.footer-bottom{
  display:flex;
  gap:16px;
  align-items:center;
  justify-content:space-between;
  flex-wrap:wrap;
  color:#9ca3af;
  font-size:.92rem;
}
.footer-bottom .footer-links a{
  color:#9ca3af;
  text-decoration:none;
  margin-left:26px;
}
.footer-bottom .footer-links a:hover{
  color:#ffffff;
}

/* responsive stack */
@media (max-width: 780px){
  .footer-main{gap:28px;}
  .footer-col{flex:1 1 100%; min-width:unset;}
  .footer-bottom{flex-direction:column; align-items:flex-start;}
}

/* FOOTER CSS END */

    /* Hero Section */
    .tips-hero {
      background: var(--gradient-1);
      color: var(--white);
      text-align: center;
      padding: 150px 0 100px;
      position: relative;
      overflow: hidden;
      margin-top: 80px;
    }

    .tips-hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50" cy="50" r="50"><stop offset="0" stop-color="white" stop-opacity="0.1"/><stop offset="1" stop-color="white" stop-opacity="0"/></radialGradient></defs><circle cx="10" cy="10" r="3" fill="url(%23a)"/><circle cx="90" cy="10" r="3" fill="url(%23a)"/><circle cx="50" cy="5" r="2" fill="url(%23a)"/><circle cx="30" cy="15" r="2" fill="url(%23a)"/><circle cx="70" cy="15" r="2" fill="url(%23a)"/></svg>');
      opacity: 0.3;
      animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    .tips-hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      animation: slideUp 1s ease-out;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .tips-hero p {
      font-size: 1.3rem;
      font-weight: 300;
      max-width: 600px;
      margin: 0 auto;
      animation: slideUp 1s ease-out 0.3s both;
      opacity: 0.95;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Tips Container */
    .tips-container {
      max-width: 1200px;
      margin: -50px auto 0;
      padding: 0 20px 100px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 30px;
      position: relative;
      z-index: 2;
    }

    /* Tip Cards */
    .tip-card {
      background: var(--white);
      padding: 2.5rem;
      border-radius: 20px;
      box-shadow: var(--shadow);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
      cursor: pointer;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .tip-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--gradient-1);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.4s ease;
    }

    .tip-card:hover::before {
      transform: scaleX(1);
    }

    .tip-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-hover);
    }

    .tip-card:nth-child(odd) {
      animation: slideInLeft 0.8s ease-out;
    }

    .tip-card:nth-child(even) {
      animation: slideInRight 0.8s ease-out;
    }

    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .tip-card i {
      font-size: 3rem;
      color: var(--primary-color);
      margin-bottom: 1.5rem;
      display: block;
      transition: all 0.3s ease;
    }

    .tip-card:hover i {
      transform: scale(1.1) rotate(5deg);
      color: var(--secondary-color);
    }

    .tip-card h2 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--dark-color);
      transition: color 0.3s ease;
    }

    .tip-card:hover h2 {
      color: var(--primary-color);
    }

    .tip-card p {
      color: #666;
      font-size: 1rem;
      line-height: 1.7;
      transition: color 0.3s ease;
    }

    .tip-card:hover p {
      color: var(--dark-color);
    }

    /* Special card variants */
    .tip-card:nth-child(3n+1) {
      background: linear-gradient(135deg, #fff 0%, #f8f9ff 100%);
    }

    .tip-card:nth-child(3n+2) {
      background: linear-gradient(135deg, #fff 0%, #fff8f0 100%);
    }

    .tip-card:nth-child(3n+3) {
      background: linear-gradient(135deg, #fff 0%, #f0fff4 100%);
    }

    /* Footer */
    .footer {
      background: var(--dark-color);
      color: var(--light-color);
      padding: 60px 0 20px;
      margin-top: 100px;
    }

    .footer-main {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 40px;
      margin-bottom: 40px;
    }

    .foot-brand {
      font-family: 'Pacifico', cursive;
      font-size: 1.8rem;
      color: var(--primary-color);
      text-decoration: none;
    }

    .footer-desc {
      margin: 15px 0;
      color: #bdc3c7;
      line-height: 1.6;
    }

    .footer-socials {
      display: flex;
      gap: 15px;
      margin-top: 20px;
    }

    .footer-socials a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: var(--gradient-1);
      border-radius: 50%;
      color: var(--white);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .footer-socials a:hover {
      transform: translateY(-3px) scale(1.1);
      box-shadow: 0 10px 20px rgba(255, 107, 53, 0.3);
    }

    .footer-col h3 {
      color: var(--white);
      margin-bottom: 20px;
      font-weight: 600;
    }

    .footer-col ul {
      list-style: none;
    }

    .footer-col ul li {
      margin-bottom: 10px;
    }

    .footer-col ul li a,
    .footer-col ul li {
      color: #bdc3c7;
      text-decoration: none;
      transition: color 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .footer-col ul li a:hover {
      color: var(--primary-color);
      transform: translateX(5px);
    }

    .footer-bottom {
      border-top: 1px solid #34495e;
      padding-top: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .footer-links {
      display: flex;
      gap: 20px;
    }

    .footer-links a {
      color: #bdc3c7;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer-links a:hover {
      color: var(--primary-color);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .nav-menu {
        display: none;
      }

      .tips-hero h1 {
        font-size: 2.5rem;
      }

      .tips-hero p {
        font-size: 1.1rem;
      }

      .tips-container {
        grid-template-columns: 1fr;
        margin-top: -30px;
        gap: 20px;
      }

      .tip-card {
        padding: 2rem;
      }

      .footer-bottom {
        flex-direction: column;
        text-align: center;
      }
    }

    /* Loading animation for cards */
    .tip-card {
      animation-delay: calc(var(--i) * 0.1s);
    }

    /* Pulse animation for icons */
    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .tip-card:hover i {
      animation: pulse 2s infinite;
    }

    /* Gradient text effect */
    .gradient-text {
      background: var(--gradient-1);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
  </style>
</head>
<body>

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
  <!-- Search icon removed as requested -->
      
     <a href="profile.php" class="sign-in-btn">Profile</a>
      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>


<div class="tips-hero">
  <h1>Cooking Tips & <span class="gradient-text">Inspiration</span></h1>
  <p>Unlock your inner chef! Discover essential tips and tricks to make your cooking easier, tastier, and more fun.</p>
</div>

<div class="tips-container">
  <div class="tip-card" style="--i: 1;">
    <i class="ri-lightbulb-flash-line"></i>
    <h2>Read the Recipe First</h2>
    <p>Before you start, read the entire recipe carefully. This helps you understand the steps, timing, and prepare all ingredients in advance for a smooth cooking experience.</p>
  </div>
  
  <div class="tip-card" style="--i: 2;">
    <i class="ri-restaurant-2-line"></i>
    <h2>Prep Ingredients (Mise en Place)</h2>
    <p>Chop, measure, and organize all your ingredients before cooking. This French technique makes the cooking process smooth, stress-free, and professional.</p>
  </div>
  
  <div class="tip-card" style="--i: 3;">
    <i class="ri-fire-line"></i>
    <h2>Preheat Your Pan & Oven</h2>
    <p>Always preheat your pan or oven to the right temperature. This ensures even cooking, better searing, and optimal flavor development in your dishes.</p>
  </div>
  
  <div class="tip-card" style="--i: 4;">
    <i class="ri-leaf-line"></i>
    <h2>Use Fresh Herbs Wisely</h2>
    <p>Fresh herbs add vibrant flavor and color to your dishes. Add hardy herbs early in cooking, but save delicate ones for the end to preserve their aroma.</p>
  </div>
  
  <div class="tip-card" style="--i: 5;">
    <i class="ri-drop-line"></i>
    <h2>Season as You Go</h2>
    <p>Taste and season your food throughout the cooking process, not just at the end. Build layers of flavor for perfectly balanced and delicious results.</p>
  </div>
  
  <div class="tip-card" style="--i: 6;">
    <i class="ri-emotion-happy-line"></i>
    <h2>Have Fun & Experiment</h2>
    <p>Cooking is a creative adventure! Try new ingredients, techniques, and flavor combinations. Don't be afraid to make mistakes - they're the best teachers.</p>
  </div>
  
  <div class="tip-card" style="--i: 7;">
    <i class="ri-time-line"></i>
    <h2>Let Meat Rest</h2>
    <p>After cooking, let meat rest for 5-10 minutes before slicing. This allows juices to redistribute, ensuring tender, flavorful, and perfectly moist results.</p>
  </div>
  
  <div class="tip-card" style="--i: 8;">
    <i class="ri-knife-line"></i>
    <h2>Keep Your Knives Sharp</h2>
    <p>A sharp knife is safer, more efficient, and makes prep work enjoyable. Hone regularly, use proper cutting boards, and choose the right knife for each task.</p>
  </div>
  
  <div class="tip-card" style="--i: 9;">
    <i class="ri-sparkling-2-line"></i>
    <h2>Clean As You Go</h2>
    <p>Maintain a tidy workspace by cleaning utensils, wiping counters, and organizing as you cook. This keeps your kitchen enjoyable and stress-free.</p>
  </div>
</div>

	 <!-- ✅ FULL-WIDTH FOOTER FIXED -->
<footer class="footer">
  <!-- Remove the limiting .container -->
  <div class="footer-wrapper">
    <div class="footer-main">
      <div class="footer-col">
        <a href="#" class="brand-title foot-brand login-required">Dish Diary</a>
        <p class="footer-desc">Discover, create, and share amazing recipes with food enthusiasts around the world.</p>
        <div class="footer-socials">
          <a href="https://www.facebook.com/"><i class="ri-facebook-fill"></i></a>
          <a href="https://www.instagram.com/accounts/login/?hl=en"><i class="ri-instagram-line"></i></a>
          <a href="https://x.com/"><i class="ri-twitter-x-line"></i></a>
          <a href="https://in.pinterest.com/"><i class="ri-pinterest-line"></i></a>
        </div>
      </div>

      <div class="footer-col">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes.php" class="login-required">Recipes</a></li>
          <li><a href="categories.php" class="login-required">Categories</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3>Resources</h3>
        <ul>
          <li><a href="#" class="login-required">Help Center</a></li>
          <li><a href="#" class="login-required">Blog</a></li>
          <li><a href="cookingtips.php" class="login-required">Cooking Tips</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3>Contact Us</h3>
        <ul>
          <li><i class="ri-map-pin-line"></i>123 Recipe Street, Foodville, CA 90210</li>
          <li><i class="ri-mail-line"></i><a href="mailto:info@dishdiary.com">info@dishdiary.com</a></li>
          <li><i class="ri-phone-line"></i><a href="tel:+1234567890">+1 (234) 567-890</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2025 Dish Diary. All rights reserved.</p>
      <div class="footer-links">
        <a href="#" class="login-required">Privacy Policy</a>
        <a href="terms.php" class="login-required">Terms of Service</a>
        <a href="#" class="login-required">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>
<!-- FOOTER END -->


<script>
  // Smooth scroll for navigation links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Add scroll effect to navbar
  window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
      navbar.style.background = 'rgba(255, 255, 255, 0.98)';
      navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
    } else {
      navbar.style.background = 'rgba(255, 255, 255, 0.95)';
      navbar.style.boxShadow = 'none';
    }
  });

  // Animate cards on scroll
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);

  // Observe all tip cards
  document.querySelectorAll('.tip-card').forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
    observer.observe(card);
  });

  // Add hover sound effect (optional - requires audio files)
  document.querySelectorAll('.tip-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
      // Optional: Add subtle audio feedback
      // const audio = new Audio('hover-sound.mp3');
      // audio.volume = 0.1;
      // audio.play().catch(e => {});
    });
  });
</script>
</body>
</html>