<?php
include("../includes/db.php");

if(isset($_GET['m_id'])){
    $m_id = $_GET['m_id']; 
}

// Check if form is submitted
if (isset($_POST['addmedicine'])) {
    $m_name = $_POST['productName'];  
    $price = $_POST['price'];
    $qty = $_POST['quantity']; 

    // Handle image upload
    if (!empty($_FILES['productImage']['name'])) {
        $image = $_FILES['productImage']['name'];
        $target = "../img/product/" . basename($image);
        move_uploaded_file($_FILES['productImage']['tmp_name'], $target);
    } else {
        // If no new image is uploaded, use the existing image
        $image_query = mysqli_query($con, "SELECT image FROM medicine WHERE m_id='$m_id'");
        $image_row = mysqli_fetch_assoc($image_query);
        $image = $image_row['image'];
    }

    // Update query
    $query = "
        UPDATE medicine SET
            m_name = '$m_name',
            image = '$image',
            price = '$price',
            qty = '$qty'
        WHERE m_id='$m_id'
    ";

    if (mysqli_query($con, $query)) {
        echo "Medicine Updated Successfully";
        header("Location: product.php"); // Redirect to product page
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Fetch existing data for pre-filling form
$query = mysqli_query($con, "SELECT * FROM medicine WHERE m_id='$m_id'");
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            background-color: white;
            border-radius: 10px;
        }

        .btn-custom {
            background-color: #6c757d;
            color: white;
            border: none;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background-color: #0dcaf0;
            color: white;
        }
    </style>
</head>
<body>

<div class="container-fluid my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow">
                <div class="card-header text-center bg-info">
                    <h2>Update Product</h2>
                </div>
                <div class="card-body">  
                    <form action="manage_product.php?m_id=<?php echo $m_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="productID">Product ID<span class="text-danger"> *readonly</span></label>                                
                                <input type="text" class="form-control" id="productID" name="productID" value="<?php echo htmlspecialchars($row['m_id']); ?>" readonly>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="productImage" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" onchange="previewImage(event)">
                                <img id="imagePreview" src="../img/product/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" value="<?php echo htmlspecialchars($row['m_name']); ?>" required>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing</option>
                                    <option value="home">Home</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($row['price']); ?>" required readonly>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($row['qty']); ?>" required readonly>
                            </div>

                            <div class="text-start mt-3">
                                <button type="submit" name="addmedicine" class="btn btn-custom btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const img = document.getElementById("imagePreview");
            img.src = reader.result;
            img.style.display = "block";
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>
