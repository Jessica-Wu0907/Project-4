<?php
// get_products.php

// Include your database connection file
@include 'database.php';

// 查询数据库以获取产品数据
$select_products = mysqli_query($conn, "SELECT * FROM `products`");

if (!$select_products) {
    // 查询失败，返回错误响应
    http_response_code(500); // 500 表示服务器内部错误
    echo json_encode(["error" => "Failed to fetch products"]);
} else {
    // 查询成功，将产品数据存储在数组中
    $products = [];
    while ($row = mysqli_fetch_assoc($select_products)) {
        $products[] = [
            "id" => $row["id"],
            "name" => $row["name"],
            "price" => $row["price"],
            "image" => $row["image"]
        ];
    }

    // 将产品数据作为 JSON 响应发送回客户端
    echo json_encode($products);
}
?>
