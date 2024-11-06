<?php
$user_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Users</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Users</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="userSearchInput" placeholder="Search by ID, Username, Email, or Phone" onkeyup="filterUsers()">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="/admin/logout" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<div class="container-fluid py-4">
    <!-- User Stats Cards Row -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <span class="mask bg-primary opacity-10 border-radius-lg"></span>
            </div>
        </div>
    </div>

    <!-- Users Table Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header pb-0 p-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Users List</h6>
                    <button id="addUserBtn" class="status-badge status-black" onclick="toggleAddUserForm()">
                        + Add User
                    </button>
                </div>

                <!-- Add User Form -->
                <div id="addForm" class="card-body pt-0 pb-2" style="display: none;">
                    <div class="p-3 bg-light border-radius-lg">
                        <h6 class="mb-3">Add New User</h6>
                        <form method="POST" action="/admin/users/create">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="postal_code" placeholder="Postal Code" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="city" placeholder="City" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="country" placeholder="Country" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="status-badge status-disabled" onclick="toggleAddUserForm()">Cancel</button>
                                <button type="submit" class="status-badge status-enabled">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Users Table -->
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="userTableBody">
                            <?php if (isset($users)) {
                                foreach ($users as $user): ?>
                                    <tr class="user-row"
                                        data-id="<?php echo $user['id']; ?>"
                                        data-username="<?php echo htmlspecialchars($user['username']); ?>"
                                        data-email="<?php echo htmlspecialchars($user['email']); ?>"
                                        data-phone="<?php echo htmlspecialchars($user['phone_number']); ?>">
                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                                        <td>
                                            <a href="/admin/users/toggleStatus/<?php echo $user['id']; ?>/<?php echo ($user['status'] == 1 ? '0' : '1'); ?>">
                                                    <span class="status-badge <?php echo ($user['status'] == 1 ? 'status-enabled' : 'status-disabled'); ?>">
                                                        <?php echo ($user['status'] == 1 ? 'Enabled' : 'Disabled'); ?>
                                                    </span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/admin/users/show/<?php echo $user['id']; ?>">
                                                <span class="status-badge status-blue">View</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filterUsers() {
        const searchInput = document.getElementById("userSearchInput").value.toLowerCase();
        const rows = document.querySelectorAll(".user-row");

        rows.forEach(row => {
            const id = row.getAttribute("data-id").toLowerCase();
            const username = row.getAttribute("data-username").toLowerCase();
            const email = row.getAttribute("data-email").toLowerCase();
            const phone = row.getAttribute("data-phone").toLowerCase();

            if (
                id.includes(searchInput) ||
                username.includes(searchInput) ||
                email.includes(searchInput) ||
                phone.includes(searchInput)
            ) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function toggleAddUserForm() {
        const addForm = document.getElementById("addForm");
        addForm.style.display = addForm.style.display === "none" ? "block" : "none";
    }
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
