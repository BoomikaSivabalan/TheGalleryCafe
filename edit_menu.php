<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gallerycafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Fetch the menu item data to populate the form
$sql = "SELECT * FROM menu WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $menu_item = $result->fetch_assoc();
} else {
    die("Menu item not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $cuisine_type = $_POST['cuisine_type'];
    $price = $_POST['price'];
    $menudes = $_POST['menudes'];  // Get the menu description from the form

    // Update image if a new one is uploaded
    if ($_FILES['image']['name']) {
        $target_dir = "menu_images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Include the image in the update query
        $sql = "UPDATE menu SET name=?, cuisine_type=?, price=?, menudes=?, image_url=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsdi", $name, $cuisine_type, $price, $menudes, $target_file, $id);
    } else {
        // No image change, just update other fields
        $sql = "UPDATE menu SET name=?, cuisine_type=?, price=?, menudes=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $name, $cuisine_type, $price, $menudes, $id);
    }

    if ($stmt->execute()) {
        echo '<script>alert("Menu item updated successfully!"); window.location.href = "admin_manage_menu.php";</script>';
        exit;
    } else {
        echo "Error updating menu item.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 10px;
        }
        header {
            background-color: #35424a;
            color: white;
            text-align: center;
            padding: 40px 0 10px;
            font-size: 40px;
            height:80px;
            font-weight:bold;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 28px;
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
        input[type="number"],
        select,
        input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
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
        input[type="submit"]:hover {
            background-color: #2c3e50;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        
        footer{
          font-weight: bold;
        }

        a{
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
           
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    Edit Menu Item
</header>


    <a href="admin_manage_menu.php">Back to Dashboard</a>
    
<div class="container">

    <h1>Edit Menu Item Details</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($menu_item['name']); ?>" required>

        <label for="cuisine_type">Cuisine Type:</label>
        <select id="cuisine_type" name="cuisine_type" required>
            <option value="Italian" <?php if ($menu_item['cuisine_type'] == 'Italian') echo 'selected'; ?>>Italian</option>
            <option value="Chinese" <?php if ($menu_item['cuisine_type'] == 'Chinese') echo 'selected'; ?>>Chinese</option>
            <option value="Sri Lankan" <?php if ($menu_item['cuisine_type'] == 'Sri Lankan') echo 'selected'; ?>>Sri Lankan</option>
            <option value="Indian" <?php if ($menu_item['cuisine_type'] == 'Indian') echo 'selected'; ?>>Indian</option>
            <option value="Beverage" <?php if ($menu_item['cuisine_type'] == 'Beverage') echo 'selected'; ?>>Beverages</option>
            <option value="Special" <?php if ($menu_item['cuisine_type'] == 'Special') echo 'selected'; ?>>Special</option>
        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($menu_item['price']); ?>" step="0.01" required>

        <label for="menudes">Menu Description:</label>
        <input type="text" id="menudes" name="menudes" value="<?php echo htmlspecialchars($menu_item['menudes']); ?>" required>

        <label for="image">Menu Item Image (leave blank to keep current image):</label>
        <input type="file" id="image" name="image">

        <input type="submit" value="Update Menu Item">
    </form>

</div>

<footer>
    &copy; 2024 Gallery Cafe. All rights reserved.
</footer>

</body>
</html>
