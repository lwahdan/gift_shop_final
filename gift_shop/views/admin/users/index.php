<?php
$user_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

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
                <button type="button" class="status-disabled" onclick="toggleAddUserForm()">Cancel</button>
                <button type="submit" class="status-enabled">Add User</button>
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
                        <p class="text-xs font-weight-bold mb-0"><?php echo $user['id']; ?></p>
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
                      <a href="/admin/users/show/<?php echo $user['id'] ?>">
                        <span class="status-badge status-blue">
                        View
                        </span>
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
document.getElementById("addUserBtn").onclick = function () {
    document.getElementById("addForm").style.display = "block";
};

document.getElementById("AddAdminBtn").onclick = function () {
    document.getElementById("addForm").style.display = "block";
};

function toggleAddUserForm() {
    document.getElementById("addForm").style.display = "none";
}
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>