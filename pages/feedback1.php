<?php
    require_once("config.php");
    require_once("functions.php");
    if (isset($_GET['delete'])) {
        $feedback_id = $_GET['delete'];
        deleteFeedback($feedback_id);
    }
    $total_users = getTotalRegisteredUsers();
    $total_feedbacks  = getTotalFeedbacks();
    $feedbacks = getAllFeedbacks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Share heartfelt messages and create lasting memories with Slamify. Craft personalized slam books for seamless sharing and cherish your connections.">
    <title>Slamify-feedback</title>
  <link rel="icon" href="android-chrome-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/feedback1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Marck+Script">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
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
    <br>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Feedback</th>
                <th>Date</th>
                <th>Ation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $feedback): ?>
                <tr>
                    <td><?php echo $feedback['name']; ?></td>
                    <td><?php echo $feedback['email']; ?></td>
                    <td><?php echo $feedback['feedback']; ?></td>
                    <td><?php echo $feedback['date']; ?></td>
                    <td><a href="feedback1.php?delete=<?php echo $feedback['id']; ?>" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="../js/nav.js"></script>
</body>
</html>
