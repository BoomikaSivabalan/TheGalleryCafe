<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gallerycafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all promotions
$sql = "SELECT id, heading, start_date, end_date FROM promotions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Promotions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/panel.css"> 
</head>
<body>

<header>
<h1>Manage Promotions</h1>
</header>

<a class="add-button" href="admin_add_promotion.php">Add New Promotion</a> 
<a class="add-button" href="admin_panel.php">Back to Dashboard</a>


<table>
    <tr>
        <th>ID</th>
        <th>Heading</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["heading"] . "</td>";
            echo "<td>" . $row["start_date"] . "</td>";
            echo "<td>" . $row["end_date"] . "</td>";
            echo "<td class='action-buttons'>";
            echo "<a href='edit_promotion.php?id=" . $row["id"] . "'>Edit</a> |";
            echo "<a href='delete_promotion.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No promotions found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>

