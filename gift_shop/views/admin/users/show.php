<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

<div class="container3">
    <!-- User Details Card -->
    <div class="user-card3">
        <h2>User Details</h2>
        <div class="user-info3">
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
            <p><strong>First Name:</strong> <?= htmlspecialchars($user['first_name']); ?></p>
            <p><strong>Last Name:</strong> <?= htmlspecialchars($user['last_name']); ?></p>
            <p><strong>Phone Number:</strong> <?= htmlspecialchars($user['phone_number']); ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($user['address']); ?></p>
            <p><strong>City:</strong> <?= htmlspecialchars($user['city']); ?></p>
            <p><strong>Postal Code:</strong> <?= htmlspecialchars($user['postal_code']); ?></p>
            <p><strong>Country:</strong> <?= htmlspecialchars($user['country']); ?></p>
            <p><strong>Status:</strong> <?= $user['status'] == 1 ? 'Active' : 'Inactive'; ?></p>
            <p><strong>Created At:</strong> <?= htmlspecialchars($user['created_at']); ?></p>
            <p><strong>Updated At:</strong> <?= htmlspecialchars($user['updated_at']); ?></p>
        </div>
    </div>

    <!-- Orders Section -->
    <h2>Orders</h2>
    <div class="cardBox3">
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="card3 order-card3">
                    <p><strong>Order ID:</strong> <?= htmlspecialchars($order['id']) ?></p>
                    <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>
                    <p><strong>Total Price:</strong> $<?= htmlspecialchars($order['total_price']) ?></p>
                    <!-- Other order information -->
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No orders found for this user.</p>
        <?php endif; ?>
    </div>

    <!-- Reviews Section -->
    <h2>Reviews</h2>
    <div class="cardBox3">
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="card3 review-card3">
                    <h4>Product ID: <?= htmlspecialchars($review['product_id']) ?></h4>
                    <p><?= htmlspecialchars($review['review_text']) ?></p>
                    <div class="rating-stars3">
                        <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                            <ion-icon name="star-sharp" style="color: gold"></ion-icon>
                        <?php endfor; ?>
                    </div>
                    <p class="review-date3"><?= htmlspecialchars($review['updated_at']) ?></p>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No reviews found for this user.</p>
        <?php endif; ?>
    </div>

    <a href="/admin/users" class="btn-blue">Back to Users List</a>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
