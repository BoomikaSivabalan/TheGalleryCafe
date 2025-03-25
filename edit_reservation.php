<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "gallerycafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reservation details
if (isset($_GET['id'])) {
    $reservation_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM reservations WHERE id = '$reservation_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $reservation = $result->fetch_assoc();
    } else {
        echo "Reservation not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Update reservation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $requests = mysqli_real_escape_string($conn, $_POST['requests']);

    $sql = "UPDATE reservations SET 
                name = '$name', email = '$email', phone = '$phone', 
                date = '$date', time = '$time', guests = '$guests', 
                tabletype = '$tabletype', parking = '$parking', 
                vehicle_type = '$vehicle_type', vehicle_number = '$vehicle_number', 
                requests = '$requests' 
            WHERE id = '$reservation_id'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Reservation updated successfully!"); window.location.href = "staff_panel.php";</script>';
    } else {
        echo '<script>alert("Update failed."); window.location.href = "edit_reservation.php?id=' . $reservation_id . '";</script>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #35424a;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 24px;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #35424a;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        button:hover {
            background-color: #2c3e50;
        }
        a{
            text-decoration:none;
        }
        .add-button {
        padding: 10px 15px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        margin: 20px;
        display: inline-block;
        }
        .add-button:hover {
        background: #218838;
        }
    </style>
</head>
<body>

<header>
    Edit Reservation
</header>

<a class="add-button" href="staff_panel.php">Back to Dashboard</a>

<div class="container">

    <h2>Edit Reservation Details</h2>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($reservation['name']); ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($reservation['email']); ?>" required>
        
        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($reservation['phone']); ?>" required>
        
        <label>Date:</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($reservation['date']); ?>" required>
        
        <label>Time:</label>
        <input type="time" name="time" value="<?php echo htmlspecialchars($reservation['time']); ?>" required>
        
        <label>Guests:</label>
        <input type="number" name="guests" value="<?php echo htmlspecialchars($reservation['guests']); ?>" required min="1">
        
        <label>Table Type:</label>
        <input type="text" name="tabletype" value="<?php echo htmlspecialchars($reservation['tabletype']); ?>" required>
        
        <label>Parking:</label>
        <input type="text" name="parking" value="<?php echo htmlspecialchars($reservation['parking']); ?>" required>
        
        <label>Vehicle Type:</label>
        <input type="text" name="vehicle_type" value="<?php echo htmlspecialchars($reservation['vehicle_type']); ?>">
        
        <label>Vehicle Number:</label>
        <input type="text" name="vehicle_number" value="<?php echo htmlspecialchars($reservation['vehicle_number']); ?>">
        
        <label>Pre Order:</label>
        <textarea name="menu_items" rows="4"><?php echo htmlspecialchars($reservation['menu_items']); ?></textarea>

        <label>Special Requests:</label>
        <textarea name="requests" rows="4"><?php echo htmlspecialchars($reservation['requests']); ?></textarea>
        
        <button type="submit">Update Reservation</button>
    </form>

</div>



</body>
</html>
