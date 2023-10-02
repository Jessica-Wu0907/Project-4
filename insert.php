<?php
// 引入数据库连接文件
@include 'database.php';

// 初始化响应数组
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取表单提交的产品信息
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/' . $p_image;

    // 执行数据库插入操作
    $insert_query = mysqli_query($conn, "INSERT INTO `products` (name, price, image) VALUES ('$p_name', '$p_price', '$p_image')");

   if ($insert_query) {
    // 移动上传的图像文件到指定文件夹
    move_uploaded_file($p_image_tmp_name, $p_image_folder);
    $response['success'] = true;
    $response['message'] = 'Product added successfully';
    $response['image'] = $p_image; // 设置 data.image 为上传的图像文件名
} else {
    // 数据库插入失败，返回错误信息
    $response['success'] = false;
    $response['message'] = 'Could not add the product';
}
} else {
    // 不支持的请求方法，返回错误信息
    http_response_code(405); // 405 表示不允许的请求方法
    $response['success'] = false;
    $response['message'] = 'Method not allowed';
}

// 发送响应数据为 JSON 格式
header('Content-Type: application/json');
echo json_encode($response);
?>
