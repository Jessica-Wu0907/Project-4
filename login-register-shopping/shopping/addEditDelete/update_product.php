<?php
@include 'config.php'; // Include your database connection

$response = array();

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/' . $update_p_image;

    $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

    if ($update_query) {
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $response['success'] = true;
        $response['message'] = 'Product updated successfully';
    } else {
        $response['success'] = false;
        $response['message'] = 'Product could not be updated';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No update request received';
}

// 输出 JSON 响应
header('Content-Type: application/json');
echo json_encode($response);
?>
