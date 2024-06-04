<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
	<title>Slamify-slams</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../css/view.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
	<style>
		body {
			font-family: 'Marck Script', cursive;
			background-image:url('../images/circlebg.png');
			background-size:cover;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
		}

		.card {
			background-color:#FFF;
			border: 1px solid #ccc;
			box-shadow: 0 2px 4px rgba(0,0,0,.1);
			padding: 20px;
			margin-bottom: 20px;
			border-radius:10px;
		}

		.card-container{
			background-color:  rgb(169, 219, 219);
			border: 1px solid #ccc;
			box-shadow: 0 2px 4px rgba(0,0,0,.1);
			padding: 20px;
			margin-bottom: 20px;
			border-radius:10px;
		}

		.card:hover {
			box-shadow: 0 4px 8px rgba(0,0,0,.2);
		}

		.card h2 {
			margin-top: 0;
			font-size: 24px;
		}

		.card ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		.card ul li {
			margin-bottom: 10px;
		}

		.card ul li label {
			font-weight: bold;
		}

		.card ul li span {
			display: block;
			margin-left: 20px;
		}

		.view-btn, .delete-btn {
			display: inline-block;
			background-color: #f3920b;
			color: #fff;
			border: none;
			padding: 10px;
			border-radius: 15px;
			cursor: pointer;
			font-family: 'Marck Script', cursive;
			font-size: 15px;
			margin-left: 10px;
		}
	</style>
</head>
<body>
<header>
		<nav class="nav">
		  <a href="../pages/main.html" class="logo">Slamify</a>
  
		  <div class="hamburger">
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
		  </div>
  
		  <div class="nav__link hide">
			<a href="../pages/main.html#about_section">create</a>
			<a href="../pages/searchslam.html">Write</a>
			<a href="../pages/view.php">Read</a>
			<a href="../pages/slamques.html">Questions for u</a>
			<a href="../pages/about.html">About us</a>
		  </div>
		</nav>
	  </header>
	<div class="container">
		<?php
			// start session and get username from session
			session_start();
			$userid = $_SESSION['username'];
			//connect to the database
			include('config.php');
			$stmt = $conn->prepare("SELECT * FROM information_schema.tables WHERE table_schema = ? AND table_name LIKE '%s'");
			$tableName = $userid;
			$sql = "SELECT * from $tableName";
			$result = mysqli_query($conn, $sql);

			// get the table names
			echo '<h1>view submissions of my slams</h1>';
			echo '<div class="card-container">';
			while ($row = $result->fetch_assoc()) {
				$table_name = $row['book'];
				// display each table as a card with delete button
				echo '<div class="card">';
				echo '<h2>' . $table_name . '</h2>';
				echo '<div>';
				$encoded_table_name = urlencode($table_name);

                 $url = "viewsub.php?table_name=" . $encoded_table_name;

                 echo '<button class="view-btn" onclick="location.href=\'' . $url . '\';">View Submissions</button>'; 
				echo '<button class="delete-btn" onclick="deleteTable(\'' .$table_name . '\');">Delete</button>';
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';

			if (isset($_POST['delete'])) {
				// delete table from database and user table
				$table_name = $_POST['table_name'];
				$sql = "DROP TABLE $table_name";
				if (mysqli_query($conn, $sql)) {
					$sql = "DELETE FROM $userid WHERE book = '$table_name'";
					if (mysqli_query($conn, $sql)) {
						echo '<script>alert("Slam book deleted successfully.")</script>';
						// refresh page to update card list
						echo '<meta http-equiv="refresh" content="0">';
					} else {
						echo '<script>alert("Error deleting slam book from user table.")</script>';
					}
				} else {
					echo '<script>alert("Error deleting slam book from database.")</script>';
				}
			}

			$conn->close();
		?>
	</div>
	<script>
		function deleteTable(table_name) {
			if (confirm("Are you sure you want to delete this slam book?")) {
				// create form to submit POST request
				var form = document.createElement("form");
				form.setAttribute("method", "POST");
				form.setAttribute("action", "");

				// create input fields for form data
				var table_name_input = document.createElement("input");
				table_name_input.setAttribute("type", "hidden");
				table_name_input.setAttribute("name", "table_name");
				table_name_input.setAttribute("value", table_name);
				form.appendChild(table_name_input);

				var delete_input = document.createElement("input");
				delete_input.setAttribute("type", "hidden");
				delete_input.setAttribute("name", "delete");
				delete_input.setAttribute("value", "true");
				form.appendChild(delete_input);

				document.body.appendChild(form);
				form.submit();
			}
		}
	</script>
	<script src="../js/nav.js"></script>
</body>
</html>

