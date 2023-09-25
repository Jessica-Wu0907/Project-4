<?php
// admin_backend.php

@include 'config.php'; // Include your database connection

// 在 add_products.php 中添加以下代码

$response = array();

if (isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/' . $p_image;

   //  $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed');
   // $insert_query = mysqli_query($conn, "INSERT INTO `products` (name, price, image) VALUES ('$p_name', '$p_price', '$p_image')") or die('Query failed: ' . mysqli_error($conn));
   $insert_query = mysqli_query($conn, "INSERT INTO `products` (name, price, image) VALUES ('$p_name', '$p_price', '$p_image')") or die('Query failed: ' . mysqli_error($conn));
       echo "SQL query: INSERT INTO `products` (name, price, image) VALUES ('$p_name', '$p_price', '$p_image')";



    if ($insert_query) {
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $response['success'] = true;
        $response['message'] = 'Product added successfully';
    } else {
        $response['success'] = false;
        $response['message'] = 'Failed to add product';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No data received';
}

// 输出 JSON 响应
header('Content-Type: application/json');
echo json_encode($response);


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:admin.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:admin.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:admin.php');
   }

}

// Add more PHP logic for other actions as needed
$select_products = mysqli_query($conn, "SELECT * FROM `products`");
?>
