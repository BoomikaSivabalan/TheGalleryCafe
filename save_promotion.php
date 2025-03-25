<?php
// Database connection settings
$conn = new mysqli("localhost","root", "", "gallerycafe");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$heading = $_POST['heading'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

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
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
if (!in_array($imageFileType, $allowed_types)) {
    die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
}

// Move the uploaded file to the desired location
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    die("Sorry, there was an error uploading your file.");
}

// Insert the promotion data into the database
$sql = "INSERT INTO promotions (heading, description, start_date, end_date, image_url) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $heading, $description, $start_date, $end_date, $target_file);

if ($stmt->execute()) {
    echo "<script>
            alert('New promotion added successfully.');
            window.location.href = 'admin_add_promotion.php';
          </script>";
} else {
    echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'admin_add_promotion.php';
          </script>";
}

// Close the connection
$conn->close();
?>
