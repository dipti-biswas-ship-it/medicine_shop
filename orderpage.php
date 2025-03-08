<?php
include "navbar.php";	
include("includes/db.php");
$sql="select*from users order by u_id desc";
$res=mysqli_query($con,$sql);
?>
<div class="conntent pd-0">
<div class="orders">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card- body">
<h4 class="box-title">order master </h4>
</div>
<div>
    <div class="dropdown">
   <button onclick="myFunction()"class="dropbtn">short order by</button>
 <div id="myDropdown"class="dropdown-content">
  <input type="text" placeholder="search. ."id="myinput"
  onkeyup="filterFunction()"> 
  
<a href="order.php">Default</a>
<a href="pending-order.php">pending</a>
<a href="processing-order.php">processing</a>
<a herf="shipped-order.php">shipped</a>
<a herf="canceled-order.php">canceled</a>
<a herf="completed-order.php">completed</a>
</div>
</div>
</div>
<div class="card-body--" >
<div class="table-stats order-table ov-h">
 <table class="table">
 <thead>
    <tr>
    <th class="product-thumbnail">order ID</th>
    <th class="product-name"><span class="nobr">order Date</span> </th>
    <th class ="product-price"><span class="nobr">Address</span></th>
    <th class="product-stock-stauts"><span class="nobr"> payment type</span> </th>
    <th class="product-stock-stauts"><span class="nobr">payment status</span></th>
    <th class="product-stock-stauts"><span class="nobr">order status</span></th>
</tr>
</thead>
<tbody>
 <?php 
$res=mysqli_query($con,"select order.*,orderstatus.name as order-status-str from order,order-status where order-status.id=order.order-status");
while($row=mysqli_fetch_assoc($res)){
?>  
 <tr>
 <td class="product-add-to-cart"><a href="order-detail.php?id=<?php echo
 $row['id']?>"> <?php echo $row['id']?></a>
 <br>
 <a herf="../order pdf.php?id=<?php echo $row['id']?>">PDF</a>
 </td>
 <td class="product-name"><?php echo $row['added-on']?></td>
 <td class="product-name">
  <?php echo $row['address']?><br/>
  <?php echo $row['city']?><br/>
  <?php echo $row['pincode']?>
 </td>
 <td class="product-name"><?php echo $row['payment-type']?></td>
 <td class="product-name"><?php echo $row['payment-status']?></td>
 <td class="product-name"><?php echo $row['order-status str']?></td>
 </tr>
<?php
}
?>
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>


 <script>
 function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
 }
 function filterFunction() {
   var input,filter,ul,li,a,i; 
   input=document.getElimentById("myInput");
   filter=input.value.touppercase();
   div=document.getElementById("myDropdown");
   a=div.getElementsByTagName("a");
   for (i=0;i<a.length;i++){
    txtvalue=a[i].textcontent  ||a[i].innerText;
    if(txtvalue.touppercase().indexof(filter)>-1){
    a[i].style.display="";
    } else {
    a[i].style.display ="none";
    }
    }
}
</script>
