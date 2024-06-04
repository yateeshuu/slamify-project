<?php
// Retrieve the values from the form
$usernam = $_POST['username'];

// Connect to the database
require_once("config.php");

// Retrieve the password from the admins table using the provided username
$sql = "SELECT passw FROM admin WHERE name = '$usernam'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the password and insert a new record into the register table
    $row = $result->fetch_assoc();
    $passwor = $row["passw"];
    
    // Delete the record from the admins table
    $delete_sql = "DELETE FROM admin WHERE name = '$usernam'";
    $conn->query($delete_sql);
    echo '<script>alert("Admin deleted successfully!");</script>';
    echo '<script>window.location.href="adminaccess.html";</script>';
} else {
    echo '<script>alert("User ID not found in the admin table!");history.back();</script>';
}

$conn->close();
?>