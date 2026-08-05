<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    private $conn;
    private $table = "users";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    /**
     * Register Customer or Seller
     */
    public function register($data)
{
    $query = "INSERT INTO {$this->table}
            (full_name,email,password,phone,address,role,status)
            VALUES
            (:full_name,:email,:password,:phone,:address,:role,:status)";

    $stmt = $this->conn->prepare($query);

    $hashedPassword = password_hash(
        $data['password'],
        PASSWORD_DEFAULT
    );

    // Sellers must be able to sign in and submit their first product.
    // Products—not seller accounts—go through the admin approval gate.
    $status = 'Approved';

    return $stmt->execute([
        ':full_name' => $data['full_name'],
        ':email' => $data['email'],
        ':password' => $hashedPassword,
        ':phone' => $data['phone'],
        ':address' => $data['address'],
        ':role' => $data['role'],
        ':status' => $status
    ]);
}

    /**
     * Find User by Email
     */
    public function findByEmail($email)
    {
        $query = "SELECT * FROM {$this->table}
                  WHERE email = :email
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Login User
     */
    public function login($email, $password)
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        if ($user['status'] != 'Approved') {
            return false;
        }

        return $user;
    }

    /**
     * Get User By ID
     */
    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table}
                  WHERE user_id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':id'=>$id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get All Sellers
     */
    public function getPendingSellers()
    {
        $query = "SELECT *
                  FROM {$this->table}
                  WHERE role='seller'
                  AND status='Pending'
                  ORDER BY created_at DESC";

        return $this->conn
                    ->query($query)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Approve Seller
     */
    public function approveSeller($id)
    {
        $query = "UPDATE {$this->table}
                  SET status='Approved'
                  WHERE user_id=:id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':id'=>$id
        ]);
    }

    /**
     * Block User
     */
    public function blockUser($id)
    {
        $query = "UPDATE {$this->table}
                  SET status='Blocked'
                  WHERE user_id=:id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':id'=>$id
        ]);
    }

}
?>
