<?php
$order_active = "active";

require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<div class="form-container">
    <h2 class="form-title">Edit Order</h2>
    <form method="POST" action="/admin/orders/edit/<?= htmlspecialchars($order['id']) ?>" class="coupon-form">

        <div class="form-group">
            <label class="form-label" for="user_id">User ID:</label>
            <input type="number" name="user_id" class="form-control" value="<?= htmlspecialchars($order['user_id']) ?>" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="total_price">Total Price:</label>
            <input type="number" step="0.01" name="total_price" class="form-control" value="<?= htmlspecialchars($order['total_price']) ?>" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="Pending" <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Processing" <?= $order['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                <option value="Shipped" <?= $order['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                <option value="Delivered" <?= $order['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                <option value="Cancelled" <?= $order['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="shipping_address">Shipping Address:</label>
            <input type="text" name="shipping_address" class="form-control" value="<?= htmlspecialchars($order['shipping_address']) ?>">
        </div>

        <div class="form-group">
            <label class="form-label" for="city">City:</label>
            <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($order['city']) ?>">
        </div>

        <div class="form-group">
            <label class="form-label" for="postal_code">Postal Code:</label>
            <input type="text" name="postal_code" class="form-control" value="<?= htmlspecialchars($order['postal_code']) ?>">
        </div>

        <div class="form-group">
            <label class="form-label" for="country">Country:</label>
            <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($order['country']) ?>">
        </div>

        <button type="submit" class="form-button">Update Order</button>
    </form>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
