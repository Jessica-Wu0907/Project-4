<?php
// insert.php

// Include your database connection file

@include 'database.php';

$response = []; // Initialize a response array

if (isset($_POST['add_product'])) {
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/' . $p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed');

   if ($insert_query) {
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $response['success'] = true;
      $response['message'] = 'Product added successfully';
   } else {
      $response['success'] = false;
      $response['message'] = 'Could not add the product';
   }
} else {
   $response['success'] = false;
   $response['message'] = 'Invalid request';
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

