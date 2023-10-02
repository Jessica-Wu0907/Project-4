<?php

@include 'database.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <section class="products">

            <h1 class="heading">Latest Products</h1>

            <div class="box-container" id="product-container">
                <!-- Product items will be dynamically loaded here -->
            </div>

        </section>

    </div>

    <!-- Custom JavaScript file link -->
    <script src="./js/products.js"></script>

</body>

</html>