<?php
include("../includes/db.php"); // Ensure database connection
include 'nav.php';

// Check if order ID is provided
if (!isset($_GET['o_id']) || empty($_GET['o_id'])) {
    echo "<script>alert('Invalid Order ID'); window.location.href='order.php';</script>";
    exit();
}

$o_id = intval($_GET['o_id']);

// Fetch order details
$query = "SELECT * FROM orders WHERE o_id = $o_id";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Order not found'); window.location.href='order.php';</script>";
    exit();
}

$order = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $pin = intval($_POST['pin']);
    $total_price = floatval($_POST['total_price']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['o_email']);
    $full_address = mysqli_real_escape_string($con, $_POST['full_address']);

    // Update the order
    $update_query = "UPDATE orders SET 
        name='$name', city='$city', state='$state', pin='$pin', 
        total_price='$total_price', status='$status', 
        phone='$phone', o_email='$email', full_address='$full_address' 
        WHERE o_id = $o_id";

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Order updated successfully!'); window.location.href='order.php';</script>";
    } else {
        echo "<script>alert('Error updating order: " . mysqli_error($con) . "');</script>";
    }
}

?>


<div class="main-content">
    <div class="container mt-5">
        <h2 class="mb-4">Edit Order</h2>
        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($order['name']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($order['phone']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name="city" value="<?php echo htmlspecialchars($order['city']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">State</label>
                    <input type="text" class="form-control" name="state" value="<?php echo htmlspecialchars($order['state']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pin</label>
                    <input type="number" class="form-control" name="pin" value="<?php echo htmlspecialchars($order['pin']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Total Price</label>
                    <input type="number" step="0.01" class="form-control" name="total_price" value="<?php echo htmlspecialchars($order['total_price']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="o_email" value="<?php echo htmlspecialchars($order['o_email']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" name="status" required>
                        <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Processing" <?php if ($order['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                        <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                        <option value="Delivered" <?php if ($order['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                        <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Full Address</label>
                <textarea class="form-control" name="full_address" rows="3" required><?php echo htmlspecialchars($order['full_address']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-success text-dark">Update Order</button>
            <a href="order.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div></div>
