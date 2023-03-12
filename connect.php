<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fuel Distribution Management</title>
  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "webtech";
  $port = 3306;

  $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  ?>

</body>
</html>