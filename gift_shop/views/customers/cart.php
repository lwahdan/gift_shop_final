<?php require 'views/partials/header.php'; ?>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Cart</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="/home">Home</a></li>
                                    
<!--                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>-->
                                    <li class="active" aria-current="page">Cart</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Cart Section:::... -->
    <div class="cart-section">
        <!-- Start Cart Table -->
        <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <table>
                                    <!-- Start Cart Table Head -->
                                    <thead>
                                    <tr>
                                        <th class="product_remove">Delete</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Quantity</th>
                                        <th class="product_total">Total</th>
                                    </tr>
                                    </thead>
                                    <!-- End Cart Table Head -->
    <tbody id="cart-items">
    <?php foreach ($cartItems as $item): ?>
        <tr>
        <td class="product_remove">
    <form class="delete-item-form" action="/cart/remove" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
        <button type="submit" class="btn-delete"><i class="fa fa-trash-o"></i></button>
    </form>
</td>


              <td class="product_thumb">
                 <img src="<?php echo $dir . urlencode($item['image_url']); ?>" alt="Product Image">
              </td>


            <td class="product_name"><?php echo htmlspecialchars($item['name']); ?></td>
            <td class="product-price">$<?php echo number_format($item['price'], 2); ?></td>
            <td class="product_quantity">
    <input type="number" class="quantity-input" value="<?php echo $item['quantity']; ?>" min="1" data-price="<?php echo $item['price']; ?>" data-id="<?php echo $item['id']; ?>">
</td>
<td class="product_total" id="total-<?php echo $item['id']; ?>">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>

                                </table>
                            </div>

                                <div class="checkout_btn">
                                <a href="#" id="checkout-btn" class="btn btn-md btn-golden">Proceed to Checkout</a>
                                </div>
                                <div class="continue_shopping">
                                <a href="/home" class="btn btn-md btn-golden">Continue Shopping</a>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->
    </div>
    <!-- ...:::: End Cart Section:::... -->


    <!-- Start Coupon Start -->
        <div class="coupon_area">
            <div class="container">
                <div class="row">

               <!--coupon table start leen-->
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code left" data-aos="fade-up" data-aos-delay="200">
                            <h3>Coupon</h3>
                            <div class="coupon_inner">
                                <p>Enter your coupon code if you have one.</p>
                                <form id="apply-coupon-form" action="/cart/applyCoupon" method="POST">
                                 <input class="mb-2" name="coupon_code" placeholder="Coupon code" type="text">
                                 <button type="submit" class="btn btn-md btn-golden">Apply coupon</button>
                                 </form>


                                <!-- Placeholder for Messages -->
                                <div id="coupon-message" class="mt-2"></div>

                                <!-- Placeholders for Totals -->
                                <div class="mt-3">
                                    <p>Original Total: <span id="original-total">$0.00</span></p>
                                    <p>Discount: <span id="discount-amount">$0.00</span></p>
                                    <p>New Total: <span id="new-total">$0.00</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon table end leen-->

                    <!--cart total start leen-->
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Subtotal</p>
                                    <p id="subtotal-amount" class="cart_amount">$0.00</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Shipping</p>
                                    <p class="cart_amount"><span>Flat Rate:</span> $50.00</p>
                                </div>
                                <div class="cart_subtotal">
                                    <p>Total</p>
                                    <p id="total-amount" class="cart_amount">$0.00</p>
                                </div>

                                <div class="checkout_btn">
                                <a href="/customers/checkout" id="checkout-btn" class="btn btn-md btn-golden">Checkout</a>
                                </div>



                            </div>
                        </div>
                    </div>

                    <!--cart total end leen-->
                </div>
            </div>
        </div> <!-- End Coupon Start -->

    </div> <!-- ...:::: End Cart Section:::... -->

<?php require 'views/partials/footer.php'; ?>

<script>
    document.getElementById('checkout-btn').addEventListener('click', function(e) {
        e.preventDefault();

        fetch('/cart/calculateTotals')
            .then(response => response.json())
            .then(data => {
                document.getElementById('subtotal-amount').textContent = `$${data.subtotal.toFixed(2)}`;
                document.getElementById('total-amount').textContent = `$${data.total.toFixed(2)}`;
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('apply-coupon-form').addEventListener('submit', function(e) {
    e.preventDefault();  // Prevent default form submission

    const couponCode = document.querySelector('input[name="coupon_code"]').value;
    const messageElement = document.getElementById('coupon-message');

    fetch('/cart/applyCoupon', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `coupon_code=${couponCode}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageElement.textContent = data.message;
            messageElement.classList.remove('message-error');
            messageElement.classList.add('message-success');
            
            // Update totals as before
            document.getElementById('original-total').textContent = `$${data.subtotal.toFixed(2)}`;
            document.getElementById('discount-amount').textContent = `-$${data.discount.toFixed(2)}`;
            const newTotalAfterDiscount = data.subtotal - data.discount;
            document.getElementById('new-total').textContent = `$${newTotalAfterDiscount.toFixed(2)}`;
            const shipping = 50.00;
            const finalTotal = newTotalAfterDiscount + shipping;
            document.getElementById('subtotal-amount').textContent = `$${data.subtotal.toFixed(2)}`;
            document.getElementById('total-amount').textContent = `$${finalTotal.toFixed(2)}`;
        } else {
            messageElement.textContent = data.message;
            messageElement.classList.remove('message-success');
            messageElement.classList.add('message-error');
        }
    })
    .catch(error => console.error('Error:', error));
});

document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        const quantity = parseInt(this.value);
        const price = parseFloat(this.getAttribute('data-price'));
        const id = this.getAttribute('data-id'); 
        
        const newTotal = (quantity * price).toFixed(2);
    
        document.getElementById(`total-${id}`).textContent = `$${newTotal}`;

        updateCartCookie(id, quantity);
        // updateCartTotals();
    });
});

function updateCartCookie(productId, quantity) {
    // Retrieve and decode the cart data from the cookie
    let cart = {};
    const cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)cart\s*\=\s*([^;]*).*$)|^.*$/, "$1");

    if (cookieValue) {
        try {
            cart = JSON.parse(decodeURIComponent(cookieValue)); // Decode the cookie data
        } catch (error) {
            console.error("Error parsing cart cookie:", error);
            return;
        }
    }

    if (cart[productId]) {
        cart[productId].quantity = quantity;
    }

    // Save the updated cart back to the cookie with encoding
    document.cookie = "cart=" + encodeURIComponent(JSON.stringify(cart)) + "; path=/";

    //console.log("Updated cart cookie:", cart);
}


function updateCartTotals() {
    let subtotal = 0;

    document.querySelectorAll('.quantity-input').forEach(input => {
        const quantity = parseInt(input.value);
        const price = parseFloat(input.getAttribute('data-price'));
        subtotal += quantity * price;
    });
    
    document.getElementById('subtotal-amount').textContent = `$${subtotal.toFixed(2)}`;

    const shipping = 50.00;
    const total = subtotal + shipping;
    document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
}


</script>

