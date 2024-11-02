<?php require 'views/partials/header.php'; ?>

<?php
// Retrieve cart items from the cookie
$cartItems = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Initialize subtotal and shipping
$subtotal = 0.00;
$shipping = 50.00;
$discount = isset($_COOKIE['discount']) ? (float)$_COOKIE['discount'] : 0.00;

// Calculate subtotal from cart items
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

// Calculate final order total
$orderTotal = $subtotal - $discount + $shipping;
?>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Checkout</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                <li class="active" aria-current="page">Checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Checkout Section:::... -->
<div id="mycheckout">
    <div class="checkout-section">
        <div class="container">
            <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
                <div class="row">
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
<!-- ...:::: End Checkout Section:::... -->

<?php require 'views/partials/footer.php'; ?>
