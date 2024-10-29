<h1>Manage Orders</h1>

<!-- Create New Order Form -->
<h2>Create New Order</h2>
<form action="" method="post">
    <input type="hidden" name="action" value="create">
    <label for="user_id">User ID:</label>
    <input type="text" name="user_id" required>
    <label for="status">Status:</label>
    <input type="text" name="status" required>
    <button type="submit">Create Order</button>
</form>

<!-- Orders List -->
<h2>Your Orders</h2>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
                <td>
                    <!-- Cancel Order -->
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="cancel">
                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']) ?>">
                        <button type="submit" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel</button>
                    </form>
                    <!-- Update Status -->
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['order_id']) ?>">
                        <input type="text" name="status" placeholder="New Status" required>
                        <button type="submit">Update Status</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>