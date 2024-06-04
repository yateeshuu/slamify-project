<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	   <meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <title>Slamify-slam_created</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
  <style>
    body {
      background-image:url("../images/gift.gif");
      background-size:cover;
      background-repeat:no repeat;
      font-family: 'Marck Script', cursive;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 25vh;
      width: 60vh;
      margin-top:15%;
      background-color:rgb(169, 219, 219);
      margin-left: 35%;
      border-radius:10px;
    }

    .container input[type="text"] {
      font-family: 'Marck Script', cursive;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 300px;
      margin-top: 20px;
    }

    .container .description {
      font-style: italic;
      margin-bottom: 5px;
      margin-top: 10px;
    }

    .container button {
      font-family: 'Marck Script', cursive;
      padding: 10px 20px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
    }

    .container button:hover {
      background-color: #45a049;
    }

    .container button:focus {
      outline: none;
    }
    @media screen and (max-width: 480px) {
  body{
    background-image: url("../images/circlebg.png");
  }
  .container {
    width: 90%;
    margin-left: 5%;
  }

  .container input[type="text"] {
    width: 80%;
  }
  .container .description {
      padding:10px;
    }

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
  <?php
  session_start();
  $username = $_SESSION['username'];
  $title = $_POST['title'];
  $questions = $_POST['questions'];
  $types = $_POST['types'];

  // Create connection
  include('config.php');
  $title=preg_replace('/\s+/', '_', $title);
  $username_title = $username . "_" . $title;
  $invalidQuestions = array_filter($questions, function($question) {
    return strlen($question) > 64;
});

if (!empty($invalidQuestions)) {
    $invalidQuestionsString = implode(', ', $invalidQuestions);
    echo '<script>alert("Questions exceeding 64 characters: ' . $invalidQuestionsString . '"); history.back();</script>';
}
else{
  // Check if table already exists
  $checkTableQuery = "SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = 'slam' AND table_name = '$username_title' LIMIT 1";
  $result = $conn->query($checkTableQuery);

  if ($result && $result->num_rows > 0) {
    // Table already exists
    echo '<script>alert("' . $username_title . ' already exists."); history.back();</script>';
  } else {
    // Check for duplicate questions
    $duplicateQuestions = array_filter(array_count_values($questions), function ($value) {
      return $value > 1;
    });

    // Check if "What is your name" question exists
    $nameQuestionExists = in_array("what is your name", $questions);

    if (!empty($duplicateQuestions) || $nameQuestionExists) {
      $errorMessages = [];
      
      if (!empty($duplicateQuestions)) {
        $duplicateQuestionsString = implode(', ', array_keys($duplicateQuestions));
        $errorMessages[] = "Duplicate questions exist: $duplicateQuestionsString";
      }

      if ($nameQuestionExists) {
        $errorMessages[] = "Duplicate questions exist: what is your name";
      }

      $errorMessage = implode(' ', $errorMessages);
      echo '<script>alert("' . $errorMessage . '"); history.back();</script>';
    } else {
      $sql = "CREATE TABLE `$username" . "_" . "$title` (`what is your name` varchar(255) NOT NULL, ";
      for ($i = 0; $i < count($questions); $i++) {
        $question = $questions[$i];
        $type = $types[$i];
        if ($type == "number") {
          $type = "int";
        }
        $sql .= "`$question` $type NOT NULL, ";
      }
      $sql = rtrim($sql, ", ");
      $sql .= ")";

      if (mysqli_query($conn, $sql)) {
        $username_title = $username . "_" . $title;
        $sql2 = "INSERT INTO $username (book) VALUES ('$username_title')";

        if (mysqli_query($conn, $sql2)) {
          $copyToClipboardFunction = 'function copyToClipboard() {
            const tableName ="Slam-Title:' . $username_title . '"
  const additionalInfo = "Visit our website: https://slamify.com\nPlease login and select the option of write slam.\nThere you enter this slam title to search the book and fill the slam...";
  const shareText = `${tableName}\n\n${additionalInfo}`;
  const encodedShareText = encodeURIComponent(shareText);
  window.location.href = `whatsapp://send?text=${encodedShareText}`;
          }';

          echo '<div class="container">
                  <input type="text" id="tableName" value="' . $username_title . '" readonly>
                  <p class="description">This is your title of slam book. Share it with your friends.</p>
                  <button onclick="copyToClipboard()">Share Via <span class="bi bi-whatsapp"></span></button>
                </div>';

          echo '<script>' . $copyToClipboardFunction . '</script>';
        } else {
          echo "Error inserting username_title in username table: " . mysqli_error($conn);
        }
      } else {
        echo "Error creating table: " . mysqli_error($conn);
      }
    }
  }}

  mysqli_close($conn);
  ?>
  <script src="../js/nav.js"></script>
</body>
</html>
