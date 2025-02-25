<?php
session_start();
if (isset($_SESSION['uid'])) {
    include('dbcon.php');
    $uid = $_SESSION['uid'];
    $query = "SELECT * FROM `user` WHERE `id` = '$uid'";
    $run = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($run);

    if (isset($_POST['order_btn'])) {
        $name = $data['name'];
        $number = $_POST['phone'];
        $method = $_POST['method'];
        $location = $_POST['location'];

        $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
        $price_total = 0;

        if (mysqli_num_rows($cart_query) > 0) {
            while ($product_item = mysqli_fetch_assoc($cart_query)) {
                $product_name[] = $product_item['name'] . ' (' . $product_item['total_item'] . ') ';
                $foodname = $product_item['name'];
                $product_price = number_format($product_item['price'] * $product_item['total_item']);
                $price_total += $product_price;
            };
        };

        $total_product = implode(', ', $product_name);

        $detail_query = mysqli_query($conn, "INSERT INTO `order`(itemName, phonenumber, name, method, location, qty, total) VALUES('$foodname','$number', '$name', '$method','$location','$total_product','$price_total')") or die('query failed');

        if ($cart_query && $detail_query) {
            $success = true;
        }
    }
} else {
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

    <?php if (isset($success) && $success) { ?>
        <div class='order-message-container'>
            <div class='message-container'>
                <h3>thank you for shopping!</h3>
                <div class='order-detail'>
                    <span><?= $total_product ?></span>
                    <span class='total'> total : $<?= $price_total ?>/-  </span>
                </div>
                <div class='customer-details'>
                    <p> your payment mode : <span><?= $method ?></span> </p>
                    <p>(*pay when product arrives*)</p>
                </div>
                <a href='products.php' class='btn'>continue shopping</a>
            </div>
        </div>
    <?php } else { ?>
        <section class="checkout-form">

            <h1 style="font-family: system;">complete your order</h1>

            <form action="" method="post">

                <div class="display-order">
                    <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                    $total = 0;
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = number_format($fetch_cart['price'] * $fetch_cart['total_item']);
                            $grand_total = $total += $total_price;
                            ?>
                            <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['total_item']; ?>)</span>
                        <?php
                        }
                    } else {
                        echo "<div class='display-order'><span>your cart is empty!</span></div>";
                    }
                    ?>
                    <span class="grand-total"> grand total : $<?= $grand_total; ?> </span>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>your number</span>
                        <input type="text" placeholder="<?php echo $data['mobile'] ?>" name="phone" required>
                    </div>
                    <div class="inputBox">
                        <span>payment method</span>
                        <select name="method">
                            <option value="cash on delivery" selected>cash on devlivery</option>
                            <!--<option value="credit cart">credit cart</option>-->
                            <!--<option value="paypal">paypal</option>-->
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>Drop Location</span>
                        <input type="text" placeholder="<?php echo $data['location'] ?>" name="location" required>
                    </div>
                </div>
                <input type="submit" value="order now" name="order_btn" class="btn">
            </form>

        </section>
    <?php } ?>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>