<?php
$user_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

<div class="container py-4">
    <!-- User Details Card -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">
            <h4>User Details</h4>
        </div>
        <div class="card-body">
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
    <h4 class="mb-3">Orders</h4>
    <div class="row mb-4">
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p><strong>Order ID:</strong> <?= htmlspecialchars($order['id']) ?></p>
                            <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
                            <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>
                            <p><strong>Total Price:</strong> $<?= htmlspecialchars($order['total_price']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted">No orders found for this user.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Reviews Section -->
    <h4 class="mb-3">Reviews</h4>
    <div class="row mb-4">
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Product ID: <?= htmlspecialchars($review['product_id']) ?></h5>
                            <p><?= htmlspecialchars($review['review_text']) ?></p>
                            <div class="d-flex">
                                <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                    <ion-icon name="star-sharp" style="color: gold"></ion-icon>
                                <?php endfor; ?>
                            </div>
                            <p class="text-muted mt-2"><?= htmlspecialchars($review['updated_at']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-muted">No reviews found for this user.</p>
            </div>
        <?php endif; ?>
    </div>

    <a href="/admin/users" class="btn btn-primary mt-3">Back to Users List</a>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
