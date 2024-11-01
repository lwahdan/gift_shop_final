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
                                    <li><a href="/customers/index">Home</a></li>
                                    <li>Shop</li>
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
                <form action="/cart/remove" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
            
              <td class="product_thumb">
                 <img src="<?php echo $dir . urlencode($item['image_url']); ?>" alt="Product Image">
              </td>


            <td class="product_name"><?php echo htmlspecialchars($item['name']); ?></td>
            <td class="product-price">$<?php echo number_format($item['price'], 2); ?></td>
            <td class="product_quantity"><?php echo $item['quantity']; ?></td>
            <td class="product_total">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

                                </table>
                            </div>
                            <div class="cart_submit">
                                <button class="btn btn-md btn-golden" type="submit">Checkout</button>
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

               <!--coupon start leen-->
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code left" data-aos="fade-up" data-aos-delay="200">
                            <h3>Coupon</h3>
                            <div class="coupon_inner">
                                <p>Enter your coupon code if you have one.</p>
                                <input class="mb-2" placeholder="Coupon code" type="text">
                                <button type="submit" class="btn btn-md btn-golden">Apply coupon</button>

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
                    <!--coupon end leen-->
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
                                    <a href="#" class="btn btn-md btn-golden">Proceed to Checkout</a>
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