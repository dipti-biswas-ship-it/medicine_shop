<?php

include('includes/db.php');
include 'navbar.php';
$sql = "SELECT * FROM medicine"; 
$result = mysqli_query($con, $sql);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<section class="slider">
    <div class="hero-slider">
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('img/signup-bg.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>Your Trusted <span>Pharmacy</span> for Quality <span>Medicines!</span></h1>
                            <p>We provide authentic medicines, health supplements, and expert guidance for your well-being.</p>
                            <div class="button">
                                <a href="#" class="btn">Shop Now</a>
                                <a href="#" class="btn primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('img/signup-bg.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>Get Your <span>Prescriptions</span> Filled with <span>Ease!</span></h1>
                            <p>Order online or visit our pharmacy for fast and reliable service.</p>
                            <div class="button">
                                <a href="#" class="btn">Order Now</a>
                                <a href="#" class="btn primary">About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('img/signup-bg.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>Fast & Reliable <span>Medicine</span> Home Delivery!</h1>
                            <p>Get your medications delivered to your doorstep with our hassle-free service.</p>
                            <div class="button">
                                <a href="#" class="btn">Shop Now</a>
                                <a href="#" class="btn primary">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
    </div>
</section>
<!--/ End Slider Area -->

<!-- cards -->



 <!-- card finish -->
		<main class="max-w-7xl mx-auto p-4">

       
        <section class="mt-8">
    <h2 class="text-xl font-semibold mb-4 text-blue-800">Medicine List</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <a href="details.php?id=<?php echo $row['m_id']; ?>" class="block">
            <div class="bg-white shadow-md rounded-lg p-4 text-center border border-blue-100 hover:shadow-lg transition-shadow">
                <img src="<?php echo !empty($row['image']) ? 'img/product/' . htmlspecialchars($row['image']) : 'img/default.jpg'; ?>" 
                     alt="<?php echo htmlspecialchars($row['m_name']); ?>" 
                     class="w-full h-32 md:h-40 object-cover rounded-t-lg mb-2"
                     onerror="this.onerror=null;this.src='img/default.jpg';">
                <h3 class="font-bold text-blue-600"><?php echo htmlspecialchars($row['m_name']); ?></h3>
                <p class="text-gray-600"><?php echo htmlspecialchars($row['description']); ?></p>
                <p class="font-semibold text-blue-700">₹<?php echo number_format($row['price'], 2); ?></p>
                <button class="mt-2 bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition">Buy Now</button>
                <button class="mt-2 bg-blue-100 text-blue-600 rounded-lg px-4 py-2 hover:bg-blue-200 transition add-to-cart" 
        data-m_id="<?php echo $row['m_id']; ?>">
    Add to Cart
</button>            </div>
</a>
        <?php } ?>
    </div>
</section>
<!--/ End service -->

		
		<!-- Pricing Table -->
<section class="pricing-table section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Affordable Medicines at the Best Prices</h2>
                    <img src="img/section-img.png" alt="#">
                    <p>We offer a variety of essential medicines at competitive prices to support your health.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Single Table -->
            <div class="col-lg-4 col-md-12 col-12">
                <div class="single-table">
                    <!-- Table Head -->
                    <div class="table-head">
                        <div class="icon">
                            <i class="icofont icofont-prescription"></i>
                        </div>
                        <h4 class="title">Prescription Medicines</h4>
                        <div class="price">
                            <p class="amount">Varies<span>/ Per Prescription</span></p>
                        </div>    
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li><i class="icofont icofont-ui-check"></i>Authentic medications</li>
                        <li><i class="icofont icofont-ui-check"></i>Certified pharmacy</li>
                        <li><i class="icofont icofont-ui-check"></i>Doctor consultation available</li>
                    </ul>
                    <div class="table-bottom">
                        <a class="btn" href="#">Order Now</a>
                    </div>
                    <!-- Table Bottom -->
                </div>
            </div>
            <!-- End Single Table-->
            <!-- Single Table -->
            <div class="col-lg-4 col-md-12 col-12">
                <div class="single-table">
                    <!-- Table Head -->
                    <div class="table-head">
                        <div class="icon">
                            <i class="icofont icofont-capsule"></i>
                        </div>
                        <h4 class="title">Vitamins & Supplements</h4>
                        <div class="price">
                            <p class="amount">$25<span>/ Per Bottle</span></p>
                        </div>    
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li><i class="icofont icofont-ui-check"></i>Boosts immunity</li>
                        <li><i class="icofont icofont-ui-check"></i>High-quality ingredients</li>
                        <li><i class="icofont icofont-ui-check"></i>Doctor-approved</li>
                    </ul>
                    <div class="table-bottom">
                        <a class="btn" href="#">Order Now</a>
                    </div>
                    <!-- Table Bottom -->
                </div>
            </div>
            <!-- End Single Table-->
            <!-- Single Table -->
            <div class="col-lg-4 col-md-12 col-12">
                <div class="single-table">
                    <!-- Table Head -->
                    <div class="table-head">
                        <div class="icon">
                            <i class="icofont icofont-prescription"></i>
                        </div>
                        <h4 class="title">Prescription Medicines</h4>
                        <div class="price">
                            <p class="amount">Varies<span>/ Per Prescription</span></p>
                        </div>    
                    </div>
                    <!-- Table List -->
                    <ul class="table-list">
                        <li><i class="icofont icofont-ui-check"></i>Authentic medications</li>
                        <li><i class="icofont icofont-ui-check"></i>Certified pharmacy</li>
                        <li><i class="icofont icofont-ui-check"></i>Doctor consultation available</li>
                    </ul>
                    <div class="table-bottom">
                        <a class="btn" href="#">Order Now</a>
                    </div>
                    <!-- Table Bottom -->
                </div>
            </div>
            <!-- End Single Table-->
        </div>    
    </div>    
</section>    
<!--/ End Pricing Table -->
<?php
include 'footer.php'

?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".add-to-cart").forEach(button => {
            button.addEventListener("click", function () {
                let m_id = this.getAttribute("data-m_id"); // Get medicine ID
                let u_id = "<?php echo $_SESSION['uid']  ?? ''; ?>"; // Get user ID (from PHP session)

                if (!u_id) {
                    alert("Please log in to add items to the cart.");
                    window.location.href = "login.php";
                    return;
                }

                let formData = new FormData();
                formData.append("m_id", m_id);
                formData.append("u_id", u_id);

                console.log("Sending data:", { m_id, u_id });

                fetch("add_to_cart.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Response from server:", data); // Debugging

                    if (data.success) {
                        alert("Added to cart successfully!");
                    } else {
                        alert("Failed to add to cart: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>
