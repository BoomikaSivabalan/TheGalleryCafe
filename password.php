<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
    <style>
        .form {
            width: 400px;
            padding: 10px;
            margin: 0px auto;
        }
        .title {
            text-align: left;
            color: rgb(156, 118, 22);
            font-size: 20px;
            margin: 10px 0px 20px 0px;
        }
        .form label {
            font-weight: bold;
            font-size: 12px;
        }
        .form input {
            width: 100%;
            padding: 10px 3px;
        }
        .form .btn {
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .login-header {
            background-color: rgb(156, 118, 22);
            padding: 20px 100px;
        }
        .login-header h4 {
            color: white;
        }
    </style>
</head>
<body>
    <!-- header -->
    <section class="container-lg login-header">
        <div><h4>The Gallery Cafe</h4></div>
    </section>

    <?php
    $conn = mysqli_connect("localhost", "root", "", "gallerycafe");

    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Check if the email is already in the database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result === false) {
            die("ERROR: Query failed. " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // Email exists, show password entry form
            echo '
            <form class="form" method="POST" action="login.php">
                <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
                <h2 class="title">Enter Your Password</h2>
                <label>Password</label><br>
                <input type="password" name="password" id="password" placeholder="Enter Your Password" required><br><br>
                <input type="submit" name="login" class="btn" value="Login">
            </form>';
        } else {
            // Email does not exist, show password creation form
            echo '
            <form class="form" method="POST" action="register.php">
                <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
                <h2 class="title">Create a New Password</h2>
                <label>New Password</label><br>
                <input type="password" name="password" id="password" placeholder="Enter New Password" required><br><br>
                <label>Confirm Password</label><br>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm New Password" required><br><br>
                <input type="submit" name="register" class="btn" value="Register">
            </form>';
        }

        mysqli_close($conn);
    } else {
        // Redirect back to email page if not POST
        header("Location: index.php");
        exit();
    }
    ?>
</body>
</html>
