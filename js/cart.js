// cart.js

document.addEventListener("DOMContentLoaded", function () {
    const cartTableBody = document.getElementById("cart-table-body");
    const checkoutBtn = document.getElementById("checkout-btn");

    // Function to fetch and render cart items
    function fetchAndRenderCartItems() {
        fetch('get_cart_items.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Clear the cart table body
                cartTableBody.innerHTML = '';

                // Fill the cart table body with cart items
                data.forEach(cartItem => {
                    const cartRow = document.createElement("tr");
                    cartRow.innerHTML = `
                        <td><img src="uploaded_img/${cartItem.image}" height="100" alt=""></td>
                        <td>${cartItem.name}</td>
                        <td>$${cartItem.price}/-</td>
                        <td>
                            <input type="number" name="update_quantity" min="1" value="${cartItem.quantity}" data-cart-item-id="${cartItem.id}">
                            <button class="update-quantity-btn">Update</button>
                        </td>
                        <td>$${(cartItem.price * cartItem.quantity).toFixed(2)}/-</td>
                        <td>
                            <button class="remove-item-btn" data-cart-item-id="${cartItem.id}">Remove</button>
                        </td>
                    `;
                    cartTableBody.appendChild(cartRow);
                });

                // Enable or disable the checkout button based on the cart items
                // checkoutBtn.classList.toggle("disabled", data.length === 0);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to fetch cart items. Please try again later.');
            });
    }

    // Fetch and render cart items when the page loads
    fetchAndRenderCartItems();

    // Add event listener to handle updating cart item quantities
    // cartTableBody.addEventListener("click", function (event) {
    //     console.log(event,"event")
    //     if (event.target.classList.contains("update-quantity-btn")) {
    //         const cartItemId = event.target.parentElement.querySelector("input").getAttribute("data-cart-item-id");
    //         const updatedQuantity = event.target.parentElement.querySelector("input").value;

    //         // Send a POST request to update the cart item quantity
    //         fetch("update_cart_item.php", {
    //             method: "POST",
    //             headers: {
    //                 "Content-Type": "application/json",
    //             },
    //             body: JSON.stringify({ cart_item_id: cartItemId, quantity: updatedQuantity }),
    //         })
    //         .then(response => response.text())
    //         .then(data => {
    //             fetchAndRenderCartItems(); // Refresh cart items after update
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //             alert('Failed to update cart item quantity. Please try again later.');
    //         });
    //     }
    // });

    // // Add event listener to handle removing cart items
    // cartTableBody.addEventListener("click", function (event) {
    //     console.log(event,"delete")
    //     if (event.target.classList.contains("remove-item-btn")) {
    //         const cartItemId = event.target.getAttribute("data-cart-item-id");

    //         // Send a GET request to remove the cart item
    //         fetch(`remove_cart_item.php?remove=${cartItemId}`)
    //         .then(response => response.text())
    //         .then(data => {
    //             fetchAndRenderCartItems(); // Refresh cart items after removal
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //             alert('Failed to remove cart item. Please try again later.');
    //         });
    //     }
    // });


    cartTableBody.addEventListener("click", function (event) {
        console.log(event,"event")//get event
    if (event.target.classList.contains("update-quantity-btn")) {
        const cartItemId = event.target.parentElement.querySelector("input").getAttribute("data-cart-item-id");
        console.log(cartItemId,"cartItemId")//get id
        const updatedQuantity = event.target.parentElement.querySelector("input").value;
        console.log(updatedQuantity, "updatedQuantity")//get number
        

         console.log(JSON.stringify({ cart_item_id: cartItemId, quantity: updatedQuantity }));

        // Send a POST request to update the cart item quantity
        fetch("update_cart_item.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({

            cart_item_id: parseInt(cartItemId), // Parse the ID as an integer
                quantity: parseInt(updatedQuantity), // Parse the quantity as an integer
             
    }),
        })
        .then(response => response.text())
            .then(data => {
            console.log(data,"edit")
            fetchAndRenderCartItems(); // Refresh cart items after update
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update cart item quantity. Please try again later.');
        });
    } else if (event.target.classList.contains("remove-item-btn")) {
        const cartItemId = event.target.getAttribute("data-cart-item-id");

        // Send a GET request to remove the cart item
        fetch(`remove_cart_item.php?remove=${cartItemId}`)
        .then(response => response.text())
        .then(data => {
            fetchAndRenderCartItems(); // Refresh cart items after removal
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to remove cart item. Please try again later.');
        });
    }
});
});
