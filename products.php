<?php
@include 'database.php';

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart` (name, price, image, quantity) VALUES ('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart successfully';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style1.css">

    <!-- custom js file link -->
    <script src="js/script.js"></script>
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};
?>
<?php include 'header.php'; ?>
<div class="container">
    <section class="products">
        <h1 class="heading">latest products</h1>
        <div class="box-container" id="product-container">
            <!-- Products will be rendered here by JavaScript -->
        </div>
    </section>
</div>


<!-- custom js file link  -->
<!-- <script src="js/script.js"></script> -->
<script src="js/products.js"></script>

</body>
</html>