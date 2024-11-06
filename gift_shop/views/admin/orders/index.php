<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="container-table">
    <h1>All Orders</h1>


    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($orders)) {
            foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['id']) ?></td>
                    <td><?= htmlspecialchars($order['user_id']) ?></td>
                    <td><?= htmlspecialchars($order['total_price']) ?></td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td>
                        <a href="/admin/orders/show/<?= $order['id'] ?>" class="btn-Green">View</a> |
                        <a href="/admin/orders/edit/<?= $order['id'] ?>" class="btn-blue">Edit</a> |
                        <a href="/admin/orders/delete/<?= $order['id'] ?>" class="btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach;
        } ?>
        <tr>
            <td class="footer-table"   colspan="7";>

            </td>
        </tr>

        </tbody>
    </table>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
