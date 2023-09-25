<?php
@include 'config.php'; // Include your database connection

$response = array();

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
    if ($delete_query) {
        $response['success'] = true;
        $response['message'] = 'Product has been deleted';
    } else {
        $response['success'] = false;
        $response['message'] = 'Product could not be deleted';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No delete request received';
}

// 输出 JSON 响应
header('Content-Type: application/json');
echo json_encode($response);
?>
