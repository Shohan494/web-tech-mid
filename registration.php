<?php

session_start(); // start session to store error messages

// check if form is submitted
if(isset($_POST['submit'])) {

  // get form inputs
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // basic form validation
  $errors = array();
  if(empty($username)) {
    $errors[] = "Username is required.";
  }
  if(empty($email)) {
    $errors[] = "Email is required.";
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email is invalid.";
  }
  if(empty($password)) {
    $errors[] = "Password is required.";
  }
  if(strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long.";
  }
  if($password !== $confirm_password) {
    $errors[] = "Password and confirm password must match.";
  }

  // if there are no errors
  if(empty($errors)) {
    // save user data to database (you would replace this with your own database code)


    

    $_SESSION['message'] = "Registration successful.";
    header("Location: success.php");
    exit;
  }

  // store errors in session
  $_SESSION['errors'] = $errors;

  // redirect back to form
  header("Location: registration.php");
  exit;
}

?>

<!-- display errors (if any) -->
<?php if(isset($_SESSION['errors'])): ?>
  <?php foreach($_SESSION['errors'] as $error): ?>
    <p><?php echo $error; ?></p>
  <?php endforeach; ?>
  <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<!-- registration form -->
<form method="POST" action="registration.php">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username"><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email"><br>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password"><br>

  <label for="confirm_password">Confirm Password:</label>
  <input type="password" id="confirm_password" name="confirm_password"><br>

  <input type="submit" name="submit" value="Register">
</form>
