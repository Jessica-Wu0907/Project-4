document.addEventListener("DOMContentLoaded", function () {
    const productContainer = document.getElementById("product-container");

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
                console.log(data)
                // Clear the product container
                productContainer.innerHTML = '';

                // Fill the product container with product items
                data.forEach(product => {
                    const productItem = document.createElement("div");
                    productItem.classList.add("box");
                    productItem.innerHTML = `
                        <img src="uploaded_img/${product.image}" alt="">
                        <h3>${product.name}</h3>
                        <div class="price">$${product.price}/-</div>
                        <button class="btn add-to-cart" data-product-id="${product.id}">Add to Cart</button>
                    `;

                    productContainer.appendChild(productItem);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to fetch products. Please try again later.');
            });
    }

    // Fetch and render products when the page loads
    fetchAndRenderProducts();

    // Add-to-cart button click event
    productContainer.addEventListener("click", function (e) {
    console.log(e, "e1"); // Log the event object
    if (e.target.classList.contains("add-to-cart")) {
        const productId = e.target.getAttribute("data-product-id");
        console.log(productId, "addbutton"); // Log the productId
console.log(JSON.stringify({product_id: productId}),"aaaa");
        // Send a POST request to add the product to the cart
        fetch("cart_handler.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ product_id: productId }),
        })
        .then(response => response.text())
        .then(data => {
            console.log(data,"bbb"); // Log the response data

            try {
                const jsonData = JSON.parse(data);
                if (jsonData.message) {
                    alert(jsonData.message);
                } else {
                    alert("Failed to add the product to the cart.");
                }
            } catch (error) {
                console.error('JSON Parse Error:', error);
                alert('Failed to parse response data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to add the product. Please try again later.');
        });
    }
});
       
});
