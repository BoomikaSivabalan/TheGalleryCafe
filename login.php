<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "gallerycafe");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the email and password match
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        die("ERROR: Query failed. " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Start session and set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        // Redirect based on user role
        if ($user['role'] == 'admin') {
            echo '<script>alert("Admin login successful!"); window.location.href = "admin_panel.php";</script>';
        } elseif ($user['role'] == 'staff') {
            echo '<script>alert("Staff login successful!"); window.location.href = "staff_panel.php";</script>';
        } else {
            // Check if user was redirected to login from the reservation page
            if (isset($_SESSION['redirect_url'])) {
                $redirect_url = $_SESSION['redirect_url'];
                unset($_SESSION['redirect_url']); // Clear the session variable
                header("Location: " . $redirect_url);
            } else {
                // Redirect to the user home page
                echo '<script>alert("Login successful!"); window.location.href = "userhome.php";</script>';
            }
        }
    } else {
        // Invalid credentials
        echo '<script>alert("Invalid email or password."); window.location.href = "login.php";</script>';
    }

    mysqli_close($conn);
} else {
    header("Location: index.php");
    exit();
}
?>
