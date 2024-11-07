<?php
$order_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<style>
    /* Modern Gradient Status Badges */
    .badge {
        padding: 8px 12px;
        font-size: 12px;
        border-radius: 6px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .bg-success {
        background: linear-gradient(45deg, #28a745, #20c997) !important;
        color: white;
    }

    .bg-warning {
        background: linear-gradient(45deg, #ffc107, #fd7e14) !important;
        color: #000;
    }

    .bg-danger {
        background: linear-gradient(45deg, #dc3545, #c82333) !important;
        color: white;
    }

    .bg-secondary {
        background: linear-gradient(45deg, #6c757d, #5a6268) !important;
        color: white;
    }

    /* Hover Animation */
    .badge {
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
    <div class="container py-5">
        <div class="card shadow">
            <!-- Invoice Header -->
            <div class="card-header bg-primary text-white">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="mb-0">Purchase Invoice</h4>
                    </div>
                    <div class="col-4 text-end">
                        <h5 class="mb-0">Invoice #<?= htmlspecialchars($order['id']) ?></h5>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Customer Info -->
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>Your Company Name</strong>
                        </div>
                        <div>123 Business Street</div>
                        <div>Business City, 12345</div>
                        <div>Email: contact@company.com</div>
                        <div>Phone: (123) 456-7890</div>
                    </div>

                    <div class="col-sm-6 text-sm-end">
                        <h6 class="mb-3">Bill To:</h6>
                        <div><strong>Customer ID:</strong> <?= htmlspecialchars($order['user_id']) ?></div>
                        <div><?= htmlspecialchars($order['shipping_address']) ?></div>
                        <div><?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['postal_code']) ?></div>
                        <div><?= htmlspecialchars($order['country']) ?></div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                <tr>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
                                    <th>Coupon Applied</th>
                                    <th>Total Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?= htmlspecialchars($order['order_date']) ?></td>
                                    <td>
                                        <?php
                                        $statusClasses = array(
                                            'delivered' => 'success',
                                            'pending' => 'warning',
                                            'cancelled' => 'danger'
                                        );
                                        $status = strtolower($order['status']);
                                        $statusClass = isset($statusClasses[$status]) ? $statusClasses[$status] : 'secondary';
                                        ?>
                                        <span class="badge bg-<?= $statusClass ?>">
                                            <?= htmlspecialchars(ucfirst($order['status'])) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($order['payment_method']) ?></td>
                                    <td><?= $order['coupon_id'] ? 'Yes (ID: ' . htmlspecialchars($order['coupon_id']) . ')' : 'No' ?></td>
                                    <td class="text-end">$<?= number_format($order['total_price'], 2) ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Shipping Address</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-1"><?= htmlspecialchars($order['shipping_address']) ?></p>
                                <p class="mb-1"><?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['postal_code']) ?></p>
                                <p class="mb-0"><?= htmlspecialchars($order['country']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Payment Summary</h6>
                            </div>
                            <div class="card-body">
                                <?php if ($order['coupon_id']): ?>
                                    <p class="mb-1">Original Price: $<?= number_format($order['total_price'] * 1.1, 2) ?></p>
                                    <p class="mb-1">Coupon Discount: -$<?= number_format($order['total_price'] * 0.1, 2) ?></p>
                                <?php endif; ?>
                                <p class="mb-0"><strong>Final Total: $<?= number_format($order['total_price'], 2) ?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <a href="/admin/orders" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Back to Orders
                            </a>
                            <button class="btn btn-primary" onclick="window.print()">
                                <i class="fas fa-print"></i> Print Invoice
                            </button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>