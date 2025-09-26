<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($fullname) || empty($email) || empty($username) || empty($password)) {
        $message = "All fields are required!";
    } else {
        // Save user data in session (temporary storage, no DB)
        $_SESSION['registered_user'] = [
            'fullname' => $fullname,
            'email' => $email,
            'username' => $username,
            'password' => $password
        ];

        header("Location: login.php?success=registered");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UM Intramurals - Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Top Nav -->
  <div class="navbar">
    <h4>Be Part of the Game — Register Now for UM Intramurals!</h4>
    <a href="login.php" class="back">Back</a>
  </div>

  <!-- Register Box -->
  <div class="login-container">
    <div class="login-box">
      <h2>Sign up</h2>

      <?php if (!empty($message)): ?>
          <?php if ($message === "Registration successful! Please log in."): ?>
              <p style="color:green;"><?php echo $message; ?></p>
          <?php else: ?>
              <p style="color:red;"><?php echo $message; ?></p>
          <?php endif; ?>
      <?php endif; ?>

      <form action="registration.php" method="POST">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Register</button>

        <p class="p-have">Already have an account? <a href="login.php">Sign in</a></p>
      </form>
    </div>
  </div>

</body>
</html>
