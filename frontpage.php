<!-- frontpage.php -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Diary - Your Culinary Journey</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 25%, #ff9a56 50%, #ffb347 75%, #ffa500 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Animated gradient background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, 
                rgba(255, 107, 53, 0.8) 0%, 
                rgba(247, 147, 30, 0.6) 25%, 
                rgba(255, 154, 86, 0.4) 50%, 
                rgba(255, 179, 71, 0.6) 75%, 
                rgba(255, 165, 0, 0.8) 100%);
            animation: gradientShift 8s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 0.4; }
        }

        /* Floating food emojis */
        .floating-food {
            position: absolute;
            font-size: 2.5rem;
            animation: floatFood 12s linear infinite;
            opacity: 0.3;
            z-index: 1;
        }

        .floating-food:nth-child(1) { top: 10%; left: 5%; animation-delay: 0s; }
        .floating-food:nth-child(2) { top: 20%; right: 10%; animation-delay: 2s; }
        .floating-food:nth-child(3) { bottom: 30%; left: 8%; animation-delay: 4s; }
        .floating-food:nth-child(4) { bottom: 15%; right: 5%; animation-delay: 6s; }
        .floating-food:nth-child(5) { top: 50%; left: 3%; animation-delay: 8s; }
        .floating-food:nth-child(6) { top: 70%; right: 3%; animation-delay: 10s; }

        @keyframes floatFood {
            0% { transform: translateY(0px) rotate(0deg) scale(1); }
            25% { transform: translateY(-20px) rotate(90deg) scale(1.2); }
            50% { transform: translateY(0px) rotate(180deg) scale(1); }
            75% { transform: translateY(-15px) rotate(270deg) scale(0.8); }
            100% { transform: translateY(0px) rotate(360deg) scale(1); }
        }

        /* Animated background circles with morphing */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15), rgba(255, 200, 100, 0.1));
            animation: morphFloat 10s ease-in-out infinite;
            backdrop-filter: blur(2px);
        }

        .bg-circle:nth-child(7) {
            width: 300px;
            height: 300px;
            top: -10%;
            left: -10%;
            animation-delay: 0s;
        }

        .bg-circle:nth-child(8) {
            width: 200px;
            height: 200px;
            top: 60%;
            right: -5%;
            animation-delay: 3s;
        }

        .bg-circle:nth-child(9) {
            width: 150px;
            height: 150px;
            bottom: -5%;
            left: 30%;
            animation-delay: 6s;
        }

        @keyframes morphFloat {
            0%, 100% { 
                transform: translateY(0px) scale(1) rotate(0deg);
                border-radius: 50%;
            }
            33% { 
                transform: translateY(-40px) scale(1.3) rotate(120deg);
                border-radius: 60% 40% 30% 70%;
            }
            66% { 
                transform: translateY(-20px) scale(0.8) rotate(240deg);
                border-radius: 30% 60% 70% 40%;
            }
        }

        /* Particle system */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: radial-gradient(circle, #ffff99, #ff9a56);
            border-radius: 50%;
            animation: particleFloat 6s linear infinite;
            z-index: 2;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0px) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
                transform: scale(1);
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-20px) translateX(100px) scale(0);
                opacity: 0;
            }
        }

        .container {
            text-align: center;
            z-index: 10;
            position: relative;
            animation: containerBounce 3s ease-in-out infinite;
        }

        @keyframes containerBounce {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .logo {
            font-size: 6rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 1rem;
            text-shadow: 
                0 0 10px rgba(255, 165, 0, 0.8),
                0 0 20px rgba(255, 200, 0, 0.6),
                0 0 30px rgba(255, 235, 0, 0.4),
                0 10px 40px rgba(0, 0, 0, 0.3);
            animation: 
                logoGlow 3s ease-in-out infinite alternate,
                slideInDown 1.5s cubic-bezier(0.68, -0.55, 0.265, 1.55),
                textWave 4s ease-in-out infinite;
            background: linear-gradient(45deg, #fff, #ffef94, #fff, #ffef94);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes logoGlow {
            from { 
                text-shadow: 
                    0 0 10px rgba(255, 165, 0, 0.8),
                    0 0 20px rgba(255, 200, 0, 0.6),
                    0 0 30px rgba(255, 235, 0, 0.4);
                transform: scale(1);
            }
            to { 
                text-shadow: 
                    0 0 15px rgba(255, 200, 0, 1),
                    0 0 25px rgba(255, 235, 0, 0.8),
                    0 0 35px rgba(255, 255, 0, 0.6);
                transform: scale(1.08);
            }
        }

        @keyframes textWave {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-200px) rotate(-10deg) scale(0.5);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotate(0deg) scale(1);
            }
        }

        .tagline {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 3rem;
            animation: 
                fadeInUp 1.5s ease-out 0.8s both,
                rainbow 3s linear infinite,
                bounce 2s ease-in-out infinite;
            text-shadow: 
                0 2px 10px rgba(0,0,0,0.3),
                0 0 20px rgba(255, 255, 255, 0.5);
            background: linear-gradient(45deg, #fff, #ffef94, #ffd700, #ffef94, #fff);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .cta-button {
            display: inline-block;
            padding: 25px 60px;
            background: linear-gradient(45deg, #ff4757, #ff6348, #ff8c69, #ff6348, #ff4757);
            background-size: 300% 300%;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.6rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            box-shadow: 
                0 15px 35px rgba(255, 71, 87, 0.4),
                0 5px 15px rgba(255, 140, 105, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            animation: 
                fadeInUp 1.5s ease-out 1.5s both,
                buttonPulse 3s infinite,
                buttonGradient 4s ease-in-out infinite;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes buttonGradient {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.6s;
        }

        .cta-button::after {
            content: '✨';
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            font-size: 1.2rem;
            animation: sparkleRotate 2s linear infinite;
        }

        @keyframes sparkleRotate {
            0% { transform: translateY(-50%) rotate(0deg); }
            100% { transform: translateY(-50%) rotate(360deg); }
        }

        .cta-button:hover::before {
            left: 100%;
        }

        .cta-button:hover {
            transform: translateY(-8px) scale(1.08) rotateX(5deg);
            box-shadow: 
                0 25px 50px rgba(255, 71, 87, 0.7),
                0 10px 25px rgba(255, 140, 105, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            background: linear-gradient(45deg, #ff6348, #ff4757, #ff6348, #ff8c69, #ff6348);
            border: 2px solid rgba(255, 255, 255, 0.6);
        }

        @keyframes buttonPulse {
            0%, 100% { 
                box-shadow: 
                    0 15px 35px rgba(255, 71, 87, 0.4),
                    0 5px 15px rgba(255, 140, 105, 0.3);
            }
            50% { 
                box-shadow: 
                    0 20px 45px rgba(255, 71, 87, 0.8),
                    0 8px 20px rgba(255, 140, 105, 0.6);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(80px) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Page transition with advanced effects */
        .page-transition {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #ff6b35, #f7931e, #ff9a56);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .page-transition.active {
            opacity: 1;
            visibility: visible;
        }

        .transition-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            animation: transitionPulse 1.5s ease-in-out infinite;
            text-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }

        @keyframes transitionPulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.05); }
        }

        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite, spinnerGlow 2s ease-in-out infinite;
            margin: 30px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes spinnerGlow {
            0%, 100% { box-shadow: 0 0 10px rgba(255,255,255,0.3); }
            50% { box-shadow: 0 0 25px rgba(255,255,255,0.8); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo { font-size: 3.5rem; }
            .tagline { font-size: 1.5rem; }
            .cta-button { 
                font-size: 1.2rem; 
                padding: 20px 40px;
                letter-spacing: 2px;
            }
        }

        /* Screen shake effect */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <!-- Floating food emojis -->
    <div class="floating-food">🍕</div>
    <div class="floating-food">🍔</div>
    <div class="floating-food">🍝</div>
    <div class="floating-food">🥘</div>
    <div class="floating-food">🍲</div>
    <div class="floating-food">🥗</div>

    <!-- Animated background circles -->
    <div class="bg-circle"></div>
    <div class="bg-circle"></div>
    <div class="bg-circle"></div>

    <!-- Main content -->
    <div class="container">
        <h1 class="logo">🍽️ Dish Diary</h1>
        <p class="tagline">Your Personal Recipe Universe</p>
        <a href="user-admin.php" class="cta-button" id="startJourney">Start Your Journey</a>
    </div>

    <!-- Page transition overlay -->
    <div class="page-transition" id="pageTransition">
        <div class="transition-text">
            <div>Loading Your Kitchen...</div>
            <div class="loading-spinner"></div>
        </div>
    </div>

    <script>
        // Create floating particles
        function createParticles() {
            for (let i = 0; i < 15; i++) {
                setTimeout(() => {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 6 + 's';
                    particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
                    document.body.appendChild(particle);
                    
                    setTimeout(() => {
                        if (document.body.contains(particle)) {
                            document.body.removeChild(particle);
                        }
                    }, 8000);
                }, i * 200);
            }
        }

        // Start particle system
        createParticles();
        setInterval(createParticles, 8000);

        // Enhanced sparkle effect
        document.addEventListener('mousemove', (e) => {
            if (Math.random() > 0.85) {
                createSparkle(e.clientX, e.clientY);
            }
        });

        function createSparkle(x, y) {
            const sparkle = document.createElement('div');
            const size = Math.random() * 8 + 4;
            const colors = ['#ffff99', '#ff9a56', '#ffd700', '#ffef94', '#fff'];
            
            sparkle.style.position = 'fixed';
            sparkle.style.left = x + 'px';
            sparkle.style.top = y + 'px';
            sparkle.style.width = size + 'px';
            sparkle.style.height = size + 'px';
            sparkle.style.background = `radial-gradient(circle, ${colors[Math.floor(Math.random() * colors.length)]}, transparent)`;
            sparkle.style.borderRadius = '50%';
            sparkle.style.pointerEvents = 'none';
            sparkle.style.zIndex = '100';
            sparkle.style.animation = `sparkleAnim ${Math.random() * 1 + 1}s ease-out forwards`;
            
            document.body.appendChild(sparkle);
            
            setTimeout(() => {
                if (document.body.contains(sparkle)) {
                    document.body.removeChild(sparkle);
                }
            }, 2000);
        }

        // Button click with effects
        document.getElementById('startJourney').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Add shake effect to whole page
            document.body.classList.add('shake');
            
            // Create explosion of sparkles
            for (let i = 0; i < 20; i++) {
                setTimeout(() => {
                    const rect = this.getBoundingClientRect();
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;
                    
                    const sparkleX = centerX + (Math.random() - 0.5) * 200;
                    const sparkleY = centerY + (Math.random() - 0.5) * 200;
                    
                    createSparkle(sparkleX, sparkleY);
                }, i * 50);
            }
            
            // Activate page transition after effects
            setTimeout(() => {
                document.body.classList.remove('shake');
                const transition = document.getElementById('pageTransition');
                transition.classList.add('active');
                
                // Navigate after animation
                setTimeout(() => {
                    window.location.href = 'user-admin.php';
                }, 1200);
            }, 500);
        });

        // Add sparkle animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes sparkleAnim {
                0% { 
                    opacity: 1; 
                    transform: scale(0) rotate(0deg); 
                }
                50% {
                    opacity: 0.8;
                    transform: scale(1.5) rotate(180deg);
                }
                100% { 
                    opacity: 0; 
                    transform: scale(0) rotate(360deg); 
                }
            }
        `;
        document.head.appendChild(style);

        // Random color changes for elements
        setInterval(() => {
            const elements = document.querySelectorAll('.floating-food');
            elements.forEach(el => {
                if (Math.random() > 0.7) {
                    el.style.filter = `hue-rotate(${Math.random() * 60}deg) brightness(1.2)`;
                    setTimeout(() => {
                        el.style.filter = '';
                    }, 1000);
                }
            });
        }, 3000);
    </script>
</body>
</html>