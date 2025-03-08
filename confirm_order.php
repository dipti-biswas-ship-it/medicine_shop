<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $m_id = $_POST["m_id"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $o_email = $_POST["o_email"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $pin = $_POST["pin"];
    $house_no = $_POST["house_no"];
    $land_mark = $_POST["land_mark"];
    $full_address = $_POST["full_address"];
    $total_price = $_POST["total_price"];
    $quantity = $_POST["quantity"]; // Capture quantity from form
    $u_id = rand(1000, 9999); // Dummy user ID (Replace with actual user ID if logged in)
    $status = "Pending"; // Default status

    // Insert order into database with quantity
    $order_query = "INSERT INTO orders (m_id, u_id, name, city, state, pin, total_price, status, land_mark, house_no, phone, o_email, full_address, quantity) 
                    VALUES ('$m_id', '$u_id', '$name', '$city', '$state', '$pin', '$total_price', '$status', '$land_mark', '$house_no', '$phone', '$o_email', '$full_address', '$quantity')";

    if ($con->query($order_query) === TRUE) {
        echo "<script>alert('Order placed successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
} else {
    die("Invalid Request!");
}
?>
