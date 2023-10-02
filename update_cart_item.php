<?php
// update_cart_item.php


@include 'database.php';
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (isset($data['cart_item_id']) && isset($data['quantity'])) {
    $cart_item_id = $data['cart_item_id'];
    $quantity = $data['quantity'];

    // Update the cart item quantity in the database
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$quantity' WHERE id = '$cart_item_id'");

    if ($update_quantity_query) {
        echo "Cart item quantity updated successfully";
    } else {
        http_response_code(500);
        echo "Failed to update cart item quantity";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method";
}
?>

