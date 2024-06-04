<?php
// Database connection
require_once('config.php');

// Get total number of registered users
function getTotalRegisteredUsers() {
    global $conn;
    $sql = "SELECT COUNT(*) AS total_users FROM register";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total_users'];
}
// Get total number of registered users
function getTotalFeedbacks() {
    global $conn;
    $sql = "SELECT COUNT(*) AS total_feedbacks FROM feedbacks";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total_feedbacks'];
}

// Get all feedbacks from the database
function getAllFeedbacks() {
    global $conn;
    $sql = "SELECT * FROM feedbacks";
    $result = mysqli_query($conn, $sql);
    $feedbacks = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $feedbacks[] = $row;
    }
    return $feedbacks;
}

// // Get starred feedbacks from the database
// function getStarredFeedbacks() {
//     global $conn;
//     $sql = "SELECT * FROM feedbacks WHERE starred = 1";
//     $result = mysqli_query($conn, $sql);
//     $feedbacks = array();
//     while ($row = mysqli_fetch_assoc($result)) {
//         $feedbacks[] = $row;
//     }
//     return $feedbacks;
// }

// // Star/unstar a feedback
// function toggleStarFeedback($feedback_id, $is_starred) {
//     global $conn;
//     $sql = "UPDATE feedbacks SET starred = $is_starred WHERE id = $feedback_id";
//     mysqli_query($conn, $sql);
// }

// Delete a feedback
function deleteFeedback($feedback_id) {
    global $conn;
    $sql = "DELETE FROM feedbacks WHERE id = $feedback_id";
    mysqli_query($conn, $sql);
}
