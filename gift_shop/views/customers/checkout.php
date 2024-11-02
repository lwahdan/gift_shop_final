<?php require 'views/partials/header.php'; ?>

<?php
// Retrieve updated cart items from the cookie
$cartItems = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Initialize subtotal, shipping, and discount
$subtotal = 0.00;
$shipping = 50.00;
$discount = isset($_COOKIE['discount']) ? (float)$_COOKIE['discount'] : 0.00;

// Calculate subtotal based on updated cart items
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

// Calculate the final order total
$orderTotal = $subtotal - $discount + $shipping;
?>

<!-- HTML for checkout page -->
<div class="checkout-section">
    <div class="container">
        <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
            <div class="row">
                <div id="mycheckout">
                <div class="col-lg-6 col-md-6">
                    <form action="#">
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
                        <div class="payment_method">
                            <div class="order_button pt-3">
                                <button class="btn btn-md btn-black-default-hover" type="button" onclick="submitOrder()">SUBMIT ORDER</button>
                            </div>
                        </div>
                    </form>
                </div>
                                    </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?>
