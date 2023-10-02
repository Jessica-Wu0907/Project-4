<?php
// get_cart_items.php

@include 'database.php';

$select_cart = mysqli_query($conn, "SELECT * FROM `cart`");

$cart_items = [];
if (mysqli_num_rows($select_cart) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $cart_items[] = [
            "id" => $fetch_cart["id"],
            "name" => $fetch_cart["name"],
            "price" => $fetch_cart["price"],
            "image" => $fetch_cart["image"],
            "quantity" => $fetch_cart["quantity"]
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($cart_items);
?>
