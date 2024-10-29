<?php

class Dashboard {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "gift_shop";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function totalUsers() {
        $query = "SELECT COUNT(*) AS total FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function totalCoupons() {
        $query = "SELECT COUNT(*) AS total FROM coupons";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function totalProducts() {
        $query = "SELECT COUNT(*) AS total FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function totalComments() {
        $query = "SELECT COUNT(*) AS total FROM reviews";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function displayAllComments() {
        $query = "SELECT id, review_text, user_id, product_id, updated_at FROM reviews ORDER BY updated_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<div class="cardBox">';
        foreach ($comments as $comment) {
            echo '
        <div class="card">
            <div>
                <div class="numbers"><h6> ' . htmlspecialchars($comment['id']) . ': ' . htmlspecialchars($comment['review_text']) . '</h6></div>
                <div class="cardName">User: ' . htmlspecialchars($comment['user_id']) . ' | ProID: ' . htmlspecialchars($comment['product_id']) . ' | ' . htmlspecialchars($comment['updated_at']) . '</div>
            </div>
            <div class="iconBx">
                <ion-icon name="chatbubbles-outline"></ion-icon>
            </div>
        </div>';
        }
        echo '</div>';
    }
    public function displayAllCoupons() {
        $query = "SELECT id, code, discount_type,discount_value,expiration_date,is_active, status , updated_at FROM coupons ORDER BY updated_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<div class="cardBox">';
        foreach ($coupons as $coupon) {
            $type="";
            if($coupon['discount_type'] == 'Percentage') {
                $type="%";
            }else{
                $type="JOD";
            }
            echo '
        <div class="card">
            <div>
                <div class="numbers2"> <h1>' . htmlspecialchars($coupon['discount_value']) . $type .'</h1><h3>code ' . htmlspecialchars($coupon['id']) . ' : ' . htmlspecialchars($coupon['code']) . '</h3></div>
                <div class="cardName"> '. htmlspecialchars($coupon['updated_at']) . '
                    
          
                </div>
       
            </div>
            <div class="iconBx">
                  <ion-icon name="pricetags-outline"></ion-icon>
              
                   <button class="btn-danger" value="Disable">Disable</button>
            </div>
            
        </div>';
        }
        echo '</div>';
    }

    public function displayUserTable() {
        $query = "SELECT * FROM users ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '
        <div class="container-table">
            <h2 class="mb-4">Users List</h2>
            <br>
            <button id="addUserBtn" class="btn-blue">+Add User</button>
            <br><br>

            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Postal Code</th>
                        <th scope="col">Country</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($users as $user) {
            echo '
            <tr>
                <td data-label="User ID">' . $user['id'] . '</td>
                <td data-label="Username">' . $user['username'] . '</td>
                <td data-label="Email">' . $user['email'] . '</td>
                <td data-label="First Name">' . $user['first_name'] . '</td>
                <td data-label="Last Name">' . $user['last_name'] . '</td>
                <td data-label="Phone Number">' . $user['phone_number'] . '</td>
                <td data-label="Address">' . $user['address'] . '</td>
                <td data-label="City">' . $user['city'] . '</td>
                <td data-label="Postal Code">' . $user['postal_code'] . '</td>
                <td data-label="Country">' . $user['country'] . '</td>
                <td data-label="Created At">' . $user['created_at'] . '</td>
                <td data-label="Actions">
                    <a href="../../views/pages/users.view.php?id=' . $user['id'] . '&status=' . ($user['status'] == 1 ? '0' : '1') . '" 
                    class="' . ($user['status'] == 1 ? 'btn-danger' : 'btn-Green') . '" 
   >
                        ' . ($user['status'] == 1 ? 'Disable' : 'Enable') . '
                    </a>
                </td>
            </tr>';
        }

        echo '
                </tbody>
            </table>
        </div>';
    }

    public function addUser($username, $email, $password, $first_name, $last_name, $phone_number, $address, $city, $postal_code, $country, $status = 1) {
        $query = "INSERT INTO users (username, email, password, first_name, last_name, phone_number, address, city, postal_code, country, status) 
              VALUES (:username, :email, :password, :first_name, :last_name, :phone_number, :address, :city, :postal_code, :country, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':status', $status);

        $stmt->execute();
    }

    public function toggleUserStatus($id, $status) {

        $query = "UPDATE users SET status = $status  WHERE id = $id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function getCategories() {
        $query = "SELECT * FROM categories ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>
