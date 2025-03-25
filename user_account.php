<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$conn = new mysqli("localhost", "root", "", "gallerycafe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user reservations
$sql = "SELECT * FROM reservations WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: rgb(156, 118, 22);
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px; /* Reduced padding */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1 {
            margin: 0;
            font-size: 24px; /* Slightly smaller font */
        }
        .logout-btn {
            padding: 8px 12px; /* Reduced padding */
            background-color: #ffffff;
            color: rgb(156, 118, 22);
            text-decoration: none;
            border-radius: 5px;
            border: 2px solid rgb(156, 118, 22);
            transition: background-color 0.3s, color 0.3s;
            font-size: 14px; /* Slightly smaller font */
        }
        .logout-btn:hover {
            background-color: rgb(156, 118, 22);
            color: #ffffff;
        }
        .container {
            max-width: 1200px; /* Increased width for better layout */
            margin: 20px auto;
            padding: 15px; /* Reduced padding */
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: rgb(156, 118, 22);
            text-align: left;
            border-bottom: 2px solid rgb(156, 118, 22);
            padding-bottom: 5px; /* Reduced padding */
            margin-bottom: 15px; /* Reduced margin */
            font-size: 20px; /* Slightly smaller font */
        }
        .reservation-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three items per row */
            gap: 15px; /* Space between reservation boxes */
        }
        .reservation-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px; /* Reduced padding */
            background-color: #f8f9fa;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .reservation-detail {
            display: flex;
            justify-content: space-between; /* Space between label and value */
            margin-bottom: 2px; /* Reduced space between details */
        }
        .reservation-detail label {
            font-weight: bold;
            color: rgb(156, 118, 22);
            margin-bottom: 0; /* No margin below labels */
            font-size: 14px; /* Smaller font size */
            width: 40%; /* Set a fixed width for labels */
        }
        .reservation-detail p {
            margin: 0;
            color: #495057;
            background-color: #ffffff;
            padding: 3px; /* Reduced padding */
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 14px; /* Smaller font size */
            width: 55%; /* Set a fixed width for values */
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px; /* Smaller footer font size */
        }
    </style>
</head>
<body>
    <header>
        <h1>User Account</h1>
        <a class="logout-btn" href="logout.php">Logout</a>
    </header>

    <div class="container">
        <h2>Reserved Details:</h2>
        <div class="reservation-container">
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="reservation-card">
                        <div class="reservation-detail">
                            <label>Reservation ID:</label>
                            <p><?php echo htmlspecialchars($row['id']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Date:</label>
                            <p><?php echo htmlspecialchars($row['date']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Time:</label>
                            <p><?php echo htmlspecialchars($row['time']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Guests:</label>
                            <p><?php echo htmlspecialchars($row['guests']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Table Type:</label>
                            <p><?php echo htmlspecialchars($row['tabletype']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Parking:</label>
                            <p><?php echo htmlspecialchars($row['parking']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Vehicle Type:</label>
                            <p><?php echo htmlspecialchars($row['vehicle_type']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Vehicle Number:</label>
                            <p><?php echo htmlspecialchars($row['vehicle_number']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Menu Items:</label>
                            <p><?php echo htmlspecialchars($row['menu_items']); ?></p>
                        </div>
                        <div class="reservation-detail">
                            <label>Special Requests:</label>
                            <p><?php echo htmlspecialchars($row['requests']); ?></p>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>No reservations found.</p>
            <?php } ?>
        </div>
    </div>

    <footer>
        &copy; 2024 Gallery Cafe. All rights reserved.
    </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
