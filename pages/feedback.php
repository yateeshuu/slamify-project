<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$feedback = $_POST['feedback'];
	$date = date('Y-m-d');

    $sql = "SELECT MAX(id) AS max_id FROM feedbacks";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $p_id = $row["max_id"] + 1;

	$sql = "INSERT INTO feedbacks (id,name, email, feedback, date) VALUES ('$p_id','$name', '$email', '$feedback', '$date')";

	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Thank you for your feedback!')</script>";
		echo "<script>window.location.href='main.html'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

mysqli_close($conn);
?>
