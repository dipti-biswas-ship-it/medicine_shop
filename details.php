<?php
include('includes/db.php');
include 'navbar.php';
// Get the medicine ID from the URL
if (isset($_GET['id'])) {
    $m_id = $_GET['id'];

    // Fetch medicine details
    $query = "SELECT * FROM medicine WHERE m_id = '$m_id'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $medicine = $result->fetch_assoc();
    } else {
        die("Medicine not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $medicine['m_name']; ?> Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">


    <!-- Main Container -->
    <div class="container my-5">
        <div class="card shadow-lg p-4">
            <div class="row g-4 align-items-center">
                <!-- Medicine Image -->
                <div class="col-md-5 text-center">
                <img  class="img-fluid rounded shadow" src="<?php echo !empty($medicine['image']) ? 'img/product/' . htmlspecialchars($medicine['image']) : 'img/default.jpg'; ?> " >
                  
                </div>
                
                <!-- Medicine Details -->
                <div class="col-md-7">
                    <h2 class="text-primary"> <?php echo $medicine['m_name']; ?> </h2>
                    <p class="text-muted"> <?php echo $medicine['description']; ?> </p>
                    <p class="fw-bold text-danger"> Expiry Date: <?php echo $medicine['expiryDate']; ?> </p>
                    <p class="fw-semibold">Category: <?php echo $medicine['m_category']; ?></p>
                    <h4 class="text-success">Price: ₹<?php echo $medicine['price']; ?></h4>

                    <!-- Buttons -->
                    <div class="mt-4">
                        <form action="order.php" method="POST" class="d-inline">
                            <input type="hidden" name="m_id" value="<?php echo $medicine['m_id']; ?>">
                            <input type="hidden" name="m_name" value="<?php echo $medicine['m_name']; ?>">
                            <input type="hidden" name="price" value="<?php echo $medicine['price']; ?>">
                            <input type="hidden" name="image" value="<?php echo $medicine['image']; ?>">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">Buy Now</button>
                        </form>
                        <button class="btn btn-outline-secondary btn-lg ms-3 shadow-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Medicines Section -->
        <div class="mt-5">
            <h3 class="text-primary mb-3">Related Medicines</h3>
            <div class="row g-4">
                <?php
                $related_query = "SELECT * FROM medicine WHERE m_category = '{$medicine['m_category']}' AND m_id != '$m_id' LIMIT 6";
                $related_result = $con->query($related_query);

                if ($related_result->num_rows > 0) {
                    while ($related = $related_result->fetch_assoc()) {
                        echo '<div class="col-6 col-md-4 col-lg-2">
                        <div class="card shadow-sm">
                            <a href="details.php?id=' . $related['m_id'] . '">
                               <img src="img/product/' . htmlspecialchars($related['image']) . '" class="card-img-top" alt="Medicine Image">
                                <div class="card-body text-center">
                                    <h6 class="card-title text-primary">' . $related['m_name'] . '</h6>
                                </div>
                            </a>
                        </div>
                    </div>';
                    }
                } else {
                    echo "<p class='text-muted'>No related medicines found.</p>";
                }
                ?>
            </div>
        </div>
    </div>

   
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php 
include 'footer.php';
?>