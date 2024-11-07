<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /customers/login");
    exit();
}

// Retrieve updated cart items from the cookie
$cartItems = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

$subtotal = 0.00;
$shipping = 50.00;
$discount = isset($_COOKIE['discount']) ? (float)$_COOKIE['discount'] : 0.00;

// Calculate subtotal based on updated cart items
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$orderTotal = $subtotal - $discount + $shipping;
?>
<?php require 'views/partials/header.php'; ?>

<!-- HTML for checkout page -->

<div class="checkout-section">
    <div class="container">
        <div class="checkout_form mt-10" data-aos="fade-up" data-aos-delay="400">
            <div class="row">
                <!-- Order Summary -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <h3>Your Order</h3>
                    <div class="order_table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody id="checkout-items">
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['quantity']; ?></td>
                                    <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr class="order_total">
                                <th>Subtotal</th>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Shipping</th>
                                <td>$<?php echo number_format($shipping, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>-$<?php echo number_format($discount, 2); ?></td>
                            </tr>
                            <tr class="order_total">
                                <th>Order Total</th>
                                <td id="total-amount">$<?php echo number_format($orderTotal, 2); ?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="col-lg-6 col-md-12">
                    <h3>Shipping Information</h3>
                    <form id="orderForm" action="/order/submit" method="GET" onsubmit="handleSubmit()">
                        <div class="form-group">
                            <label for="shipping_address">Shipping Address:</label>
                            <input type="text" id="shipping_address" name="shipping_address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code:</label>
                            <input type="text" id="postal_code" name="postal_code" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <input type="text" id="country" name="country" class="form-control" required>
                        </div>
                        <div class="order_button pt-3">
                            <input type="submit" value="Submit Order" id="submitOrderBtn" class="btn btn-md btn-black-default-hover w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?>
