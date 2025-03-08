<?php session_start(); ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MedicineCare</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #34495e;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }
        .sidebar ul li a:hover {
            background: #34495e;
        }
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            background: #ecf0f1;
            padding: 10px;
            align-items: center;
            border-bottom: 2px solid #bdc3c7;
        }
        .search-bar {
            display: flex;
            align-items: center;
        }
        .search-bar input {
            padding: 5px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            outline: none;
        }
        .search-bar button {
            padding: 5px;
            margin-left: 5px;
            border: none;
            background: #3498db;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }
        .nav-icons {
            display: flex;
            align-items: center;
        }
        .nav-icons i {
            margin-right: 20px;
            font-size: 20px;
            cursor: pointer;
        }
        .profile {
            display: flex;
            align-items: center;
            position: relative;
        }
        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>MedicineCare</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="product.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="order.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="customer.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="navbar">
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="nav-icons">
                <i class="fas fa-bell"></i>
                <div class="profile dropdown">
                    <!-- Profile Image (Dropdown Toggle) -->
                    <img src="../img/profile.webp" alt="Admin Profile" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] == 'yes') { ?>
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content">
            <!-- Content Goes Here -->
        </div>
    </div>

    <!-- Bootstrap & Custom Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
