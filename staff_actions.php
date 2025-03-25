<?php
session_start();


// Database connection
$conn = new mysqli("localhost", "root", "", "gallerycafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for the action being performed
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_id = mysqli_real_escape_string($conn, $_POST['reservation_id']);

    if (isset($_POST['confirm'])) {
        // Confirm reservation
        $sql = "UPDATE reservations SET status = 'Confirmed' WHERE id = '$reservation_id'";

    } elseif (isset($_POST['edit'])) {
        // Redirect to edit page
        header("Location: edit_reservation.php?id=$reservation_id");
        exit();
    } elseif (isset($_POST['cancel'])) {
        // Cancel reservation
        $sql = "UPDATE reservations SET status = 'Cancelled' WHERE id = '$reservation_id'";

    }

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Operation successful!"); window.location.href = "staff_panel.php";</script>';
    } else {
        echo '<script>alert("Operation failed."); window.location.href = "staff_panel.php";</script>';
    }
}

$conn->close();
