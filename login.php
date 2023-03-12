<?php

session_start();

include 'connect.php';

include 'header.php';

?>


<center><h2>Fuel Ditribution Login</h2></center>

<body>
	<div align="center">

		<form method="post" action="login.php">
			<table>
				<tr>
					<td>
						<fieldset>
							<legend><b>Login:</b></legend>
							<table>
								<tr>
									<th>
										<label for="username">Username</label>
									</th>
									<td>:</td>
									<td>
										<input type="text" name="username" id="username">
									</td>
								</tr>
								<tr>
									<th>
										<label for="password">Password</label>
									</th>
									<td>:</td>
									<td>
										<input type="password" name="password" id="password" placeholder="password">
									</td>
									
									<input type="hidden" name="secret" value="password">
								</tr>
								<tr>
									<th></th>
									<td></td>
									<td align="right">

										<input type="submit" value="Login">
										<button type="submit"> Submit Via Button</button>

									</td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
			</table>
		</form>

		<p>Don't have an account? Register <a href="registration.php">here</a>.</p>

		<?php

		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$flag = true;

			$username = sanitize($_POST['username']);
			$password = sanitize($_POST['password']);

			if (empty($username)) {
				echo "Please fill up the username properly";
				echo "<br>";
				$flag = false;
			}
			if (empty($password)) {
				echo "Please fill up the password properly";
				$flag = false;
			}

			$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

			$result = mysqli_query($conn, $sql);


			if (mysqli_num_rows($result) > 0) {
				$flag = true;
			} else {

				echo "Username password mismatch or not found!";

				$flag = false;
			}


			if ($flag === true) {
				echo "Successfully Logged In";

				$_SESSION['logged_in_user'] = mysqli_fetch_assoc($result);

				header("Location: dashboard.php");

				// USE SESSION TO PASS USER DETAILS
			}
		}

		function sanitize($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>
	</div>


<?php

include 'footer.php';

?>