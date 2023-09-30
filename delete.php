<?php
@include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    
    // 使用参数化查询来构建 SQL 查询
    $delete_stmt = mysqli_prepare($conn, "DELETE FROM `products` WHERE id = ?");
    mysqli_stmt_bind_param($delete_stmt, "i", $delete_id);
    
    if (mysqli_stmt_execute($delete_stmt)) {
        echo json_encode(["message" => "Product has been deleted"]);
    } else {
        http_response_code(500); // 500 表示服务器内部错误
        echo json_encode(["error" => "Could not delete the product"]);
    }
    
    // 关闭预备语句
    mysqli_stmt_close($delete_stmt);
} else {
    http_response_code(405); // 405 表示不允许的请求方法
    echo json_encode(["error" => "Method not allowed"]);
}

?>
