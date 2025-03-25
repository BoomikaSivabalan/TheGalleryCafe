<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link your main CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            background: #343a40;
            color: #ffffff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        .logout {
            background: #dc3545;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .logout:hover {
            background: #c82333;
        }
        .container {
            padding: 20px;
            display: flex; /* Use flex for horizontal layout */
            justify-content: space-around; /* Space around items */
            flex-wrap: wrap; /* Allow wrapping for responsiveness */
        }
        .card {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1 1 200px; /* Allow cards to grow and shrink */
            margin: 10px; /* Add margin for spacing */
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card i {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 15px;
        }
        .card h2 {
            font-size: 20px;
            margin: 10px 0;
            color: #333;
        }
        .card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        .card a {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .card a:hover {
            background: #0056b3;
        }
        footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            background-color: #e9ecef;
            border-top: 1px solid #dcdcdc;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <a class="logout" href="home.php">Logout</a>
    </header>
    <main>
        <div class="container">
            <div class="card">
                <i class="fas fa-bullhorn"></i>
                <h2>Manage Promotion</h2>
                <p>Manage and add new promotions easily.</p>
                <a href="admin_list_promotions.php">Go to Promotions</a>
            </div>
            <div class="card">
                <i class="fas fa-utensils"></i>
                <h2>Manage Menu</h2>
                <p>Edit and update menu items effortlessly.</p>
                <a href="admin_manage_menu.php">Go to Menu</a>
            </div>
            <div class="card">
                <i class="fas fa-users"></i>
                <h2>Manage Accounts</h2>
                <p>Control user accounts and permissions.</p>
                <a href="admin_manage_account.php">Go to Accounts</a>
            </div>
        </div>
    </main>
    <footer>
        <h3>Welcome to the Admin Panel</h3>
        <p>Select an option from the top to manage your content.</p>
    </footer>
</body>
</html>
