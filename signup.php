
<!-- signup.php -->


<?php
$success = "";
$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // DB connection
    $conn = new mysqli('localhost', 'root', '', 'dish_diary');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

  // Sanitize inputs
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $plain_password = $_POST['password'];
  $role = 'user'; // Default role

  // Password validation
  $password_valid = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/', $plain_password);

  if (empty($name) || empty($email) || empty($plain_password)) {
    $error = "All fields are required.";
  } elseif (!$password_valid) {
    $error = "Password must be at least 8 characters and include at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special symbol.";
  } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            // Hash the password securely
            $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

            // Insert user with default role
            $insert = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $insert->bind_param("ssss", $name, $email, $hashed_password, $role);
       if ($insert->execute()) {
        // Redirect to login.php after signup
        header('Location: login.php?signup=success');
        exit();
      } else {
        $error = "Something went wrong. Try again.";
      }
      $insert->close();
        }

        $stmt->close();
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dish Diary - Signup</title>
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="signup.css" />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
</head>
<body>
  <div class="signup-bg"></div>
  <div class="signup-container">
    <form class="signup-card" method="POST" action="">
      <h1 class="brand-title">Dish Diary</h1>
      <p class="subtitle">Create your personal recipe account</p>

      <?php if ($success): ?>
        <p style="color: green; text-align:center; font-weight:600;"><?= $success ?></p>
      <?php elseif ($error): ?>
        <p style="color: red; text-align:center; font-weight:600;"><?= $error ?></p>
      <?php endif; ?>

      <div class="input-group">
        <label for="name">Full Name</label>
        <div class="input-icon">
          <i class="ri-user-line"></i>
          <input type="text" id="name" name="name" placeholder="Enter your full name" required>
        </div>
      </div>

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
          <input type="password" id="password" name="password" placeholder="Create a password" required>
          <i class="ri-eye-off-line toggle-password"></i>
        </div>
      </div>

      <div class="options-row">
        <label class="remember-me">
          <input type="checkbox" required>
          <span class="custom-checkbox"></span>
          I agree to the <a href="terms.php">Terms & Conditions</a>
        </label>
      </div>

      <button type="submit" class="signup-btn">Sign Up</button>
      <div class="register-link">
        Already have an account?
        <a href="login.php">Login Now</a>
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
