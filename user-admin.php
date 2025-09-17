<!-- user-admin.php -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Path - Dish Diary</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 25%, #ff9a56 50%, #ff5722 75%, #e64a19 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Advanced animated background */
        .bg-decoration {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s infinite ease-in-out;
        }

        .floating-shape:nth-child(1) {
            width: 120px;
            height: 120px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
        }

        .floating-shape:nth-child(2) {
            width: 80px;
            height: 80px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }

        .floating-shape:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            border-radius: 0;
        }

        .floating-shape:nth-child(4) {
            width: 60px;
            height: 60px;
            top: 25%;
            right: 25%;
            animation-delay: 6s;
            background: rgba(255, 255, 255, 0.08);
        }

        .floating-shape:nth-child(5) {
            width: 140px;
            height: 140px;
            top: 70%;
            left: 60%;
            animation-delay: 1s;
            border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg) scale(1);
                opacity: 0.7;
            }
            33% { 
                transform: translateY(-30px) rotate(120deg) scale(1.1);
                opacity: 1;
            }
            66% { 
                transform: translateY(30px) rotate(240deg) scale(0.9);
                opacity: 0.5;
            }
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px) saturate(180%);
            border-radius: 40px;
            padding: 50px 45px;
            box-shadow: 
                0 32px 64px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            max-width: 580px;
            width: 90%;
            position: relative;
            z-index: 10;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .logo-container {
            margin-bottom: 15px;
            position: relative;
        }

        .logo {
            font-size: 3.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ff6b35, #f7931e, #ff5722);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            text-shadow: 0 4px 8px rgba(255, 107, 53, 0.3);
            animation: logoGlow 2s ease-in-out infinite alternate;
        }

        @keyframes logoGlow {
            from { filter: brightness(1) drop-shadow(0 0 5px rgba(255, 107, 53, 0.3)); }
            to { filter: brightness(1.1) drop-shadow(0 0 15px rgba(255, 107, 53, 0.5)); }
        }

        .subtitle {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 40px;
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .selection-title {
            font-size: 2rem;
            color: #1f2937;
            margin-bottom: 35px;
            font-weight: 700;
            position: relative;
        }

        .selection-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #ff6b35, #f7931e);
            border-radius: 2px;
        }

        .options-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-top: 40px;
        }

        .option-card {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 2px solid transparent;
            border-radius: 24px;
            padding: 35px 25px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: #374151;
            position: relative;
            overflow: hidden;
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }

        .option-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .option-card::after {
            content: '';
            position: absolute;
            inset: 0;
            padding: 2px;
            background: linear-gradient(135deg, #ff6b35, #f7931e, #ff9a56);
            border-radius: 24px;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: xor;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .user-card:hover {
            transform: translateY(-12px) rotate(-2deg) scale(1.05);
            box-shadow: 
                0 25px 50px -12px rgba(34, 197, 94, 0.35),
                0 0 0 1px rgba(34, 197, 94, 0.1);
            background: linear-gradient(145deg, #f0fdf4, #dcfce7);
        }

        .admin-card:hover {
            transform: translateY(-12px) rotate(2deg) scale(1.05);
            box-shadow: 
                0 25px 50px -12px rgba(239, 68, 68, 0.35),
                0 0 0 1px rgba(239, 68, 68, 0.1);
            background: linear-gradient(145deg, #fef2f2, #fee2e2);
        }

        .option-card:hover::before,
        .option-card:hover::after {
            opacity: 1;
        }

        .option-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            display: block;
            position: relative;
            z-index: 2;
            transition: all 0.4s ease;
        }

        .user-card .option-icon {
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .admin-card .option-icon {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .option-card:hover .option-icon {
            transform: scale(1.2) rotate(5deg);
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.15));
        }

        .option-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 12px;
            position: relative;
            z-index: 2;
        }

        .option-description {
            font-size: 0.95rem;
            color: #6b7280;
            line-height: 1.5;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .back-link {
            position: absolute;
            top: 35px;
            left: 35px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            z-index: 20;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .back-link:hover {
            color: white;
            transform: translateX(-5px);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Sparkle animation */
        .sparkle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            animation: sparkle 3s infinite;
            opacity: 0;
        }

        .sparkle:nth-child(1) {
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            top: 80%;
            right: 20%;
            animation-delay: 1s;
        }

        .sparkle:nth-child(3) {
            bottom: 30%;
            left: 70%;
            animation-delay: 2s;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0) rotate(0deg); }
            50% { opacity: 1; transform: scale(1) rotate(180deg); }
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: 40px 30px;
                margin: 20px;
                border-radius: 30px;
            }

            .logo {
                font-size: 2.8rem;
            }

            .selection-title {
                font-size: 1.6rem;
            }

            .options-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .option-card {
                min-height: 160px;
                padding: 30px 20px;
            }

            .option-icon {
                font-size: 3.5rem;
                margin-bottom: 15px;
            }

            .back-link {
                top: 20px;
                left: 20px;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .options-container {
                gap: 15px;
            }

            .option-card {
                min-height: 140px;
                padding: 25px 15px;
            }

            .option-title {
                font-size: 1.2rem;
            }

            .option-description {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <a href="frontpage.php" class="back-link">
        <span>←</span> Back
    </a>
    
    <!-- Advanced animated background -->
    <div class="bg-decoration">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        
        <!-- Sparkle effects -->
        <div class="sparkle"></div>
        <div class="sparkle"></div>
        <div class="sparkle"></div>
    </div>

    <div class="container">
        <div class="logo-container">
            <div class="logo">🍽️ Dish Diary</div>
            <div class="subtitle">Your Personal Recipe Universe</div>
        </div>
        
        <h2 class="selection-title">Choose Your Experience</h2>
        
        <div class="options-container">
            <a href="index.php" class="option-card user-card">
                <span class="option-icon">👨‍🍳</span>
                <div class="option-title">User</div>
                <div class="option-description">Explore recipes, save favorites, and start cooking amazing dishes</div>
            </a>
            
            <a href="login.php" class="option-card admin-card">
                <span class="option-icon">⚙️</span>
                <div class="option-title">Admin</div>
                <div class="option-description">Manage recipes, users, and system settings with full control</div>
            </a>
        </div>
    </div>
</body>
</html>