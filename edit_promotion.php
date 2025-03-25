<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gallerycafe");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Fetch the promotion data to populate the form
$sql = "SELECT * FROM promotions WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $promotion = $result->fetch_assoc();
} else {
    die("Promotion not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heading = $_POST['heading'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Update image if a new one is uploaded
    if ($_FILES['image']['name']) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Include the image in the update query
        $sql = "UPDATE promotions SET heading=?, description=?, start_date=?, end_date=?, image_url=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $heading, $description, $start_date, $end_date, $target_file, $id);
    } else {
        // No image change, just update other fields
        $sql = "UPDATE promotions SET heading=?, description=?, start_date=?, end_date=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $heading, $description, $start_date, $end_date, $id);
    }

    if ($stmt->execute()) {
        echo "Promotion updated successfully!";
        header("Location: admin_list_promotions.php");
        exit;
    } else {
        echo "Error updating promotion.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Promotion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 10px;
        }
        header {
            background: #343a40;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            margin-bottom: 10px;
            height: 70px;
        }
        h1 {
            margin: 0;
            font-size: 40px;
        }
        form {
            background: #ffffff;
            padding: 10px 40px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: auto;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="date"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        
        a {
            color: #007bff;
            text-decoration: none;
            margin-bottom: 15px;
            display: inline-block;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<header>
    <h1>Edit Promotion</h1>
</header>


    <a href="admin_list_promotion.php">Back to Dashboard</a>
    <br>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="heading">Heading:</label>
    <input type="text" id="heading" name="heading" value="<?php echo htmlspecialchars($promotion['heading']); ?>" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo htmlspecialchars($promotion['description']); ?></textarea>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $promotion['start_date']; ?>" required>

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo $promotion['end_date']; ?>" required>

    <label for="image">Promotion Image (leave blank to keep current image):</label>
    <input type="file" id="image" name="image">

    <input type="submit" value="Update Promotion">
</form>


</body>
</html>
