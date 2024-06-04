<?php
$table_name = $_GET["table_name"];

include('config.php');

// get the names of all submissions
$sql = "SELECT DISTINCT `what is your name` FROM `$table_name`";
$result = mysqli_query($conn, $sql);

$names = array();
while ($row = mysqli_fetch_assoc($result)) {
	$names[] = $row["what is your name"];
}

echo json_encode($names);

$conn->close();
?>
