<?php
include("nav.php");
include("../includes/db.php");


if (!isset($_SESSION['ADMIN_ID'])) {
    die("Error: Admin ID is not set.");
}

$admin_id = $_SESSION['ADMIN_ID'];
$sql="SELECT * FROM admin where id=$admin_id";
$result = mysqli_query($con, $sql);
?>



<div class="main-content">

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <h4>Profile</h4>
                </div>
            </nav>

            <div class="container mt-4">
                <div class="card profile-card">
                    <div class="card-body text-center position-relative">
                        <!-- Profile Image with Edit Icon -->
                        <div class="profile-image-container">
                            <img id="profile-img" src="../img/profile.webp"height="120" width="120" class="rounded-circle profile-img" alt="Profile Picture">
                        </div>
                

                        <?php while($row=mysqli_fetch_assoc($result))
                        {?>
                  
                        <h4  class="mt-3"><?php echo $row['username'] ?></h4>
                        <p><?php echo $row['email'] ?></p>
                        <p class="text-muted">Admin</p>
                        <?php } ?>
                        <button class="btn btn-primary mt-3" id="edit-profile"><i class="fas fa-user-edit"></i> Edit Profile</button>
                    </div>
                </div>
                
               
                <!-- Font Awesome Icons -->
                <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
                
            </div>
        </div>
    </div>
