
<?php

@include 'database.php';

session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>


<!-- 添加产品表单 -->
 <div class="container">
    <section>
            <form action="insert.php" method="post" class="add-product-form" enctype="multipart/form-data"
                id="add-product-form">
            <h3>add a new product</h3>
            <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
            <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
            <input type="submit" value="add the product" name="add_product" class="btn">
        </form>
    </section>
    <!-- 产品列表 -->
    <section class="display-product-table">
        <table>
            <!-- 产品列表头部 -->
            <thead>
                <th>product image</th>
                <th>product name</th>
                <th>product price</th>
                <th>action</th>
            </thead>
            <!-- 产品列表内容将由JavaScript动态填充 -->
            <tbody id="product-list">
            </tbody>
        </table>
    </section>

    <!-- 编辑表单 -->
      <section class="edit-form-container" id="edit-form-container">
            <form action="update.php" method="post" enctype="multipart/form-data" id="edit-product-form">
                <input type="hidden" name="update_p_id" value="">
                <input type="text" class="box" required name="update_p_name" placeholder="enter the product name">
                <input type="number" min="0" class="box" required name="update_p_price" placeholder="enter the product price">
                <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                <input type="submit" value="Update the product" name="update_product" class="btn">
                <input type="reset" value="Cancel" id="close-edit" class="option-btn">
            </form>
    </section>
    </div>
    <a href="logout.php" class="btn btn-warning">Logout</a>

    <script src="js/admin1.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
