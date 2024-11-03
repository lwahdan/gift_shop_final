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
function submitOrder() {
    Swal.fire({
        title: 'Order Submitted!',
        text: 'Your order has been submitted successfully.',
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'custom-swal-button'
        },
        html: '<p style="font-size: 14px; margin-top: 10px;"><a href="/home" style="color: #b19361; text-decoration: none;">Continue Shopping</a></p>'
    }).then(() => {
        // Clear the cart cookie
        document.cookie = "cart=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";

        // Clear other related cookies (like discount if applicable)
        document.cookie = "discount=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    });
}


// subscribe button
document.getElementById("SUBSCRIBE").onclick = function(event) {
    event.preventDefault(); // Prevents the default form submission
    const emailInput = document.getElementById("emailInput").value;
    const subscribeMessage = document.getElementById("subscribeMessage");
    const errorMessage = document.getElementById("errorMessage");

    if (emailInput === "") {
        // Show error message if email input is empty
        errorMessage.style.display = "block";
        subscribeMessage.style.display = "none"; // Hide success message if shown before
    } else {
        // Show success message if email input is filled
        errorMessage.style.display = "none";
        subscribeMessage.style.display = "block";
        document.getElementById("SUBSCRIBE").innerText = "Subscribed!"; // Optional: changes button text
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // Start the auto-slide function for the other page
    startAutoSlide();

});

// cart
// Listen for changes in quantity inputs
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        const quantity = parseInt(this.value);
        const price = parseFloat(this.getAttribute('data-price'));
        const id = this.getAttribute('data-id');

        // Update the total for this item
        const newTotal = (quantity * price).toFixed(2);
        document.getElementById(`total-${id}`).textContent = `$${newTotal}`;

        // Update the quantity in the cart cookie via AJAX
        updateCartQuantity(id, quantity);
        
        // Recalculate cart subtotal and total dynamically
        updateCartTotals();
    });
});

// Function to update cart quantity in the server cookie using AJAX
function updateCartQuantity(productId, quantity) {
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ product_id: productId, quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Cart updated successfully');
        } else {
            console.error('Error updating cart:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to update the cart subtotal and total
function updateCartTotals() {
    let subtotal = 0;

    document.querySelectorAll('.quantity-input').forEach(input => {
        const quantity = parseInt(input.value);
        const price = parseFloat(input.getAttribute('data-price'));
        subtotal += quantity * price;
    });

    document.getElementById('subtotal-amount').textContent = `$${subtotal.toFixed(2)}`;

    const shipping = 50.00; // Assume fixed shipping cost
    const total = subtotal + shipping;
    document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
}

// Select all forms with the 'add-to-cart-form' class
document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Create a FormData object to retrieve the form data
        const formData = new FormData(this);

        // Send the AJAX request to add the item to the cart
        fetch('/cart/add', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // alert('Item added to cart successfully!');

                // Update cart icon count dynamically
                document.getElementById('cart-count').textContent = data.cartCount;
            } else {
                alert('There was an issue adding the item to the cart.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});



