<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Promotion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        body {
            font-family: 'Segoe UI',Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 10px;
        }
       
        form {
            background: #ffffff;
            padding: 9px 40px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
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
        header {
            background: #35424a;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            height: 80px;
            margin-bottom:10px;
            
        }

        footer{
          font-weight: bold;
        }

        a{
            display: inline-block;
            margin-top: 10px;
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
<h1>Add a New Promotion</h1>
</header>

<footer>
    <a href="admin_list_promotions.php">Back to Dashboard</a>
    </footer><br>
<!-- Form to add a new promotion -->
<form action="save_promotion.php" method="POST" enctype="multipart/form-data">
    <label for="heading">Heading:</label>
    <input type="text" id="heading" name="heading" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>

    <label for="image">Promotion Image:</label>
    <input type="file" id="image" name="image" required>

    <input type="submit" value="Add Promotion">
</form>

</body>
</html>
