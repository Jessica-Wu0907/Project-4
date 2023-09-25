// admin.js
document.addEventListener("DOMContentLoaded", function () {
    const productList = document.getElementById("product-list");

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
                console.log(data,"data")
                // Clear the product list
                productList.innerHTML = '';

                // Fill the product list
                data.forEach(product => {
                    const productItem = document.createElement("tr");
                    productItem.innerHTML = `
                        <td><img src="uploaded_img/${product.image}" height="100" alt=""></td>
                        <td>${product.name}</td>
                        <td>$${product.price}/-</td>
                        <td>
                            <a href="admin.php?delete=${product.id}" class="delete-btn" onclick="return confirm('Are you sure you want to delete this?');"> <i class="fas fa-trash"></i> Delete </a>
                            <a href="admin.php?edit=${product.id}" class="option-btn"> <i class="fas fa-edit"></i> Edit </a>
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

    // Attach the event listener to the form

//     document.getElementById('add-product-form').addEventListener('submit', function (e) {
//     console.log(e,"e")
//     e.preventDefault();
//     const formData = new FormData(this);

//     fetch('insert.php', {
//         method: 'POST',
//         body: formData
//     })
//         .then(response => {
//         console.log(response,"aa")
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         return response.json();
//     })
//         .then(data => {
//         console.log(data,"bb")
//         if (data.success) {
//             alert(data.message); // Display the success message
//             document.getElementById('add-product-form').reset();
//             fetchAndRenderProducts(); // Refresh the product list
//         } else {
//             alert(data.message); // Display the error message
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('Failed to add product. Please try again later.');
//     });
// });
    
        // Fetch and render products when the page loads
    fetchAndRenderProducts();
});
