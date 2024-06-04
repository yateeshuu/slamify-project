<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
    <title>Slamify-answers</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/displayslam.css">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
    <style>
        label {
            font-weight: bold;
            color:#F05454;
        }
        p{
            color:#000;
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
    //connect to the database
    include('config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //check if any answers were submitted
        $answers = array_filter($_POST, function($key) {
            return $key !== 'table_name' && $key !== 'description';
        }, ARRAY_FILTER_USE_KEY);
        if (count($answers) >= 0) {
            //check if table exists
            $table_name = $_POST['table_name'];
            $stmt = $conn->prepare("SELECT * FROM information_schema.tables WHERE table_name = ?");
            $stmt->bind_param("s", $table_name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >= 0) {
                //table exists, insert answers
                $column_names = array_map(function($col) {
                    return "`" . str_replace('_', ' ', $col) . "`";
                }, array_keys($answers));

                $columns = implode(',', $column_names);
                $values = "'" . implode("','", array_values($answers)) . "'";
                $stmt = $conn->prepare("INSERT INTO `$table_name` ($columns) VALUES ($values)");
                $stmt->execute();
                echo '<h2>You answered the slam!</h2>';
                echo '<br>';
                echo '<label>Title:</label>';
                echo '<p>'.$table_name.'</p>';
                echo '<br>';
                // echo '<label>Description:</label>';
                // echo '<p>'.$_POST['description'].'</p>';
                foreach ($answers as $key => $value) {
                    $column_label = str_replace('_', ' ', $key);
                    echo '<label>'.ucfirst($column_label).':</label>';
                    echo '<p>'.$value.'</p>';
                    echo '<br>';
                }
            } else {
                //table does not exist, show error message
                echo "<p>No table found with the given title.</p>";
            }
        } else {
            //no answers submitted, show alert
            echo '<script>alert("Please fill in at least one answer.");</script>';
        }
    } else {
        echo '<p>No answers submitted.</p>';
    }
    //close the database connection
    $conn->close();
    ?>
</div>
<script src="../js/nav.js"></script>
</body>
</html>
