
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Dish Diary</title>
    <link rel="stylesheet" href="index.css" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
         /* Navbar Start */
/* ====== NAVBAR  CSS START ====== */
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
      background: linear-gradient(135deg, #ffe1aeff 0%, #ef9206 100%);
      min-height: 100vh;
      padding-top: 115px;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    /* ====== NAVBAR  CSS END ====== */


     /* FOOTER  CSS START*/
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
  <a href="contact.php" class="nav-link login-required">Contact</a>
    </nav>
    <div class="nav-icons">
  <!-- Search icon removed as requested -->
      
         <a href="profile.php" class="sign-in-btn">Profile</a>
      <div class="icon-btn mobile-menu-btn" id="mobileMenuBtn"><i class="ri-menu-line ri-lg"></i></div>
    </div>
  </div>
</header>
    <div class="contact-bg" style="background: url('https://readdy.ai/api/search-image?query=A%20vibrant%20kitchen%20scene%20with%20fresh%20ingredients%20spread%20across%20a%20wooden%20countertop.%20Colorful%20vegetables%2C%20herbs%2C%20and%20spices%20arranged%20beautifully.%20A%20chef%5Cs%20hand%20is%20visible%20adding%20finishing%20touches%20to%20a%20gourmet%20dish.%20The%20lighting%20is%20warm%20and%20inviting%2C%20creating%20an%20appetizing%20atmosphere.&width=1200&height=600&seq=1&orientation=landscape') center center/cover no-repeat; filter: blur(2.5px) brightness(0.93) opacity(0.42); position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 0; width: 100vw; height: 100vh;"></div>
    <main style="margin-top:100px; position:relative; z-index:1;">
        <section class="contact-section" style="max-width:900px;margin:0 auto;padding:3rem 2rem;background:rgba(255,255,255,0.92);backdrop-filter:blur(12px);border-radius:2.7rem;box-shadow:0 12px 48px 0 rgba(80,80,180,0.13),0 2px 16px rgba(80,80,180,0.09);border:1.5px solid rgba(239,146,6,0.13);">
            <h1 class="brand-title" style="font-size:2.5rem;text-align:center;color:#ff6b35;margin-bottom:1.5rem;">Contact Us</h1>
            <p style="font-size:1.2rem;color:#374151;text-align:center;margin-bottom:2rem;">We'd love to hear from you! Whether you have questions, feedback, partnership ideas, or just want to say hello, reach out to us using the form below or via email.</p>
            <form style="max-width:600px;margin:2rem auto 0 auto;display:flex;flex-direction:column;gap:1.2rem;">
                <input type="text" name="name" placeholder="Your Name" required style="padding:0.9rem 1.2rem;border-radius:1.2rem;border:1px solid #eee;font-size:1.08rem;">
                <input type="email" name="email" placeholder="Your Email" required style="padding:0.9rem 1.2rem;border-radius:1.2rem;border:1px solid #eee;font-size:1.08rem;">
                <textarea name="message" placeholder="Your Message" rows="5" required style="padding:0.9rem 1.2rem;border-radius:1.2rem;border:1px solid #eee;font-size:1.08rem;resize:vertical;"></textarea>
                <button type="submit" style="background:linear-gradient(90deg,#ff6b35 60%,#f7931e 100%);color:#fff;padding:0.9rem 2.2rem;border:none;border-radius:1.2rem;font-size:1.13rem;font-weight:600;box-shadow:0 2px 12px rgba(255,107,107,0.10);cursor:pointer;transition:background 0.2s;">Send Message</button>
            </form>
            <div style="margin-top:2.5rem;text-align:center;">
                <p style="font-size:1.13rem;color:#444;">Or email us at <a href="mailto:info@dishdiary.com" style="color:#4ECDC4;text-decoration:underline;">info@dishdiary.com</a></p>
                <p style="font-size:1.13rem;color:#444;">Or call us at <a href="tel:+1234567890" style="color:#4ECDC4;text-decoration:underline;">+1 (234) 567-890</a></p>
            </div>
        </section>
    </main>
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

</body>
</html>
