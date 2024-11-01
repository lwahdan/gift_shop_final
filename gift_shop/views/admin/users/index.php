<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
    <div id="addUserForm" style="display: none;">
        <h2>Add User</h2>
        <form method="POST" action="/admin/users/create">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="text" name="first_name" placeholder="First Name" required><br>
            <input type="text" name="last_name" placeholder="Last Name" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <input type="text" name="postal_code" placeholder="Postal Code" required><br>
            <input type="text" name="phone_number" placeholder="Phone Number" required><br>
            <input type="text" name="city" placeholder="City" required><br>
            <input type="text" name="country" placeholder="Country" required><br>
            <button type="submit">Add User</button>
            <button type="button" onclick="toggleAddUserForm()">Cancel</button>
        </form>
    </div>

<div class="container-table">
    <h2 class="mb-4">Users List</h2>
    <button id="addUserBtn" class="btn-blue" onclick="toggleAddUserForm()">+Add User</button>
<br><br>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($users)) {
            foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                    <td>
                        <a href="/admin/users/status?id=<?php echo $user['id']; ?>&status=<?php echo ($user['status'] == 1 ? '0' : '1'); ?>"
                           class="<?php echo ($user['status'] == 1 ? 'btn-danger' : 'btn-Green'); ?>">
                            <?php echo ($user['status'] == 1 ? 'Disable' : 'Enable'); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach;
        } ?>
        </tbody>
    </table>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>