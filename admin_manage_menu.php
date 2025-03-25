<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gallerycafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search variable
$search = '';

// Check if a search term has been submitted
if (isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
}

// Query to fetch all menu items with search functionality
$sql = "SELECT id, name, cuisine_type, price, menudes FROM menu 
        WHERE name LIKE '%$search%' OR cuisine_type LIKE '%$search%' OR menudes LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/panel.css"> 
    
</head>
<body>

<header>
    <h1>Manage Menu Items</h1>
</header>

<div class="search-form">
    <form action="" method="POST">
        <input type="text" name="search" placeholder="Search by name, cuisine, or description" value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Search">
    </form>
</div>

<a href="admin_add_menu.php" class="add-button">Add New Menu Item</a>
<a class="add-button" href="admin_panel.php">Back to Dashboard</a>


<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Cuisine Type</th>
        <th>Price</th>
        <th>Menu Description</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["cuisine_type"]) . "</td>";
            echo "<td>$" . htmlspecialchars(number_format($row["price"], 2)) . "</td>";
            echo "<td>" . htmlspecialchars($row["menudes"]) . "</td>";
            echo "<td class='action-buttons'>";
            echo "<a href='edit_menu.php?id=" . $row["id"] . "'>Edit</a> | ";
            echo "<a href='delete_menu.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No menu items found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
