<?php
$order_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center font-weight-light my-2">Edit Order #<?= htmlspecialchars($order['id']) ?></h3>
                    </div>
                    <div class="card-body p-4">
                        <!-- Error Alert -->
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $_SESSION['error']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <?php unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="/admin/orders/update/<?= htmlspecialchars($order['id']) ?>" class="needs-validation" novalidate>
                            <?php if(isset($_SESSION['csrf_token'])): ?>
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <?php endif; ?>

                            <div class="row">
                                <!-- User ID and Total Price -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="user_id" name="user_id"
                                               value="<?= htmlspecialchars($order['user_id']) ?>" required>
                                        <label for="user_id">User ID</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="number" step="0.01" class="form-control" id="total_price"
                                               name="total_price" value="<?= htmlspecialchars($order['total_price']) ?>" required>
                                        <label for="total_price">Total Price ($)</label>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-12 mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="status" name="status" required>
                                            <?php
                                            $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
                                            foreach($statuses as $status):
                                                $selected = ($order['status'] == $status) ? 'selected' : '';
                                                ?>
                                                <option value="<?= $status ?>" <?= $selected ?>><?= $status ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="status">Order Status</label>
                                    </div>
                                </div>

                                <!-- Shipping Address -->
                                <div class="col-12 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="shipping_address"
                                               name="shipping_address" value="<?= htmlspecialchars($order['shipping_address']) ?>" required>
                                        <label for="shipping_address">Shipping Address</label>
                                    </div>
                                </div>

                                <!-- City, Postal Code, Country -->
                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="city" name="city"
                                               value="<?= htmlspecialchars($order['city']) ?>" required>
                                        <label for="city">City</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                                               value="<?= htmlspecialchars($order['postal_code']) ?>" required>
                                        <label for="postal_code">Postal Code</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="country" name="country"
                                               value="<?= htmlspecialchars($order['country']) ?>" required>
                                        <label for="country">Country</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a href="/admin/orders" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Orders
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles for the form */
        .form-floating > label {
            padding-left: 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .card {
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, #0d6efd, #0b5ed7);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0b5ed7, #0a58ca);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #6c757d, #5a6268);
            border: none;
        }

        .btn-secondary:hover {
            background: linear-gradient(45deg, #5a6268, #494f54);
            transform: translateY(-1px);
        }

        /* Form validation styles */
        .was-validated .form-control:valid,
        .was-validated .form-select:valid {
            border-color: #198754;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .card-header {
            border-bottom: none;
            border-radius: calc(0.5rem - 1px) calc(0.5rem - 1px) 0 0;
        }
    </style>

    <script>
        // Form validation script
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>