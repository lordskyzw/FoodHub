<style>

.header{
   background-color: #000;
}


</style>



<header class="header">

   <div class="flex">

      <a href="#" class="logo">FoodHub</a>
      

      <nav class="navbar">
        
         
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>


      <a href="products.php" style="color: #fff; top: 25%; text-align: bottom;"><i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i></a>

   </div>

</header>