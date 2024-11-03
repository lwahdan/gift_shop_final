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


