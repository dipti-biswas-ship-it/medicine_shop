<?php
session_start();
include("connect.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch user data

        // Store session variables
        $_SESSION['ADMIN_LOGIN'] = 'yes';
        $_SESSION['ADMIN_ID'] = $row['id'];
        $_SESSION['ADMIN_NAME'] = $row['name'];

        header("Location: index.php");
        exit(); // Prevent further execution
    } else {
        $_SESSION['LOGIN_ERROR'] = "Invalid email or password.";
        header("Location: login.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signin</title>
    
</head>
<body>

<div class="container" style="background-color: #0056b391;">
    <h2>Admin Signin</h2>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <button type="submit" name="submit">Signup</button>
    </form>
</div>

</body>
</html>

<style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Signup Form Container */
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Input Fields */
        input[type="email"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Submit Button */
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                width: 90%;
            }
        }
    </style>