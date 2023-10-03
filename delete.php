<?php
//1
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

//2
// print_r($sql);




// 引入数据库连接文件
@include 'database.php';

// 初始化响应数组
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' || ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete']))) {
    // 获取要删除的产品的 ID
    $delete_id = $_REQUEST['delete']; // 使用 $_REQUEST 来获取参数，可以同时处理 GET 和 POST 请求
    
    // 打印接收到的产品 ID，用于调试
    echo "Received delete_id: $delete_id";

    // 执行数据库删除操作
    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id");

    if ($delete_query) {
        $response['success'] = true;
        $response['message'] = 'Product deleted successfully';
    } else {
        // 数据库删除失败，返回错误信息
        $response['success'] = false;
        $response['message'] = 'Could not delete the product';
    }
} else {
    // 不支持的请求方法或缺少参数，返回错误信息
    http_response_code(405); // 405 表示不允许的请求方法
    $response['success'] = false;
    $response['message'] = 'Method not allowed or missing parameter';
}

// 发送响应数据为 JSON 格式
header('Content-Type: application/json');
echo json_encode($response);
?>





