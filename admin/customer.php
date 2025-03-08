
<?php
require ('connect.php');
include 'nav.php';

if(isset($_GET['type']) && $_GET['type']!='' ){
    $type=$_GET['type'];
     if($type=='delete')
     {
       $id=$_GET['u_id']; 
       $delete_sql=("delete from users where u_id='$id'");
       mysqli_query($con,$delete_sql);
     }
  }
$sql="SELECT * FROM users";
$res=mysqli_query($con,$sql);


?>


   
        <!-- Page Content -->
        <div class="main-content">
            <div class="container mt-4">
                <h3>All Users</h3>

                <!-- Filters -->
                <div class="row mb-5">
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                            <select class="form-select" id="category-filter">
                                <option>Coustomer_Name</option>
                            </select>
                        </div>
                    </div>
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                                <select class="form-select" id="status-filter">
                                    <option>Coustomer_Email</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                <select class="form-select" id="price-filter">
                                    <option>Price</option>
                                </select>
                            </div>
                        </div> -->
                    
                    
                </div>
                <hr>

                <!-- Users Table -->
                <div style="max-height: 380px; overflow-y: auto;">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
      
                            <th>Delete</th>

                        </tr>
                    </thead>
                        

                        <?php 
                        while($row=mysqli_fetch_assoc($res))
                    
                        {?>
                        <tbody id="users-listt">
                           <td><?php echo $row['u_id'] ?></td>
                           <td><?php echo $row['u_name'] ?></td>
                           <td><?php echo $row['email'] ?></td>
                           <td><?php echo $row['phone'] ?></td>
                           
                           <td>
                            <?php 
                            echo "<span class='t-op-nextlvl label-tag' class='badge  badge-delete'><button type='button'class='btn btn-danger' style='color:black;'>
                            <a href='?type=delete&u_id=".$row['u_id'].
                            "'style='color:black'>Delete</a></button></span>";
                                         
                            ?>
                          </td>
                          </tbody>
                         <?php } ?>
                       
                </table>
                </div>
            </div>
      
    </div>