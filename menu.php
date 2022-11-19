<?php
session_start();
if (isset($_SESSION['uid'])) 
{
    include('dbcon.php');
    $uid = $_SESSION['uid'];
    $query = "SELECT * FROM user WHERE id = '$uid'";
    $run = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($run);
	  $id = "mysqli";
}
else{

}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title>FoodHub</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/menu.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

<?php include 'header.php'; ?>

<div class="contentwrapper">
<?php

  $sql = "SELECT * FROM `menu`";
  $retval = mysqli_query($conn, $sql);
  if(! $retval )
  {
    die('Could not get data: ' . mysqli_error($conn));
  }
  while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
  {
    echo '<div style="display: inline-block; margin: 5px">'.
    '<h6>'.$row["id"] .'</h6>'.
    '<h5>'.$row["name"] .'</h5>'.
    '<img src="images/'.$row["image"].'" style="width: 300px;"/>'.
    '</div>';
  } 
?>
</div>
</body>
</html>