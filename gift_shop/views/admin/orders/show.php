<?php
$order_active = "active";

require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="card2">

    <h1 class="card-title2">Order Details</h1>

    <p><strong>Order ID:</strong> <?= htmlspecialchars($order['id']) ?></p>
    <p><strong>User ID:</strong> <?= htmlspecialchars($order['user_id']) ?></p>
    <p><strong>Total Price:</strong> <?= htmlspecialchars($order['total_price']) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>
    <p><strong>Shipping Address:</strong> <?= htmlspecialchars($order['shipping_address']) ?></p>
    <p><strong>City:</strong> <?= htmlspecialchars($order['city']) ?></p>
    <p><strong>Postal Code:</strong> <?= htmlspecialchars($order['postal_code']) ?></p>
    <p><strong>Country:</strong> <?= htmlspecialchars($order['country']) ?></p>

    <a href="/admin/orders" class="btn-back2">Back to Orders</a>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
