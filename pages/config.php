<?php

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'slam');
define('DB_USER', 'root');
define('DB_PASSWORD', '9550990344');

// Connect to database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}