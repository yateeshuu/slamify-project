<?php
// Retrieve the values from the form
$userid = $_POST['userid'];

// Connect to the database
require_once("config.php");

// Retrieve the password from the register table using the provided userid
$sql = "SELECT passwod FROM register WHERE userid = '$userid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the password and insert a new record into the admins table
    $row = $result->fetch_assoc();
    $password = $row["passwod"];
    $insert_sql = "INSERT INTO admin (name, passw) VALUES ('$userid', '$password')";
    $conn->query($insert_sql);

    echo '<script>alert("Admin added successfully!");</script>';
    echo '<script>window.location.href="adminaccess.html";</script>';
} else {
    echo '<script>alert("User ID not found in the register table!");history.back();</script>';
}

$conn->close();
?>