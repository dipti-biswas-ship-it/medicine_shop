<?php
include("../includes/db.php");
include("nav.php");

$sql = "SELECT * FROM medicine";
$result = mysqli_query($con, $sql);
?>

<div class="main-content">
    <div class="container mt-4">
        <h3>All Products</h3>

        <!-- Filters -->
        <div class="row mb-5">
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                    <select class="form-select" id="category-filter">
                        <option>Category</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-clipboard-check"></i></span>
                    <select class="form-select" id="status-filter">
                        <option>Stock Status</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    <select class="form-select" id="price-filter">
                        <option>Price</option>
                    </select>
                </div>
            </div>
            <div class="col">
               <a href="add_medicine.php"> <button class="btn btn-success w-100" style="background-color: blue;">
                    <i class="fas fa-plus"></i> Add Products
                </button></a>
            </div>
        </div>
        <hr>

        <!-- Products Table -->
        <div style="max-height: 380px; overflow-y: auto;">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#Product ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="products-lists">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['m_id']; ?></td>
                            <td><img src="../img/product/<?php echo htmlspecialchars($row['image']); ?>" 
                            alt="Product Image" style="height:60px;height: 60px;width: 60px;object-fit: cover;"></td>
                            <td><?php echo $row['m_name']; ?></td>
                            <td><?php echo $row['m_category']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td>
                                

                                <a href="manage_product.php?m_id=<?php echo $row['m_id']; ?>" class="btn btn-warning">
        <i class="fas fa-edit"></i> 
    </a>
    <a href="delete_product.php?m_id=<?php echo $row['m_id']; ?>" class="btn btn-danger" 
       onclick="return confirm('Are you sure you want to delete this order?');">
        <i class="fas fa-trash-alt"></i> 
    </a>


                                
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
