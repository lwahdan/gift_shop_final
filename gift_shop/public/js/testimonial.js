// testimonialll
let currentIndex = 0;
const slides = document.querySelectorAll('.testimonial-slide');
let slideInterval;

// Function to show slide at the specified index
function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
            slide.classList.add('active');
        }
    });
}

// Initial slide display
showSlide(currentIndex);

// Auto-slide function
function startAutoSlide() {
    slideInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }, 4000); // Adjust the interval time as needed
}

// Manual navigation functions
function prevSlide() {
    clearInterval(slideInterval); // Stop auto-slide on manual change
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
    startAutoSlide(); // Restart auto-slide after manual change
}

function nextSlide() {
    clearInterval(slideInterval); // Stop auto-slide on manual change
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
    startAutoSlide(); // Restart auto-slide after manual change
}

// cart
// Add Cart Management Functions
function addToCart(productId, quantity = 1) {
    fetch('/controllers/apply_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: productId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const product = data.product;
                let cart = JSON.parse(getCookie('cart') || '[]');

                // Remove any outdated items for this productId
                cart = cart.filter(item => item.productId !== product.id);

                // Add the new item with updated data
                cart.push({
                    productId: product.id,
                    productName: product.product_name,
                    price: parseFloat(product.price),
                    imageUrl: product.image_url,
                    quantity: quantity
                });

                setCookie('cart', JSON.stringify(cart), 7); // Save for 7 days

                $('#modalAddcart').modal('show'); // Show the modal
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error fetching product details:', error));
}



function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Function to load and display cart items on the cart page
function loadCartItems() {
    console.log("Loading cart items...");
    const cart = JSON.parse(getCookie('cart') || '[]');
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = ''; // Clear existing content to prevent duplicates

    if (cart.length > 0) {
        cart.forEach(item => {
            const itemTotal = (item.price * item.quantity).toFixed(2);
            const itemElement = document.createElement('tr');
            itemElement.innerHTML = `
                <td class="product_remove">
                    <a href="#" onclick="removeFromCart('${item.productId}')"><i class="fa fa-trash-o"></i></a>
                </td>
                <td class="product_thumb">
                    <img src="${item.imageUrl}" alt="${item.productName}" style="width: 50px; height: 50px;">
                </td>
                <td class="product_name">${item.productName}</td>
                <td class="product-price">$${parseFloat(item.price).toFixed(2)}</td>
                <td class="product_quantity">
                    <input type="number" min="1" value="${item.quantity}" data-product-id="${item.productId}"
                           onchange="updateQuantity('${item.productId}', this.value)">
                </td>
                <td class="product_total">$${itemTotal}</td>
            `;
            cartItemsContainer.appendChild(itemElement);
        });
    } else {
        console.log("Cart is empty");
        cartItemsContainer.innerHTML = "<tr><td colspan='6'>Your cart is empty</td></tr>";
    }
}



// Function to remove an item from the cart
function removeFromCart(productId) {
    console.log("Removing product with ID:", productId);
    let cart = JSON.parse(getCookie('cart') || '[]');
    cart = cart.filter(item => item.productId !== productId.toString());  // Ensure consistent comparison
    setCookie('cart', JSON.stringify(cart), 7);
    console.log("Updated cart after removal:", JSON.parse(getCookie('cart')));  // Check updated cart cookie
    loadCartItems();  // Reloads the cart items display
}

// Function to update item quantity in the cart
function updateQuantity(productId, newQuantity) {
    console.log("Updating quantity for product ID:", productId, "to", newQuantity);
    let cart = JSON.parse(getCookie('cart') || '[]');
    const item = cart.find(item => item.productId === productId.toString());  // Ensure consistent comparison
    if (item) {
        item.quantity = parseInt(newQuantity, 10);
        setCookie('cart', JSON.stringify(cart), 7);
        console.log("Updated cart after quantity change:", JSON.parse(getCookie('cart')));  // Check updated cart cookie
        loadCartItems();  // Reloads the cart items display
    }
}



// coupon


function updateCartTotals(discountedSubtotal) {
    const shippingCost = 50;
    const total = discountedSubtotal + shippingCost;

    // Display the calculated totals
    document.getElementById('subtotal-amount').textContent = `$${discountedSubtotal.toFixed(2)}`;
    document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
}

// After applying the coupon, update the totals
function applyCoupon() {
    const couponCode = document.getElementById('coupon-code').value;
    const originalTotal = calculateCartTotal();

    if (!couponCode) {
        displayCouponMessage("Please enter a coupon code.", "error");
        return;
    }

    fetch('/controllers/apply_coupon.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ code: couponCode })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const discountAmount = originalTotal * (parseFloat(data.discount_value) / 100);
                const newTotal = originalTotal - discountAmount;

                document.getElementById('original-total').textContent = `$${originalTotal.toFixed(2)}`;
                document.getElementById('discount-amount').textContent = `- $${discountAmount.toFixed(2)}`;
                document.getElementById('new-total').textContent = `$${newTotal.toFixed(2)}`;

                displayCouponMessage("Coupon applied successfully!", "success");

                // Update the cart totals section with the new subtotal
                updateCartTotals(newTotal);
            } else {
                displayCouponMessage(data.message, "error");
            }
        })
        .catch(error => {
            console.error("Error applying coupon:", error);
            displayCouponMessage("Error applying coupon. Please try again later.", "error");
        });
}

// Helper function to display success/error messages
function displayCouponMessage(message, type) {
    const messageElement = document.getElementById('coupon-message');
    messageElement.textContent = message;
    messageElement.style.color = type === "success" ? "green" : "red";
}


// cart total calculations
function calculateCartTotal() {
    let cart = JSON.parse(getCookie('cart') || '[]');
    let total = 0;

    cart.forEach(item => {
        total += item.price * item.quantity;
    });

    return total;
}

// Function to display the total with coupon applied
function displayTotalWithCoupon(discountValue) {
    const originalTotal = calculateCartTotal();
    const discountAmount = originalTotal * (discountValue / 100);
    const newTotal = originalTotal - discountAmount;

    document.getElementById('original-total').textContent = `$${originalTotal.toFixed(2)}`;
    document.getElementById('discount-amount').textContent = `- $${discountAmount.toFixed(2)}`;
    document.getElementById('new-total').textContent = `$${newTotal.toFixed(2)}`;
}

function proceedToCheckout() {
    const shippingCost = 50; // Fixed shipping cost
    let subtotal = calculateCartTotal(); // Calculate the subtotal from cart items
    let total = subtotal + shippingCost;

    // Display the totals in the Cart Totals section
    document.getElementById('subtotal-amount').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;

    // Optionally, display a message or navigate to the checkout page
    displayCouponMessage("Proceeding to checkout with updated total.", "success");
}


// checkout
function redirectToCheckout() {
    // First, store the cart data (if needed for session management or verification)
    sessionStorage.setItem('cartData', JSON.stringify(getCartData())); // Optional step if needed

    // Redirect to checkout page
    window.location.href = "/customers/checkout";
}

// Utility function to fetch cart data (can use getCookie or your existing cart retrieval logic)
function getCartData() {
    return JSON.parse(getCookie('cart') || '[]');
}

function loadCheckoutItems() {
    const cart = JSON.parse(getCookie('cart') || '[]');
    const checkoutItemsContainer = document.getElementById('checkout-items');
    let subtotal = 0;
    const shippingCost = 50;

    // Clear any existing rows
    checkoutItemsContainer.innerHTML = '';

    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.productName} <strong> × ${item.quantity}</strong></td>
            <td>$${itemTotal.toFixed(2)}</td>
        `;
        checkoutItemsContainer.appendChild(row);
    });

    const total = subtotal + shippingCost;

    document.getElementById('subtotal-amount').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('shipping-amount').textContent = `$${shippingCost.toFixed(2)}`;
    document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
}

function submitOrder() {
    // Confirm submission with SweetAlert
    Swal.fire({
        icon: 'success',
        title: 'Order Submitted Successfully',
        text: 'Thank you for your order!',
        confirmButtonText: 'OK',
        confirmButtonColor: '#b19361',
        footer: '<a href="/customers/index" style="color: #b19361; font-weight: bold;">Continue Shopping</a>'
    }).then(() => {
        // Optionally, you can redirect to a different page or reset the cart here
        // window.location.href = '/order-confirmation';
        clearCart(); // Example to clear cart cookies, optional
    });
}

// Function to clear the cart after submission (optional)
function clearCart() {
    setCookie('cart', '', -1); // Set cart cookie to expire immediately
    document.getElementById('checkout-items').innerHTML = ''; // Clear checkout table
    document.getElementById('subtotal-amount').textContent = '$0.00';
    document.getElementById('total-amount').textContent = '$0.00';
}



document.addEventListener("DOMContentLoaded", function() {
    // Start the auto-slide function for the other page
    startAutoSlide();

    // Load cart items if on the cart.php page
    if (document.getElementById('cart-items')) {
        loadCartItems();
    }

    if (document.getElementById('checkout-items')) {
        loadCheckoutItems();
    }
});


