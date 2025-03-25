<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "gallerycafe");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search query
$searchQuery = "";

// Handle search form submission
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['search_term']);
    $searchBy = mysqli_real_escape_string($conn, $_POST['search_by']);

    if (!empty($searchTerm)) {
        switch ($searchBy) {
            case 'name':
                $searchQuery = " WHERE name LIKE '%$searchTerm%'";
                break;
            case 'email':
                $searchQuery = " WHERE email LIKE '%$searchTerm%'";
                break;
            case 'date':
                $searchQuery = " WHERE date LIKE '%$searchTerm%'";
                break;
            case 'status':
                $searchQuery = " WHERE status LIKE '%$searchTerm%'";
                break;
        }
    }
}

// Fetch all reservations (with search filtering if applicable)
$sql = "SELECT * FROM reservations" . $searchQuery;
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Panel - Reservation Management</title>
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 22px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #35424a;
            color: white;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td {
            font-size: 14px;
            color: #333;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .actions button {
            padding: 8px 15px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .confirm {
            background-color: #4CAF50;
            color: white;
            margin-bottom:5px;
        }
        .confirm:hover {
            background-color: #45a049;
        }
        .edit {
            background-color: #ff9800;
            color: white;
        }
        .edit:hover {
            background-color: #e68900;
        }
        .cancel {
            margin-top:5px;
            background-color: #f44336;
            color: white;
        }
        .cancel:hover {
            background-color: #e41e1e;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        .logout {
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
            margin-left:600px;
            font-size: 18px;
        }
        .logout:hover {
            background: #c82333;
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-container input, .search-container select {
            padding: 8px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .search-container button {
            padding: 8px 15px;
            border-radius: 5px;
            border: none;
            background-color: #35424a;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }
        .search-container button:hover {
            background-color: #283e48;
        }
    </style>
</head>
<body>

<header>
    Staff Panel - Reservation Management
    <a class="logout" href="home.php">Logout</a>
</header>

<div class="container">

    <h2>Current Reservations</h2>

    <!-- Search form -->
    <div class="search-container">
        <form method="POST" action="">
            <input type="text" id="search_term" name="search_term" placeholder="Enter search term">
            <select id="search_by" name="search_by">
                <option value="name">Name</option>
                <option value="email">Email</option>
                <option value="date">Date</option>
                <option value="status">Status</option>
            </select>
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Guests</th>
                <th>Table Type</th>
                <th>Parking</th>
                <th>Pre-Order</th>
                <th>Requests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['time']); ?></td>
                        <td><?php echo htmlspecialchars($row['guests']); ?></td>
                        <td><?php echo htmlspecialchars($row['tabletype']); ?></td>
                        <td><?php echo $row['parking'] === 'yes' ? 'Yes' : 'No'; echo ',';
                        echo htmlspecialchars($row['vehicle_type']); echo ',';
                        echo htmlspecialchars($row['vehicle_number']);?></td>
                        <td><?php echo htmlspecialchars($row['menu_items']); ?></td>
                        <td><?php echo htmlspecialchars($row['requests']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td>
                            <div class="actions">
                                <form action="staff_actions.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="reservation_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="confirm" name="confirm">Confirm</button>
                                    <button type="submit" class="edit" name="edit">Edit</button>
                                    <button type="submit" class="cancel" name="cancel">Cancel</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No reservations found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php $conn->close(); ?>

</body>
</html>
