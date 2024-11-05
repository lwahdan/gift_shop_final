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
        <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
            
            <div class="row">
                <div class="col-lg-6 col-md-6 orderall">
                    <h3>Your order</h3>
                    <div class="order_table table-responsive">
                        <table>
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
                    <div id="myorder">
                    <div class="payment_method">
                        <h3>Shipping Information</h3>
                        <form action="/order/submit" method="GET" onsubmit="handleSubmit()">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="shipping_address">Shipping Address:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="shipping_address" name="shipping_address" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="city">City:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="city" name="city" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="postal_code">Postal Code:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="postal_code" name="postal_code" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="country">Country:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="country" name="country" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Submit button -->
                            <div class="order_button pt-3">
                                <input type="submit" value="Submit Order" class="btn btn-md btn-black-default-hover">
                            </div>
                        </form>
                    </div>
                    </div>

                </div>
            </div>
            

        </div>
    </div>
</div>


<?php require 'views/partials/footer.php'; ?>
