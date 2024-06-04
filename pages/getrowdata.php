<?php
$table_name=$_GET["table_name"];

$name = $_GET["name"];
// connect to the database
include('config.php');

// get the column names for the selected table
$sql = "SHOW COLUMNS FROM `$table_name`";
$result = mysqli_query($conn, $sql);

// store the column names in an array
$column_names = array();
while ($row = mysqli_fetch_assoc($result)) {
    $column_names[] = $row["Field"];
}

// get the row data for the selected name
$sql = "SELECT * FROM `$table_name` WHERE `what is your name` = '$name'";
$result = mysqli_query($conn, $sql);

// display the row data as a form
if (mysqli_num_rows($result) > 0) {
    echo "<form>";
    $question_number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($column_names as $column_name) {
            echo "<div class='question'>$question_number. $column_name:</div>"; // add question number to question label
            echo "<div class='answer'><input type='textarea' value='" . $row[$column_name] . "' readonly></div>";
            $question_number++;
        }
    }
    echo "</form>";
} else {
    echo "<h2>No submissions for $name in $table_name</h2>";
}

$conn->close();
?>
