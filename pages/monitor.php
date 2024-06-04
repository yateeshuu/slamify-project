<?php
    require_once("config.php");
    require_once("functions.php");
    $total_users = getTotalRegisteredUsers();
    $total_feedbacks  = getTotalFeedbacks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
    <title>Slamify-monitor</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
<style>
    body{
			overflow: hidden;
	    background-color: #ECCDB4;	
		font-family: 'Marck Script', cursive;
	}

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            margin-bottom: 30px;
        }

        .card {
            width: 300px;
            height: 100px;
            background-color: #FEA1A1;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }
        h1{
            font-size: 60px;
            margin-top: 50px;
            margin-left: 550px;
        }

        .card a {
            text-decoration: none;
            color: #333;
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 25px;
            color: #777;
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
<div class="container">
        <div class="card">
        <h2>Total registered users</h2>
        <p><?php echo $total_users; ?></p>
            </a>
        </div>
        <div class="card">
            <a href="feedback1.php">
            <h2>Total Feedbacks received</h2>
            <p><?php echo $total_feedbacks; ?></p>
            </a>
        </div>
    </div>
<script src="../js/nav.js"></script>
</body>
</html>