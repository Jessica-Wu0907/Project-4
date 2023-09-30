<?php
@include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/' . $update_p_image;

    $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

    if ($update_query) {
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        echo json_encode(["message" => "Product updated successfully"]);
    } else {
        http_response_code(500); // 500 表示服务器内部错误
        echo json_encode(["error" => "Could not update the product"]);
    }
} else {
    http_response_code(405); // 405 表示不允许的请求方法
    echo json_encode(["error" => "Method not allowed"]);
}
?>

