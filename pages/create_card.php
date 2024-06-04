<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
    <title>Slamify-admin_static</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
  <link rel="stylesheet" type="text/css" href="../css/nav.css">
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
        .card {
            width: 40%;
            height: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 2px 2px 5px #ccc;
            padding: 10px;
            margin-left: 400px;
            margin-bottom: 50px;
            background-color: #fff;
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
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            float: right;
            margin-left: 10px;
        }

        .card button:hover {
            background-color: #f3920b;
        }

        #submit1 {
            width: 100px;
            background-color: #f3920b;
        }

        #submit {
            background-color: #f3920b;
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
            width:600px;
            max-height: 90%;
            background-color: #FEA1A1;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            overflow-y: auto; /* Added: Enable vertical scrollbar */
        }

        .question-container {
            margin-bottom: 10px;
            color: #000;
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
        <a href="../pages/adminhome.html">home</a>
        </div>
      </nav>
    </header> 
<!-- Your PHP code here -->
<?php
// Get input data
if (isset($_POST["title"])) {
  $title = trim($_POST["title"]);
  if (!empty($title)) {
      // Check if the card already exists
      $cards = file("cards.txt", FILE_IGNORE_NEW_LINES);
      foreach ($cards as $line) {
          $data = json_decode($line, true);
          if (isset($data["title"]) && $data["title"] === $title) {
              // Card with the same title already exists
              echo "<script>alert('Card with title \"$title\" already exists. Please choose a different title.');</script>";
              echo "<script>window.location.href = 'createstatic.html';</script>";
              exit; // Stop further execution
          }
      }

      // Card doesn't exist, proceed to save
      $questions = array();
      for ($i = 1; $i <= 10; $i++) {
          $question = trim($_POST["question" . $i]);
          if (!empty($question)) {
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


// Check if delete button clicked
if (isset($_POST["delete_title"])) {
  // Get title of card to delete
  $titleToDelete = $_POST["delete_title"];

  // Read all data from file
  $cards = file("cards.txt", FILE_IGNORE_NEW_LINES);

  // Remove card from array
  foreach($cards as $index => $line) {
      $data = json_decode($line, true);
      if(isset($data["title"]) && $data["title"] === $titleToDelete) {
          unset($cards[$index]);
      }
  }

  // Write remaining cards back to file
  $file = fopen("cards.txt", "w");
  fwrite($file, implode("\n", $cards));
  fclose($file);
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
        echo "<form method='post' action='create_card.php'>";
        echo "<input type='hidden' name='delete_title' value='" . htmlspecialchars($data["title"]) . "'>";
        echo "<button type='submit id='submit' '>Delete</button>";
        echo "</form>";
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
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Parse the JSON response
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Create the form element and its hidden fields
                    var form = document.createElement("form");
                    form.setAttribute("method", "post");
                    form.setAttribute("action", "static.php");
                    form.style.display = "none";
                    var titleInput = document.createElement("input");
                    titleInput.setAttribute("type", "hidden");
                    titleInput.setAttribute("name", "title");
                    titleInput.setAttribute("value", response.data.title);
                    form.appendChild(titleInput);
                    response.data.questions.forEach(function (question, index) {
                        var questionInput = document.createElement("input");
                        questionInput.setAttribute("type", "hidden");
                        questionInput.setAttribute("name", "questions[]");
                        questionInput.setAttribute("value", question);
                        form.appendChild(questionInput);
                    });
                    document.body.appendChild(form);

                    // Create the cancel button
                    var cancelButton = document.createElement("button");
                    cancelButton.textContent = "Cancel";
                    cancelButton.style.marginTop = "10px";
                    cancelButton.style.padding = "10px 20px";
                    cancelButton.style.borderRadius = "5px";
                    cancelButton.style.backgroundColor = "#f3920b";
                    cancelButton.style.color = "#fff";
                    cancelButton.style.border = "none";
                    cancelButton.style.float = "right";
                    cancelButton.style.cursor = "pointer";
                    cancelButton.addEventListener("click", function () {
                        dialogContainer.remove();
                    });

                    // Create the submit button
                    var submitButton = document.createElement("button");
                    submitButton.textContent = "Submit";
                    submitButton.style.marginTop = "10px";
                    submitButton.style.padding = "10px 20px";
                    submitButton.style.borderRadius = "5px";
                    submitButton.style.backgroundColor = "#4CAF50";
                    submitButton.style.color = "#fff";
                    submitButton.style.border = "none";
                    submitButton.style.cursor = "pointer";
                    submitButton.style.float = "right";
                    submitButton.setAttribute("type", "submit");
                    form.appendChild(submitButton);

                    // Create the dialog container
                    var dialogContainer = document.createElement("div");
                    dialogContainer.className = "dialog-container";

                    // Create the dialog inner container
                    var dialogInner = document.createElement("div");
                    dialogInner.className = "dialog-inner";
                    dialogInner.style.maxWidth = "90%";
                    dialogInner.style.maxHeight = "90%";

                    // Create the title element
                    var titleEl = document.createElement("h2");
                    titleEl.textContent = response.data.title;
                    dialogInner.appendChild(titleEl);

                    // Create the questions container
                    var questionsContainer = document.createElement("div");

                    // Create the questions
                    response.data.questions.forEach(function (question) {
                        var questionContainer = document.createElement("div");
                        questionContainer.className = "question-container";

                        var label = document.createElement("label");
                        label.textContent = question;
                        questionContainer.appendChild(label);

                        var input = document.createElement("input");
                        input.setAttribute("type", "text");
                        input.setAttribute("name", "answers[]");
                        input.style.padding = "10px";
                        input.style.borderRadius = "5px";
                        input.style.border = "1px solid #ccc";
                        input.style.width = "100%";
                        input.style.boxSizing = "border-box";
                        questionContainer.appendChild(input);

                        questionsContainer.appendChild(questionContainer);
                    });

                    dialogInner.appendChild(questionsContainer);
                    dialogInner.appendChild(cancelButton);
                    dialogContainer.appendChild(dialogInner);

                    // Add the dialog container to the body
                    document.body.appendChild(dialogContainer);
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
