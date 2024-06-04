<?php
// add these lines at the beginning of your PHP code
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
	<title>Slamify-fill_slam</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../css/displayslam.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
	<style>
		input[type="number"], input[type="date"],input[type="text"] {
       width: 100%;
       box-sizing: border-box;
       padding: 12px 20px;
       margin: 8px 0;
       border: none;
       border-radius: 4px;
       background-color: #f1f1f1;
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
		
			//retrieve the book title from the form submission
			$title = $_POST['title'];
			//connect to the database
			include('config.php');

			//query the database for the corresponding table
			$stmt = $conn->prepare("SELECT * FROM information_schema.tables WHERE table_name = ?");
			$stmt->bind_param("s", $title);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows >0) {
				//get the table details
				$table = $result->fetch_assoc();
				$table_name = $title;
				$stmt = $conn->prepare("SELECT COLUMN_NAME, DATA_TYPE FROM information_schema.columns WHERE table_name = ? ORDER BY ORDINAL_POSITION ASC");
				$stmt->bind_param("s", $table_name);
				$stmt->execute();
				$result = $stmt->get_result();

				if ($result->num_rows > 0) {
					//dynamically generate the input fields based on the column data types
					echo '<form method="POST" action="submit1.php">';
					echo '<h1>'.$table_name.'</h1>';
                    echo '<br>';
					// Add a hidden input field to the form to send the table name to the next page
					echo '<input type="hidden" name="table_name" value="'.$table_name.'">';

					while($row = $result->fetch_assoc()) {
						$column_name = $row['COLUMN_NAME'];
						$data_type = $row['DATA_TYPE'];
						echo '<label for="'.$column_name.'">'.$column_name.':</label>';

						if($data_type == 'int') {
							echo '<input type="number" placeholder="Fill your answer" id="'.$column_name.'" name="'.$column_name.'" required>';
						}
						else if($data_type == 'date'){
							echo '<input type="date" placeholder="Fill your answer" id="'.$column_name.'" name="'.$column_name.'" required>';
						}
						else {
							echo '<input type="text" placeholder="Fill your answer" id="'.$column_name.'" name="'.$column_name.'" required>';
						}
					}
					echo '<button type="submit" id="submit">Submit</button>';
					echo '</form>';
				} else {
					echo "<p>No columns found in the table.</p>";
				}
			} else {
				echo "<p>No table found with the given title.</p>";
			}

			//close the database connection
			$conn->close();
		?>
	</div>
	<script src="../js/nav.js"></script>
</body>
</html>
