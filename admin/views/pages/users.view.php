
<div id="addUserForm" style="display: none;">
    <h2>Add User</h2>
    <form method="POST" action="../../views/pages/users.view.php">
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

<div>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/dashboard.php";

    $obj = new Dashboard();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
        $obj->addUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['phone_number'], $_POST['address'], $_POST['city'], $_POST['postal_code'], $_POST['country']);
        header("Location: ../../");

        exit();

    }


    if (isset($_GET['id']) && isset($_GET['status'])) {

        $user_id = (int) $_GET['id'];
        $status = (int) $_GET['status'];
        $obj->toggleUserStatus($user_id, $status);
        header("Location: ../../");

        exit();
    }

    $obj->displayUserTable();

    ?>
</div>
