<?php
include 'navbar.php';

include('includes/db.php');  // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    
    $m_id = $_POST["m_id"];
    $m_name = $_POST["m_name"];
    $price = $_POST["price"];
    $image = $_POST["image"];
} else {
    die("Invalid access!");
}

$user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;

if ($user_id == 0) {
    die("User not logged in.");
}

$user_address = null;

// Fetch user's saved address if available
if ($user_id) {
    $stmt = $con->prepare("SELECT u_name, phone, email, address, state, landmark, flat_house_no, pin_no FROM users WHERE u_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_address = $result->fetch_assoc();
    $stmt->close();
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Medicine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function updateTotal() {
            let price = parseFloat(document.getElementById('price_val').innerText);
            let quantity = parseInt(document.getElementById('quantity').value);
            let total = price * quantity;
            document.getElementById('total').innerText = "RS " + total.toFixed(2);
            document.getElementById('final_total').value = total;
            document.getElementById('final_quantity').value = quantity; // Store quantity
        }
    </script>
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="card shadow-lg p-4">
            <div class="row g-4 align-items-center">
                <!-- Medicine Image -->
                <div class="col-md-4 text-center">
                    <img src="img/product/<?php echo $image; ?>" class="img-fluid rounded shadow" alt="Medicine Image">
                </div>

                <!-- Medicine Details -->
                <div class="col-md-8">
                    <h2 class="text-primary"><?php echo $m_name; ?></h2>
                    <p class="fw-bold">Price: RS <span id="price_val"><?php echo $price; ?></span></p>
                    <input type="hidden" id="price" value="<?php echo $price; ?>">

                    <!-- Quantity Selection -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Quantity:</label>
                        <input type="number" id="quantity" name="quantity_display" value="1" min="1" class="form-control w-25" onchange="updateTotal()">
                    </div>

                    <!-- Total Price -->
                    <div class="h4">
                        Total: <span id="total">RS <?php echo $price; ?></span>
                    </div>
                </div>
            </div>

            <!-- User Shipping Details -->
            <form action="confirm_order.php" method="POST" class="mt-4">
                <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
                <input type="hidden" name="m_name" value="<?php echo $m_name; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="image" value="<?php echo $image; ?>">
                <input type="hidden" id="final_total" name="total_price" value="<?php echo $price; ?>">
                <input type="hidden" id="final_quantity" name="quantity" value="1"> <!-- Store Quantity -->

                <?php if ($user_address): ?>
    <!-- Display Saved Address -->
    <div class="border p-3 rounded bg-white">
        <h5 class="text-success">Your Saved Address:</h5>
        <p><strong>Name:</strong> <?php echo $user_address['u_name']; ?></p>
        <p><strong>Phone:</strong> <?php echo $user_address['phone']; ?></p>
        <p><strong>Email:</strong> <?php echo $user_address['email']; ?></p>
        <p><strong>Address:</strong> <?php echo $user_address['flat_house_no'] . ", " . $user_address['landmark'] . ", " . $user_address['address'] . ", " . $user_address['state'] . " - " . $user_address['pin_no']; ?></p>

        <input type="hidden" name="name" value="<?php echo $user_address['u_name']; ?>">
        <input type="hidden" name="phone" value="<?php echo $user_address['phone']; ?>">
        <input type="hidden" name="o_email" value="<?php echo $user_address['email']; ?>">
        <input type="hidden" name="state" value="<?php echo $user_address['state']; ?>">
        <input type="hidden" name="pin" value="<?php echo $user_address['pin_no']; ?>">
        <input type="hidden" name="house_no" value="<?php echo $user_address['flat_house_no']; ?>">
        <input type="hidden" name="land_mark" value="<?php echo $user_address['landmark']; ?>">
        <input type="hidden" name="full_address" value="<?php echo $user_address['address']; ?>">
    </div>
<?php else: ?>
    <!-- Show Input Fields if No Address Exists -->
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Full Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Email:</label>
            <input type="email" name="o_email" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">State:</label>
            <input type="text" name="state" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">PIN Code:</label>
            <input type="text" name="pin" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">House No:</label>
            <input type="text" name="house_no" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Landmark:</label>
            <input type="text" name="land_mark" class="form-control" required>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Full Address:</label>
            <textarea name="full_address" class="form-control" required></textarea>
        </div>
    </div>
<?php endif; ?>


                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5 py-2 fw-bold shadow">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<?php include 'footer.php'; ?>
