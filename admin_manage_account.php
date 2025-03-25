<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "gallerycafe");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Add staff
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_staff'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert staff into database
    $sql = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', 'staff')";
    
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Staff added successfully!"); window.location.href="admin_manage_account.php";</script>';
    } else {
        echo '<script>alert("Failed to add staff.");</script>';
    }
}

// Update staff
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_staff'])) {
    $staff_id = $_POST['staff_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update staff details
    $sql = "UPDATE users SET email='$email', password='$password' WHERE id='$staff_id' AND role='staff'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Staff updated successfully!"); window.location.href="admin_manage_account.php";</script>';
    } else {
        echo '<script>alert("Failed to update staff.");</script>';
    }
}

// Delete staff
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM users WHERE id='$delete_id' AND role='staff'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Staff deleted successfully!"); window.location.href="admin_manage_account.php";</script>';
    } else {
        echo '<script>alert("Failed to delete staff.");</script>';
    }
}

// Search staff by email
$search_email = '';
if (isset($_POST['search'])) {
    $search_email = $_POST['search_email'];
    $sql = "SELECT * FROM users WHERE role='staff' AND email LIKE '%$search_email%'";
} else {
    $sql = "SELECT * FROM users WHERE role='staff'";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff Accounts</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f5;
            padding: 20px;
            margin: 0;
        }
        header {
            text-align: center;
            padding: 10px 0;
            background-color: #35424a;
            color: white;
            font-size: 1.5em;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #343a40;
            text-align: left;
            border-bottom: 2px solid #6c757d;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .button {
            background-color: #17a2b8;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0;
        }
        .button:hover {
            background-color: #138496;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
            margin-right:20px;
        }
        .form-container input {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #6c757d;
            color: white;
        }
        td {
            background-color: #f8f9fa;
        }
        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-right: 10px;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
       
        a{
            text-decoration:none;
        }
        .add-button {
        padding: 10px 15px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        margin: 20px 0;
        display: inline-block;
        }
        .add-button:hover {
        background: #218838;
        }
    </style>
</head>
<body>

<header>
    <h1>Manage Staff Accounts</h1>
</header>

<a class="add-button" href="admin_panel.php">Back to Dashboard</a>

<div class="container">

    <h2>Add New Staff</h2>
    <div class="form-container">
        <form action="admin_manage_account.php" method="POST">
            <input type="email" name="email" placeholder="Staff Email" required>
            <input type="password" name="password" placeholder="Staff Password" required>
            <button class="button" type="submit" name="add_staff">Add Staff</button>
        </form>
    </div>

    <div class="search-container">
        <form action="admin_manage_account.php" method="POST">
            <input type="text" name="search_email" value="<?php echo htmlspecialchars($search_email); ?>" placeholder="Enter email to search">
            <button class="button" type="submit" name="search">Search</button>
        </form>
    </div>

    <h2>Current Staff Members</h2>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($staff = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($staff['email']); ?></td>
                <td>
                    <div class="action-buttons">
                        <!-- Edit form -->
                        <form action="admin_manage_account.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="staff_id" value="<?php echo $staff['id']; ?>">
                            <input type="email" name="email" value="<?php echo htmlspecialchars($staff['email']); ?>" required>
                            <input type="password" name="password" placeholder="New Password" required>
                            <button style="margin-left:10px;" class="button" type="submit" name="edit_staff">Edit</button>
                        </form>

                        <!-- Delete button -->
                        <a style="padding: 6px 8px 2px 8px; font-size:14px; " class="button" href="admin_manage_account.php?delete_id=<?php echo $staff['id']; ?>" onclick="return confirm('Are you sure you want to delete this staff member?');">Delete</a>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

</body>
</html>

<?php mysqli_close($conn); ?>
