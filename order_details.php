<?php
include 'navbar.php';

include('includes/db.php'); 

$user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;

if ($user_id == 0) {
    die("User not logged in.");
}

// Fetch ordered medicines
$sql = "SELECT o.o_id, o.m_id, o.name, o.city, o.state, o.pin, o.total_price, o.status, 
               o.land_mark, o.house_no, o.phone, o.o_email, o.full_address, 
               m.m_name AS product_name, m.qty, m.image AS product_image
        FROM orders o
        JOIN medicine m ON o.m_id = m.m_id"; 

$result = mysqli_query($con, $sql);

// Initialize subtotal
$subtotal = 0;
?>



    

<div class="containers">
    <h2 class="text-center mb-4">Order Details</h2>
    
    <table class="table table-bordered">
        <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            $subtotal += $row['total_price']; // Calculate subtotal
        ?>
        <tr>
            <td><img src="img/product/<?php echo htmlspecialchars($row['product_image']); ?>" alt="Product Image"></td>
            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
            <td><?php echo htmlspecialchars($row['qty']); ?></td>
            <td>₹<?php echo htmlspecialchars($row['total_price']); ?></td>
        </tr>
        <?php } ?>
    </table>

    <?php
    // Define charges
    $shipping_fee = 50; // Fixed shipping fee
    $tax = $subtotal * 0.05; // 5% tax
    $total = $subtotal + $shipping_fee + $tax;
    ?>

    <div class="summary">
        <p><strong>Subtotal:</strong> ₹<?php echo number_format($subtotal, 2); ?></p>
        <p><strong>Shipping Fee:</strong> ₹<?php echo number_format($shipping_fee, 2); ?></p>
        <p><strong>Tax (5%):</strong> ₹<?php echo number_format($tax, 2); ?></p>
        <p><strong>Total:</strong> ₹<?php echo number_format($total, 2); ?></p>
    </div>
</div>


<style>
        .containers {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
       td img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }
        .summary {
            margin-top: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 18px;
        }
        .summary p {
            margin: 8px 0;
        }
        .summary strong {
            color: #333;
        }
    </style> 
