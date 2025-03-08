<?php
session_start();
include('includes/db.php'); // Ensure this is correct

header('Content-Type: application/json');

if (!isset($_SESSION['uid'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $m_id = $_POST['m_id'] ?? null;
    $u_id = $_SESSION['uid'];

    if (!$m_id) {
        echo json_encode(['success' => false, 'message' => 'Medicine ID missing']);
        exit;
    }

    // Check if item already exists in cart
    $checkQuery = "SELECT * FROM cart WHERE m_id = ? AND u_id = ?";
    $stmt = mysqli_prepare($con, $checkQuery);
    mysqli_stmt_bind_param($stmt, "ii", $m_id, $u_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Item already in cart']);
        exit;
    }

    // Insert into cart
    $query = "INSERT INTO cart (m_id, u_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ii", $m_id, $u_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Item added to cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
}
?>
