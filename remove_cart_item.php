<?php
// remove_cart_item.php

@include 'database.php';

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
    echo "Cart item removed successfully";
    exit();
} else {
    http_response_code(400); // Bad Request
    echo "Invalid request";
    exit();
}
?>
