<?php
session_start();
$message = "";

if (isset($_GET['success']) && $_GET['success'] === 'registered') {
    $message = "Registration successful! Please log in.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "Both fields are required!";
    } elseif (!isset($_SESSION['registered_user'])) {
        $message = "No registered user found. Please sign up first.";
    } else {
        $registered = $_SESSION['registered_user'];

        if ($email === $registered['email'] && $password === $registered['password']) {
            // Save logged in session
            $_SESSION['logged_in'] = true;
            $_SESSION['fullname'] = $registered['fullname'];

            header("Location: landingPage.html");
            exit();
        } else {
            $message = "Invalid email or password!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UM Intramurals - Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="navbar">
    <h4>Join the Action, Mark the Dates — UM Intramurals Awaits!</h4>
  </div>

  <div class="login-container">
    <div class="login-box">
      <h2>Sign in</h2>

      <?php if (!empty($message)): ?>
    <?php if ($message === "Registration successful! Please log in."): ?>
        <p style="color:green;"><?php echo $message; ?></p>
    <?php else: ?>
        <p style="color:red;"><?php echo $message; ?></p>
    <?php endif; ?>
<?php endif; ?>

      <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Sign in</button>

        <p class="p-dontHave">Don't have an account? <a href="registration.php">Sign up</a></p>
      </form>
    </div>
  </div>

</body>
</html>
