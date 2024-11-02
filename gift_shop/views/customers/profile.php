<?php require 'views/partials/header.php'; ?>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">My Account</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="/customers/index">Home</a></li>
                                <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                <li class="active" aria-current="page">My Account</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Account Dashboard Section:::... -->
<div class="account-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li><a href="#dashboard" data-bs-toggle="tab"
                                class="nav-link btn btn-block btn-md btn-black-default-hover active">Dashboard</a>
                        </li>
                        <li><a href="#orders" data-bs-toggle="tab"
                                class="nav-link btn btn-block btn-md btn-black-default-hover">Orders</a></li>
                        <li><a href="#address" data-bs-toggle="tab"
                                class="nav-link btn btn-block btn-md btn-black-default-hover">Addresses</a></li>
                        <li><a href="/customers/logout"
                                class="nav-link btn btn-block btn-md btn-black-default-hover">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade show active" id="dashboard">
                        <section>
                            <div class="account-dashboard">
                                <div class="container">
                                    <div class="profile-form">
                                        <div class="profile-table">
                                            <table>
                                                <tr>
                                                    <td><strong>Username</strong></td>
                                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email</strong></td>
                                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Full Name</strong></td>
                                                    <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone Number</strong></td>
                                                    <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Address</strong></td>
                                                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><button id="editProfileBtn">Edit</button></td>
                                                    <td><button id="changePasswordBtn">Change Password</button></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div id="changePasswordForm" style="display:none;">
                                        <form action="/auth/changePassword" method="POST">
                                            <?php
                                            // Display message if it exists
                                            if (isset($_SESSION['message'])) {
                                                echo '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>';
                                                unset($_SESSION['message']); // Clear the message after displaying it
                                            }
                                            ?>
                                            <label for="currentPassword">Current Password:</label>
                                            <input type="password" name="currentPassword" required>
                                            
                                            <label for="newPassword">New Password:</label>
                                            <input type="password" name="newPassword" required>
                                            
                                            <label for="confirmPassword">Confirm New Password:</label>
                                            <input type="password" name="confirmPassword" required>

                                            <button type="submit">Change Password</button>
                                            <button type="button" id="cancelPasswordChangeBtn">Cancel</button>
                                        </form>

                                        <?php if (isset($errorMessage)) : ?>
                                            <div class="error-message"><?= htmlspecialchars($errorMessage) ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div id="editProfileForm" style="display:none;">
                                        <form action="/profile/updateProfile" method="POST">
                                            <table>
                                                <tr>
                                                    <td><label for="username">Username:</label></td>
                                                    <td><input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="email">Email:</label></td>
                                                    <td><input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="first_name">First Name:</label></td>
                                                    <td><input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="last_name">Last Name:</label></td>
                                                    <td><input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="phone_number">Phone Number:</label></td>
                                                    <td><input type="tel" name="phone_number" id="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="address">Address:</label></td>
                                                    <td><input type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['address']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="city">City:</label></td>
                                                    <td><input type="text" name="city" id="city" value="<?php echo htmlspecialchars($user['city']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="postal_code">Postal Code:</label></td>
                                                    <td><input type="text" name="postal_code" id="postal_code" value="<?php echo htmlspecialchars($user['postal_code']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="country">Country:</label></td>
                                                    <td><input type="text" name="country" id="country" value="<?php echo htmlspecialchars($user['country']); ?>" required></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><button type="submit">Save</button></td>
                                                    <td colspan="2"><button type="button" id="cancelEditBtn">Cancel</button></td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="tab-pane fade" id="orders">
                        <h4>Orders</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>May 10, 2018</td>
                                        <td><span class="success">Completed</span></td>
                                        <td>$25.00 for 1 item</td>
                                        <td><a href="cart.php" class="view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>May 10, 2018</td>
                                        <td>Processing</td>
                                        <td>$17.00 for 1 item</td>
                                        <td><a href="cart.php" class="view">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="downloads">
                        <h4>Downloads</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Downloads</th>
                                        <th>Expires</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Product A</td>
                                        <td>May 10, 2018</td>
                                        <td>Never</td>
                                        <td><a href="#">Download</a></td>
                                    </tr>
                                    <tr>
                                        <td>Product B</td>
                                        <td>May 10, 2018</td>
                                        <td>Never</td>
                                        <td><a href="#">Download</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="address">
                        <h4>Address</h4>
                        <div class="address-wrapper">
                            <p class="address"><strong>Your current address:</strong> 123 Main Street, City, Country</p>
                            <button type="button" class="btn btn-md btn-black-default-hover">Edit Address</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Account Dashboard Section:::... -->

<?php require 'views/partials/footer.php'; ?>

<script>
    document.getElementById('changePasswordBtn').addEventListener('click', function() {
        document.querySelector('.profile-table').style.display = 'none'; // Hide the profile table
        document.getElementById('changePasswordForm').style.display = 'block'; // Show the change password form
    });

    document.getElementById('cancelPasswordChangeBtn').addEventListener('click', function() {
        document.getElementById('changePasswordForm').style.display = 'none'; // Hide the change password form
        document.querySelector('.profile-table').style.display = 'block'; // Show the profile table again
    });

    // Add event listener for edit button to toggle edit profile form
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.querySelector('.profile-table').style.display = 'none'; // Hide the profile table
        document.getElementById('editProfileForm').style.display = 'block'; // Show the edit profile form
    });

    document.getElementById('cancelEditBtn').addEventListener('click', function() {
        document.getElementById('editProfileForm').style.display = 'none'; // Hide the edit profile form
        document.querySelector('.profile-table').style.display = 'block'; // Show the profile table again
    });
</script>
