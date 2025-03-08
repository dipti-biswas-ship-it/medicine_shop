<?php
include('navbar.php');
include('includes/db.php');

if (!isset($_SESSION['uid'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

$u_id =$_SESSION['uid'];

$query = "SELECT c.cart_id, c.quantity, m.m_id, m.m_name, m.price, m.image 
          FROM cart c
          INNER JOIN medicine m ON c.m_id = m.m_id
          WHERE c.u_id = ?";

$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $u_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$cartItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-table img {
            width: 60px;
            border-radius: 5px;
        }
        .quantity-buttons button {
            border: none;
            background: #007bff;
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }
        .quantity-buttons button:hover {
            background: #0056b3;
        }
        .remove-btn {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .remove-btn:hover {
            background: #c82333;
        }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="cart-container">
    <h2 class="text-center text-primary">🛒 Your Shopping Cart</h2>
    
    <table class="table cart-table">
        <thead class="table-primary">
            <tr>
                <th>Image</th>
                <th>Medicine</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item) { ?>
            <tr id="cartItem-<?php echo $item['cart_id']; ?>">
                <td><img src="img/product/<?php echo $item['image']; ?>" alt="Medicine"></td>
                <td><?php echo $item['m_name']; ?></td>
                <td class="price">₹<?php echo $item['price']; ?></td>
                <td class="quantity-buttons">
                    <button class="decreaseQty btn btn-sm btn-outline-primary" data-cart-id="<?php echo $item['cart_id']; ?>">−</button>
                    <span class="quantity px-2"><?php echo $item['quantity']; ?></span>
                    <button class="increaseQty btn btn-sm btn-outline-primary" data-cart-id="<?php echo $item['cart_id']; ?>">+</button>
                </td>
                <td class="totalPrice">₹<?php echo $item['price'] * $item['quantity']; ?></td>
                <td>
                    <button class="removeItem remove-btn" data-cart-id="<?php echo $item['cart_id']; ?>">Remove</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <h4 class="text-end">Total Cart Amount: ₹<span id="cartTotal">0</span></h4>

    <div class="text-center mt-3">
        <a href="medicine.php" class="btn btn-secondary">⬅ Continue Shopping</a>
        <button class="btn btn-success">Proceed to Checkout</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        updateCartTotal();

        $(".increaseQty, .decreaseQty").click(function() {
            let cartId = $(this).data("cart-id");
            let action = $(this).hasClass("increaseQty") ? "increase" : "decrease";
            let $row = $("#cartItem-" + cartId);
            let $quantitySpan = $row.find(".quantity");
            let $totalPriceCell = $row.find(".totalPrice");
            let price = parseFloat($row.find(".price").text().replace("₹", ""));
            let currentQuantity = parseInt($quantitySpan.text());

            if (action === "increase") {
                currentQuantity++;
            } else if (action === "decrease" && currentQuantity > 1) {
                currentQuantity--;
            }

            $.ajax({
                url: "update_cart.php",
                type: "POST",
                data: { cart_id: cartId, quantity: currentQuantity },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.success) {
                        $quantitySpan.text(currentQuantity);
                        $totalPriceCell.text("₹" + (price * currentQuantity).toFixed(2));
                        updateCartTotal();
                    }
                }
            });
        });

        $(".removeItem").click(function() {
            let cartId = $(this).data("cart-id");
            let $row = $("#cartItem-" + cartId);

            $.ajax({
                url: "remove_from_cart.php",
                type: "POST",
                data: { cart_id: cartId },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.success) {
                        $row.fadeOut(300, function() {
                            $(this).remove();
                            updateCartTotal();
                        });
                    }
                }
            });
        });

        function updateCartTotal() {
            let total = 0;
            $(".totalPrice").each(function() {
                total += parseFloat($(this).text().replace("₹", ""));
            });
            $("#cartTotal").text(total.toFixed(2));
        }
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
