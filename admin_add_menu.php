<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: 'Segoe UI',Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 10px;
        }
        header {
            background-color: #35424a;
            color: white;
            text-align: center;
            padding: 40px 0 10px;
            font-size: 35px;
            height: 80px;
            font-weight:bold;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #35424a;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #2c3e50;
        }

        footer{
          font-weight: bold;
        }

        a{
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
    Add a New Menu Item
</header>

<footer>
    <a href="admin_manage_menu.php">Back to Dashboard</a>
    </footer>

<div class="container">
    <!-- Form to add a new menu item -->
    <form action="save_menu.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="cuisine_type">Cuisine Type:</label>
        <select id="cuisine_type" name="cuisine_type" required>
            <option value="Italian">Italian</option>
            <option value="Chinese">Chinese</option>
            <option value="Sri Lankan">Sri Lankan</option>
            <option value="Indian">Indian</option>
            <option value="Beverage">Beverages</option>
            <option value="Special">Special</option>
        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="menudes">Menu Description:</label>
        <input type="text" id="menudes" name="menudes" required>

        <label for="image">Menu Item Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <input type="submit" value="Add Menu Item">
    </form>
</div>

</body>
</html>
