<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Slamify-display_static</title>
	<meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="../css/displayslam.css">
  <link rel="stylesheet" type="text/css" href="../css/nav.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
  <style>
    .dialog {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 999;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      display: none;
    }

    .dialog h2 {
      margin-top: 0;
    }

    .dialog input[type="text"] {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      width: 100%;
      box-sizing: border-box;
    }

    .dialog button {
      margin-top: 10px;
      padding: 10px 20px;
      border-radius: 5px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    #shareButton {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px;
      border-radius: 15px;
      cursor: pointer;
      margin-left: 88%;
      font-family: 'Marck Script', cursive;
      font-size: 15px;
      width:70px;
    }

    /* New CSS for background blur and dimming */
    /* #body:not(.dialog-open) {
      filter: blur(5px); /* Adjust the blur strength as desired */
      /* pointer-events: none; */
    

    /* #body:not(.dialog-open)::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 998;
    } */
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
    <h1>Slam Questions</h1>

    <?php
    if (isset($_POST['title']) && isset($_POST['questions'])) {
      $title = $_POST['title'];
      $questions = $_POST['questions'];

      echo "<h2>" . htmlspecialchars($title) . "</h2>";
      echo "<br>";
      foreach ($questions as $index => $question) {
        echo "<label>" . htmlspecialchars($question) . "</label>";
        echo "<input type='hidden' name='questions[]' value='" . htmlspecialchars($question) . "'>";
        echo "<input type='text' name='answers[]' id='question$index'>";
      }
      echo "<input type='hidden' name='title' value='" . htmlspecialchars($title) . "'>";
      echo "<button type='submit' id='shareButton'>Share</button>";
    } else {
      echo "No slam questions found.";
    }
    ?>
  </div>
  <div class="dialog" id="dialog">
    <h2>Enter the book name:</h2>
    <input type="text" id="bookNameInput">
    <button id="shareDialogButton">Share</button>
  </div>


  <script>
    document.getElementById("shareButton").addEventListener("click", function() {
      var body = document.getElementById("body");
      body.classList.add("dialog-open");
    });

    document.getElementById("shareButton").addEventListener("click", function() {
      var dialog = document.getElementById("dialog");
      dialog.style.display = "block";
    });

    document.getElementById("shareDialogButton").addEventListener("click", function() {
      var bookNameInput = document.getElementById("bookNameInput").value;
      var titleInput = document.querySelector("input[name='title']").value;

      var url = "displaystatic1.php?bookName=" + encodeURIComponent(bookNameInput) + "&title=" + encodeURIComponent(titleInput);
      window.location.href = url;

      var dialog = document.getElementById("dialog");
      dialog.style.display = "none";

      var body = document.getElementById("body");
      body.classList.remove("dialog-open");
    });
  </script>
  <script src="../js/nav.js"></script>
</body>
</html>
