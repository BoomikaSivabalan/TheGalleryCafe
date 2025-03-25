<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gallerycafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Delete the menu item from the database
$sql = "DELETE FROM menu WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Menu item deleted successfully!";
    header("Location: admin_manage_menu.php");
    exit;
} else {
    echo "Error deleting menu item.";
}

$conn->close();
?>
