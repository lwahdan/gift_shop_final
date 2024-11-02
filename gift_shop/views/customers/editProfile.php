<?php if (isset($_SESSION['message'])): ?>
            <div class="error-message" style="color:red;">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']); // Clear the message after displaying it
                ?>
            </div>
        <?php endif; ?>
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
    </table>
    <tr>
    <button id="editProfileBtn">Edit</button>
    <button id="changePasswordBtn">Change Password</button>
        </tr>
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
                <td colspan="2"><button type="submit">Save</button></td>
                <td colspan="2"> <button type="button" id="cancelEditBtn">Cancel</button></td>
            </tr>
        </table>
    </form>
</div>

<script>
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.querySelector('.profile-table').style.display = 'none';
        document.getElementById('editProfileForm').style.display = 'block';
    });
</script>
