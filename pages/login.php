<?php
// Start the session
session_start();

// Check if the login form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get the user ID and password from the form
	$userid = $_POST['userid'];
	$password = $_POST['password'];

	// Connect to the database
	include('config.php');

	// Check if the user ID and password exist in the admin table
	$sql = "SELECT * FROM admin WHERE name='$userid' AND passw='$password'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 1) {
		// Set the user ID in the session
		$_SESSION['username'] = $userid;

		// Redirect to the admin home page
		echo '<script>window.location.href="adminhome.html";</script>';
	} 
	else {
		// Check if the user ID and password exist in the register table
		$sql = "SELECT * FROM register WHERE userid='$userid'";
	$res = mysqli_query($conn, $sql);
	$flag = false;
	while($row=$res->fetch_assoc()){
		if($row['userid']==$userid) {
			$flag = true;
		}
	}	
	if($flag){
		$sql = "SELECT * FROM register WHERE userid='$userid' AND passwod='$password'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) == 1) {
			// Set the user ID in the session
			$_SESSION['username'] = $userid;

			// Redirect to the home page
			$row = mysqli_fetch_assoc($result);
			// $nickname = $row['nickname'];
            // echo '<script>alert("Inc")</script>';
			echo '<script>window.location.href="main.html";</script>';

		} else {
			echo '<script>alert("Incorrect password");history.back();</script>';
		}
	}
	else{
		echo '<script>alert("User doesnt exists");history.back();</script>';

	}
	}

	// Close the database connection
	mysqli_close($conn);
}
?>
