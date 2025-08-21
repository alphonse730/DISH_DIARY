<?php
// login.php
session_start();
$success = "";
$error = "";

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  $conn = new mysqli("localhost", "root", "", "dish_diary");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
      if (password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        header("Location: index.php");
        exit();
      } else {
        $error = "Invalid password.";
      }
    } else {
            $error = "No account found with that email.";
        }

        $stmt->close();
    } else {
        $error = "Database query failed.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dish Diary - Login</title>
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="login.css">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
</head>
<body>
  <div class="login-bg"></div>
  <div class="login-container">
    <form class="login-card" method="POST" action="login.php">
      <h1 class="brand-title">Dish Diary</h1>
      <p class="subtitle">Your personal recipe collection</p>

      <?php if ($error): ?>
        <p style="color: red; text-align:center; font-weight:600;">
          <?= htmlspecialchars($error) ?>
        </p>
      <?php endif; ?>

      

      <div class="input-group">
        <label for="email">Email</label>
        <div class="input-icon">
          <i class="ri-mail-line"></i>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
      </div>

      <div class="input-group">
        <label for="password">Password</label>
        <div class="input-icon">
          <i class="ri-lock-line"></i>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
          <i class="ri-eye-off-line toggle-password" style="cursor:pointer;"></i>
        </div>
      </div>

      <div class="options-row">
        <label class="remember-me">
          <input type="checkbox">
          <span class="custom-checkbox"></span>
          Remember me
        </label>
        <a href="#" class="forgot-link">Forgot Password?</a>
      </div>

      <button type="submit" class="login-btn">Log In</button>

      <div class="register-link">
        Don't have an account?
        <a href="signup.php">Register Now</a>
      </div>
       <!-- Back to Home Button -->
      <div style="text-align: center; margin-bottom: 15px;">
        <a href="index.php" class="back-home-btn" style="display: inline-block; background:#f5f5f5; color:#333; padding:8px 22px; border-radius:24px; text-decoration:none; font-weight:600; box-shadow:0 0 6px #eee; transition:background 0.2s;">
          <i class="ri-arrow-left-line" style="vertical-align:middle; margin-right:6px;"></i>
          Home
        </a>
      </div>
    </form>
  </div>

  <script>
    document.getElementById('userBtn').onclick = function () {
      this.classList.add('active');
      document.getElementById('adminBtn').classList.remove('active');
    };

    document.getElementById('adminBtn').onclick = function () {
      this.classList.add('active');
      document.getElementById('userBtn').classList.remove('active');
    };

    document.querySelector('.toggle-password').onclick = function () {
      const pwd = document.getElementById('password');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        this.classList.replace('ri-eye-off-line', 'ri-eye-line');
      } else {
        pwd.type = 'password';
        this.classList.replace('ri-eye-line', 'ri-eye-off-line');
      }
    };
  </script>
</body>
</html>