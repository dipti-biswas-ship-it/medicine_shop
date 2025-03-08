
<?php
include("../includes/db.php");
include 'nav.php';

if(isset($_POST['submit']) && isset($_POST['submit']) != null) {
    
    $m_name = mysqli_real_escape_string($con, $_POST['m_name']);
    $m_category = mysqli_real_escape_string($con, $_POST['m_category']);
    $mrp = mysqli_real_escape_string($con, $_POST['mrp']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $qty = mysqli_real_escape_string($con, $_POST['qty']);
    $sort_description = mysqli_real_escape_string($con, $_POST['sort_description']);
    $added_on = mysqli_real_escape_string($con, $_POST['added_on']);
    $expiryDate = mysqli_real_escape_string($con, $_POST['expiryDate']);
    $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../img/product/' .$image);

    // Check if the medicine already exists
    $sql = "SELECT * FROM medicine WHERE m_name = '$m_name'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // If medicine exists, update the record
        $sqls = "UPDATE `medicine` SET 
                 `qty` = '$qty',
                 `added_on` = '$added_on',
                 `expiryDate` = '$expiryDate',
                 `status` = 0 
                 WHERE m_name = '$m_name'";
        mysqli_query($con, $sqls);
    } else {
        // If medicine does not exist, insert new record
        $query = "INSERT INTO `medicine`(`m_name`, `m_category`, `mrp`, `price`, `description`, `qty`, `sort_description`, `added_on`, `expiryDate`, `status`,`image`) 
                  VALUES ('$m_name', '$m_category', '$mrp', '$price', '$description', '$qty', '$sort_description', '$added_on', '$expiryDate', 0,'$image')";
        mysqli_query($con, $query);
    }

    header("Location: product.php");
    exit();
}
?>


<div class="main-content">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Upload Medicine</h2>
            <form  method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="m_name" class="form-label">Medicine Name</label>
                    <input type="text" class="form-control" id="m_name" name="m_name" required>
                </div>
                <div class="mb-3">
                    <label for="m_category" class="form-label">Category</label>
                    <select class="form-select" id="m_category" name="m_category" required>
                        <option value="">Select Category</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Syrup">Syrup</option>
                        <option value="Injection">Injection</option>
                        <option value="Capsule">Capsule</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mrp" class="form-label">MRP</label>
                    <input type="number" class="form-control" id="mrp" name="mrp" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="qty" name="qty" required>
                </div>
                <div class="mb-3">
                    <label for="sort_description" class="form-label">Short Description</label>
                    <textarea class="form-control" id="sort_description" name="sort_description" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="added_on" class="form-label">Added On</label>
                    <input type="date" class="form-control" id="added_on" name="added_on" required>
                </div>
           
                <div class="mb-3">
                    <label for="image" class="form-label">Medicine Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="expiryDate" class="form-label">Expiration Date</label>
                    <input type="date" class="form-control" id="expiryDate" name="expiryDate" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="submit">Upload Medicine</button>
            </form>
        </div>
    </div>
</div>