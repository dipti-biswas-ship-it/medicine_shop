<?php
include("../includes/db.php");
include 'nav.php';

    if (isset($_GET['delete'])) {
    $o_id = intval($_GET['delete']); // Convert to integer for security

    // Check if order exists before deleting
    $check_query = "SELECT * FROM orders WHERE o_id = $o_id";
    $check_result = mysqli_query($con, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $delete_query = "DELETE FROM orders WHERE o_id = $o_id";
        
        if (mysqli_query($con, $delete_query)) {
            echo "<script>alert('Order deleted successfully!'); window.location.href='order.php';</script>";
        } else {
            echo "<script>alert('Error deleting order: " . mysqli_error($con) . "');</script>";
        }
    } else {
        echo "<script>alert('Order not found!'); window.location.href='order.php';</script>";
    }
}
$sql = "SELECT * FROM orders";
$result = mysqli_query($con, $sql);



?>

<div class="main-content">
    <div class="container mt-4">
        <h3>All Orders</h3>
        <hr>
        <div style="max-height: 380px; overflow-y: auto;">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Pin</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Full Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tbody id="orders-list">
                    <tr>
                        <td><?php echo $row['o_id']; ?></td>
                        <td><?php echo $row['u_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['city']); ?></td>
                        <td><?php echo htmlspecialchars($row['state']); ?></td>
                        <td><?php echo htmlspecialchars($row['pin']); ?></td>
                        <td><?php echo $row['total_price']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['o_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['full_address']); ?></td>
                        <td style="display: flex;gap: 5px;">
    <a href="edit_order.php?o_id=<?php echo $row['o_id']; ?>" class="btn btn-warning">
        <i class="fas fa-edit"></i> 
    </a>
    <a href="order.php?delete=<?php echo $row['o_id']; ?>" class="btn btn-danger" 
       onclick="return confirm('Are you sure you want to delete this order?');">
        <i class="fas fa-trash-alt"></i> 
    </a>
</td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
        </div>
    </div>
    </div>
