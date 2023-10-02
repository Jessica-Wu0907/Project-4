<?php
@include 'database.php';

// Initialize response array
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    // Check if the product is already in the cart
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = '$product_id'");

    if (mysqli_num_rows($select_cart) > 0) {
        $response['message'] = 'Product already added to cart';
    } else {
        // Insert the product into the cart
        $insert_product = mysqli_query($conn, "INSERT INTO `cart` (product_id) VALUES ('$product_id')");

        if ($insert_product) {
            $response['message'] = 'Product added to cart successfully';
        } else {
            http_response_code(500); // 500 means Internal Server Error
            $response['error'] = 'Could not add the product to the cart';
        }
    }
} else {
    http_response_code(405); // 405 means Method Not Allowed
    $response['error'] = 'Invalid request method';
}

// Send response data as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
