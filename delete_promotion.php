<?php


// Database connection
$conn = new mysqli("localhost","root", "", "gallerycafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Delete the promotion from the database
$sql = "DELETE FROM promotions WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Promotion deleted successfully!";
    header("Location: admin_list_promotions.php");
    exit;
} else {
    echo "Error deleting promotion.";
}

$conn->close();
?>
