<?php
// Database connection settings
$conn = new mysqli("localhost", "root", "", "gallerycafe");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name = $_POST['name'];
$cuisine_type = $_POST['cuisine_type']; 
$menudes = $_POST['menudes'];
$price = $_POST['price'];

// Handle image upload
$target_dir = "images/"; // Directory where images will be saved
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image is a valid image file
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
    die("File is not an image.");
}

// Allow certain file formats (JPEG, PNG, GIF)
$allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
if (!in_array($imageFileType, $allowed_types)) {
    die("Sorry, only JPG, JPEG, WEBP, PNG & GIF files are allowed.");
}

// Move the uploaded file to the desired location
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    die("Sorry, there was an error uploading your file.");
}

// Insert the menu item data into the database
$sql = "INSERT INTO menu (name, cuisine_type, price, menudes, image_url) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdss", $name, $cuisine_type, $price, $menudes, $target_file);

if ($stmt->execute()) {
    echo "<script>
            alert('New menu added successfully.');
            window.location.href = 'admin_add_menu.php';
          </script>";
} else {
    echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'admin_add_menu.php';
          </script>";
}

// Close the connection
$conn->close();
?>



