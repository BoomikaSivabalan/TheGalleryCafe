<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "gallerycafe");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $guests = mysqli_real_escape_string($conn, $_POST['guests']);
    $tabletype = mysqli_real_escape_string($conn, $_POST['tabletype']);
    $parking = mysqli_real_escape_string($conn, $_POST['parking']);
    $vehicle_type = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
    $vehicle_number = mysqli_real_escape_string($conn, $_POST['vehicle_number']);
    $menu_items = mysqli_real_escape_string($conn, $_POST['menu_items']);
    $requests = mysqli_real_escape_string($conn, $_POST['requests']);

    // Get total available tables for the selected table type
    $tableQuery = "SELECT total_tables FROM tables WHERE tabletype = '$tabletype'";
    $tableResult = mysqli_query($conn, $tableQuery);
    $row = mysqli_fetch_assoc($tableResult);
    $totalTables = $row['total_tables'];

    // Check how many tables are booked for the selected date and time
    $bookingQuery = "SELECT COUNT(*) AS booked_count FROM reservations 
                     WHERE date = '$date' AND time = '$time' 
                     AND tabletype = '$tabletype'";
    
    $bookingResult = mysqli_query($conn, $bookingQuery);
    $bookingRow = mysqli_fetch_assoc($bookingResult);
    $bookedCount = $bookingRow['booked_count'];

    // Check if there are available tables
    if ($bookedCount >= $totalTables) {
        echo '<script>alert("Sorry, no tables available for the selected date and time."); window.location.href = "reservation.php";</script>';
        exit();
    }

    // If parking is requested, check parking availability
    if ($parking === 'yes') {
        // Get total parking slots available
        $parkingQuery = "SELECT total_slots FROM parking LIMIT 1"; // Assuming only one row
        $parkingResult = mysqli_query($conn, $parkingQuery);
        $parkingRow = mysqli_fetch_assoc($parkingResult);
        $totalParkingSlots = $parkingRow['total_slots'];

        // Check how many parking slots are booked for the selected date and time
        $parkingBookingQuery = "SELECT COUNT(*) AS booked_parking_count FROM reservations 
                                WHERE date = '$date' AND time = '$time' 
                                AND parking = 'yes'";
        
        $parkingBookingResult = mysqli_query($conn, $parkingBookingQuery);
        $parkingBookingRow = mysqli_fetch_assoc($parkingBookingResult);
        $bookedParkingCount = $parkingBookingRow['booked_parking_count'];

        // Check if there are available parking slots
        if ($bookedParkingCount >= $totalParkingSlots) {
            echo '<script>alert("Sorry, no parking slots available for the selected date and time."); window.location.href = "reservation.php";</script>';
            exit();
        }
    }

    // Insert reservation into the database
    $insertQuery = "INSERT INTO reservations (user_id, name, email, phone, date, time, guests, tabletype, parking, vehicle_type, vehicle_number, menu_items, requests) 
                    VALUES ('$user_id', '$name', '$email', '$phone', '$date', '$time', '$guests', '$tabletype', '$parking', '$vehicle_type', '$vehicle_number', '$menu_items', '$requests')";
    
    if (mysqli_query($conn, $insertQuery)) {
        echo '<script>alert("Reservation successful!"); window.location.href = "userhome.php";</script>';
    } else {
        echo '<script>alert("ERROR: Could not execute. " . mysqli_error($conn)); window.location.href = "reservation.php";</script>';
    }
}

mysqli_close($conn);
?>
