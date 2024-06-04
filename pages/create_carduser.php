<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
    <title>Slamify-static_Slams</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
    <style>
      body{
        font-family: 'Marck Script', cursive;
			background-image:url('../images/circlebg.png');
      }
        .card {
            width:40%;
            height:100%;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 2px 2px 5px #ccc;
            padding: 10px;
            margin-left: 400px;
            margin-bottom: 50px;
            background-color: #fff;
            margin-top:50px;
        }

        .card h2 {
            font-size: 20px;
            margin-top: 0;
        }

        .card p {
            font-size: 16px;
            margin-bottom: 0;
        }

        .card button {
  /* background-color: #4CAF50; */
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: inline-block;
  float: right; /* or float: left */
  margin-left: 10px; /* optional margin between the buttons */
}


        .card button:hover {
            background-color: #3e8e41;
        }

        #submit1{
            width:100px;
            background-color: #f3920b;
            font-family: 'Marck Script', cursive;
        }
        #submit{
            background-color: rgb(255, 0, 0);
        }
.dialog-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.dialog-inner {
    max-width: 90%;
    max-height: 90%;
    overflow: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.question-container {
    margin-bottom: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}
.share-button {
  margin-top: 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.share-button:hover {
  background-color: #0069d9;
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
// Get input data
if(isset($_POST["title"])) {
    $title = trim($_POST["title"]);
    if(!empty($title)) {
        $questions = array();
        for($i=1; $i<=10; $i++) {
          $question = trim($_POST["question".$i]);
          if(!empty($question)) {
            $questions[] = $question;
          }
        }
        $data = array("title" => $title, "questions" => $questions);

        // Write data to file
        $file = fopen("cards.txt", "a");
        fwrite($file, json_encode($data) . "\n");
        fclose($file);
    }
}


// Read data from file and display all cards
$file = fopen("cards.txt", "r");
$index = 0;
while (!feof($file)) {
  $line = trim(fgets($file));
  if (!empty($line)) {
    $data = json_decode($line, true);
    if (isset($data["title"])) {
        echo "<div class=\"card\">";
        echo "<h2>" . htmlspecialchars($data["title"]) . "</h2>";
        echo "<p>This is " . htmlspecialchars($data["title"]) . " slam</p>";
        echo "<button id='submit1' onclick='showSlam(\"" . htmlspecialchars($data["title"]) . "\")'>View Slam</button>";
        echo "</div>";
    }

    $index++;
  }
}
fclose($file);
?>
<script>
function showSlam(title) {
  // Make an AJAX request to get the questions for the specified card
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "get_card.php?title=" + encodeURIComponent(title), true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // Parse the JSON response
      var response = JSON.parse(xhr.responseText);
      if (response.success) {
        // Create the form element and its hidden fields
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "displaystatic.php");
        form.style.display = "none";
        var titleInput = document.createElement("input");
        titleInput.setAttribute("type", "hidden");
        titleInput.setAttribute("name", "title");
        titleInput.setAttribute("value", response.data.title);
        form.appendChild(titleInput);
        response.data.questions.forEach(function(question, index) {
          var questionInput = document.createElement("input");
          questionInput.setAttribute("type", "hidden");
          questionInput.setAttribute("name", "questions[]");
          questionInput.setAttribute("value", question);
          form.appendChild(questionInput);
        });
        document.body.appendChild(form);
        form.submit();
      } else {
        alert(response.message);
      }
    }
  };
  xhr.send();
}
</script>
<script src="../js/nav.js"></script>
</body>
</html>
