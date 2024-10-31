<section>
    <div class="profile-form">
        <h2>Edit Profile</h2>
        <form action="/customers/saveProfile" method="POST">
            <p><label for="username"><strong>Username:</strong></label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required></p>

            <p><label for="email"><strong>Email:</strong></label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required></p>

            <p><label for="first_name"><strong>First Name:</strong></label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required></p>

            <p><label for="last_name"><strong>Last Name:</strong></label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required></p>

            <p><label for="phone_number"><strong>Phone Number:</strong></label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required></p>

            <p><label for="address"><strong>Address:</strong></label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required></p>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</section>
