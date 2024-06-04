<?php
// Establish connection to the database
include('config.php');

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$username = $_POST["username"];
	$nickname = $_POST["nickname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirm_password = $_POST["confirm_password"];

	// Check if password and confirm password match
	if ($password !== $confirm_password) {
		echo '<script>alert("Passwords do not match");history.back();</script>';
		exit;
	}

	// Check if the user ID already exists in the register table
	$sql = "SELECT * FROM register WHERE userid='$username'";
	$res = mysqli_query($conn, $sql);
	$flag = true;
	while ($row = $res->fetch_assoc()) {
		if ($row['userid'] == $username) {
			$flag = false;
			echo '<script>alert("User ID already exists");history.back();</script>';
		}
	}

	// Check if the user ID already exists in the admin table
	$sql = "SELECT * FROM admin WHERE name='$username'";
	$res = mysqli_query($conn, $sql);
	while ($row = $res->fetch_assoc()) {
		if ($row['name'] == $username) {
			$flag = false;
			echo '<script>alert("User ID already exists");history.back();</script>';
		}
	}

	// If the user ID doesn't exist, insert the user data into the register table
	if ($flag) {
		$sql = "INSERT INTO register (userid, email, passwod, nickname) VALUES ('$username', '$email', '$password', '$nickname')";
		if (mysqli_query($conn, $sql)) {
			$s = "CREATE TABLE `$username` (`book` VARCHAR(255))";
			mysqli_query($conn, $s);
			echo '<script>alert("Registration successful!")</script>';
			echo '<script>window.location.href="index.html";</script>';
		} else {
			// echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo '<script>window.location.href="index.html";</script>';
		}
	}
}

// Close the database connection
mysqli_close($conn);
?>
