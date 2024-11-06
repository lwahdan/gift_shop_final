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
                    <input type="text" class="form-control" placeholder="Search by ID, Username, Email, or Phone" id="userSearchInput" onkeyup="searchUsers()">
                </div>
            </div>
            <ul class="navbar-nav justify-content-end">
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
    <!-- Users Table Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header pb-0 p-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Users List</h6>
                    <button id="addUserBtn" class="status-badge status-black" onclick="toggleAddUserForm()">+ Add User</button>
                </div>

                <!-- Users Table -->
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="usersTable">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($users)) {
                                foreach ($users as $user): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($user['id']); ?></p>
                                        </td>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($user['username']); ?></p>
                                        </td>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($user['email']); ?></p>
                                        </td>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0"><?php echo htmlspecialchars($user['phone_number']); ?></p>
                                        </td>
                                        <td class="ps-4">
                                            <a href="/admin/users/toggleStatus/<?php echo $user['id']; ?>/<?php echo ($user['status'] == 1 ? '0' : '1'); ?>">
                          <span class="status-badge <?php echo ($user['status'] == 1 ? 'status-enabled' : 'status-disabled'); ?>">
                            <?php echo ($user['status'] == 1 ? 'Enabled' : 'Disabled'); ?>
                          </span>
                                            </a>
                                        </td>
                                        <td class="ps-4">
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
    function searchUsers() {
        const input = document.getElementById("userSearchInput").value.toLowerCase();
        const table = document.getElementById("usersTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
            const cells = rows[i].getElementsByTagName("td");
            let rowContainsSearchQuery = false;

            for (let j = 0; j < cells.length - 1; j++) { // Skip the last cell (Actions column)
                const cellText = cells[j].innerText.toLowerCase();
                if (cellText.includes(input)) {
                    rowContainsSearchQuery = true;
                    break;
                }
            }
            rows[i].style.display = rowContainsSearchQuery ? "" : "none";
        }
    }
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
