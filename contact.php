<?php include 'navbar.php'; ?>
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
</head>
<body>
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
    <?php include 'footer.php'; ?>
</body>
</html>
