<?php

@include 'database.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>
<?php include 'header.php'; ?>
    <div class="container">

        <section class="shopping-cart">

            <h1 class="heading">Shopping Cart</h1>

            <table>

                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>

                <tbody id="cart-table-body">
                    <!-- Cart items will be added dynamically here -->
                </tbody>

            </table>

          <div class="checkout-btn">
            <a href="checkout.php" class="btn">procced to checkout</a>
         </div>

        </section>

    </div>

    <!-- Custom JavaScript file link -->
    <script src="js/cart.js"></script>
    <script src="js/script.js"></script>

</body>

</html>