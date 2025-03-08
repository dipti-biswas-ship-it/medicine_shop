<?php
require('includes/db.php'); // Database connection
require('function.inc.php');

if (!isset($_SESSION['USER_ID'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

$user_id = $_SESSION['USER_ID'];

// Fetch user details
$query = "SELECT u_name, phone, address, state, landmark, flat_house_no, pin_no FROM users WHERE u_id=?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h3 class="text-center text-primary">My Profile</h3>
        <form action="update_profile.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="u_name" class="form-control" value="<?= htmlspecialchars($user['u_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">State</label>
                <input type="text" name="state" class="form-control" value="<?= htmlspecialchars($user['state']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Landmark</label>
                <input type="text" name="landmark" class="form-control" value="<?= htmlspecialchars($user['landmark']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Flat/House No</label>
                <input type="text" name="flat_house_no" class="form-control" value="<?= htmlspecialchars($user['flat_house_no']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Pin Code</label>
                <input type="text" name="pin_no" class="form-control" value="<?= htmlspecialchars($user['pin_no']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
        </form>
    </div>
</div>

</body>
</html>
