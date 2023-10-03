document.addEventListener("DOMContentLoaded", function () {
    const productList = document.getElementById("product-list");
    const addProductForm = document.getElementById("add-product-form");
    const editForm = document.getElementById("edit-product-form");
    const editformcontainer= document.getElementById("edit-form-container");
    // Function to fetch and render products
    function fetchAndRenderProducts() {
        fetch('get_products.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data, "data")
                // Clear the product list
                productList.innerHTML = '';

                // Fill the product list
                data.forEach(product => {
                    const productItem = document.createElement("tr");
                    productItem.innerHTML = `
                        <td><img src="uploaded_img/${product.image}" height="100" alt=""></td>
                        <td class="product-name">${product.name}</td>
                        <td class="product-price">$${product.price}/-</td>
                        <td>
                            <a href="admin.php?delete=${product.id}" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"> <i class="fas fa-trash"></i> Delete </a>
                            <a href="#" class="edit-btn option-btn" data-product-id="${product.id}"> <i class="fas fa-edit"></i> Edit </a>
                        </td>
                    `;

                    productList.appendChild(productItem);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to fetch products. Please try again later.');
            });
    }

    // 监听表单提交事件
    addProductForm.addEventListener("submit", function (e) {
        // console.log(addProductForm,"addProductForm")
        e.preventDefault(); // 阻止默认的表单提交行为

        // 创建 FormData 对象来收集表单数据
        const formData = new FormData(addProductForm);

        // 发送 AJAX 请求到 insert.php
        fetch("insert.php", {
            method: "POST",
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // 如果成功添加产品，创建新的表格行并添加到表格中
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td><img src="uploaded_img/${data.image}" height="100" alt=""></td>
                        <td class="product-name">${data.name}</td>
                        <td class="product-price">$${data.price}/-</td>
                        <td>
                            <a href="admin.php?delete=${data.id}" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"> <i class="fas fa-trash"></i> Delete </a>
                            <a href="#" class="edit-btn option-btn" data-product-id="${data.id}"> <i class="fas fa-edit"></i> Edit </a>
                        </td>
                    `;

                    productList.appendChild(newRow);

                    // 清空表单
                    addProductForm.reset();

                    // 弹出成功消息或执行其他逻辑
                    alert(data.message);

                    // 更新产品列表
                    fetchAndRenderProducts();
                } else {
                    // 处理错误情况，弹出错误消息或执行其他逻辑
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add product. Please try again later.');
            });
        
    });


    // 先解绑已有的点击事件处理函数
    productList.addEventListener("click", function (e) {
        console.log(e,"e")
        // contains() 用于检查元素的类列表中是否包含指定的类名
        // includes() 方法是 JavaScript 数组的方法，用于检查数组是否包含指定的元素


        if (e.target.classList.contains("edit-btn")) {
            console.log("edit")
            // console.log(e.target.classList.contains("edit-btn"), "boolean");//true
            // e.preventDefault(); // 阻止默认链接行为

            // 获取产品的信息
            const productId = e.target.getAttribute("data-product-id");
            const productRow = e.target.closest("tr");
            const productName = productRow.querySelector(".product-name").textContent;
            const productPrice = parseFloat(productRow.querySelector(".product-price").textContent.replace("$", ""));

            // 填充编辑表单字段  update_p_id  update_p_name
            editForm.querySelector("[name='update_p_id']").value = productId;
            editForm.querySelector("[name='update_p_name']").value = productName;
            editForm.querySelector("[name='update_p_price']").value = productPrice;

            // 显示编辑表单
            // editForm.style.display = "block";
            editformcontainer.style.display="block"
            return false;
        } else if (e.target.classList.contains("delete-btn")) {
            console.log(e.target.classList.contains("delete-btn"),"cc")//true
    console.log("delete");//get
            const productId = e.target.getAttribute("href").split("=")[1];
            console.log(productId,"productId")

        if (confirm('Are you sure you want to delete this product?')) {
            e.stopPropagation(); // 阻止事件冒泡
            fetch(`delete.php?delete=${productId}`, {
                method: "GET",
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const productRow = e.target.closest("tr");
                    productRow.remove();
                    alert(data.message);
                } else {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete the product. Please try again later.');
            });
        }
    }
    });

    // 监听编辑表单的提交事件
    editForm.addEventListener("submit", function (e) {
        console.log(editForm,"editForm")
        e.preventDefault(); // 阻止默认的表单提交行为

        // 创建 FormData 对象来收集编辑表单数据
        const formData = new FormData(editForm);

        // 发送 AJAX 请求到 update.php
        fetch("update.php", {
            method: "POST",
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // 如果成功更新产品，执行成功后的逻辑
                    alert(data.message);

                    // 隐藏编辑表单
                    editformcontainer.style.display = "none";

                    // 更新产品列表
                    fetchAndRenderProducts();
                } else {
                    // 处理错误情况，弹出错误消息或执行其他逻辑
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update product. Please try again later.');
            });
    });

    // 初始化页面时获取并显示产品列表
    fetchAndRenderProducts();
});
