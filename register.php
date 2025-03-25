<?php
$conn = mysqli_connect("localhost", "root", "", "gallerycafe");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo '<!DOCTYPE html><html><head><title>Registration Error</title></head><body>';
        echo '<script>alert("Passwords do not match."); window.location.href = "password.php";</script>';
        echo '</body></html>';
        exit();
    }

    // Insert the new user into the database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        // Successful registration
        echo '<!DOCTYPE html><html><head><title>Registration Success</title></head><body>';
        echo '<script>alert("Registration successful!"); window.location.href = "userhome.php";</script>';
        echo '</body></html>';
    } else {
        echo '<!DOCTYPE html><html><head><title>Registration Error</title></head><body>';
        echo '<script>alert("ERROR: Could not execute the query."); window.location.href = "password.php";</script>';
        echo '</body></html>';
    }

    mysqli_close($conn);
} else {
    header("Location: index.php");
    exit();
}
?>
