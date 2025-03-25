<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Email</title>
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

    <!-- email form -->
    <form class="form" method="POST" action="password.php">
        <h2 class="title">Enter Your Email Address</h2>
        <label>Email Address</label><br>
        <input type="email" name="email" id="email" placeholder="Enter Your Email Address" required><br><br>
        <input type="submit" name="continue" class="btn" value="Continue with Email">
    </form>
</body>
</html>
