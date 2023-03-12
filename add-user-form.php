<?php

session_start();

include 'connect.php';

if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  if(empty($name) || empty($email) || empty($password) || empty($role)) {
    $error = "Please fill in all fields.";
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email address.";
  } else {
    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    if(mysqli_query($conn, $sql)) {
      header("Location: users-management.php");
      exit;
    } else {
      $error = "Error adding user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
  }
}

?>

<h1>Add User</h1>

<?php if(isset($error)): ?>
  <p><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">
  <label>
    Name:
    <input type="text" name="name" required>
  </label>
  <label>
    Email:
    <input type="email" name="email" required>
  </label>
  <label>
    Password:
    <input type="password" name="password" required>
  </label>
  <label>
    Role:
    <select name="role" required>
      <option value="">Select Role<option>
      <option value="admin">Admin</option>
      <option value="salesman">Salesman</option>
      <option value="customer">Customer</option>
    </select>
  </label>
  <button type="submit">Add User</button>
</form>

<?php

include 'footer.php';

?>