<?php

require_once __DIR__ . '/../config/database.php';

class Product
{
    private $conn;
    private $table = "products";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    /*
    |--------------------------------------------------------------------------
    | Create Product
    |--------------------------------------------------------------------------
    */
    public function create($data)
    {
        $query = "INSERT INTO {$this->table}
        (
            seller_id,
            category_id,
            product_name,
            description,
            price,
            stock,
            image,
            status
        )
        VALUES
        (
            :seller_id,
            :category_id,
            :product_name,
            :description,
            :price,
            :stock,
            :image,
            'Pending'
        )";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':seller_id'    => $data['seller_id'],
            ':category_id'  => $data['category_id'],
            ':product_name' => $data['product_name'],
            ':description'  => $data['description'],
            ':price'        => $data['price'],
            ':stock'        => $data['stock'],
            ':image'        => $data['image']
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get All Products
    |--------------------------------------------------------------------------
    */
    public function getAll()
    {
        $query = "SELECT
                    p.*,
                    c.category_name,
                    u.full_name AS seller_name
                  FROM products p
                  JOIN categories c
                    ON p.category_id = c.category_id
                  JOIN users u
                    ON p.seller_id = u.user_id
                  ORDER BY p.created_at DESC";

        return $this->conn
                    ->query($query)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Approved Products
    |--------------------------------------------------------------------------
    */
    public function getApproved()
    {
        $query = "SELECT
                    p.*,
                    c.category_name
                  FROM products p
                  JOIN categories c
                    ON p.category_id = c.category_id
                  WHERE p.status='Approved'
                  ORDER BY p.created_at DESC";

        return $this->conn
                    ->query($query)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Pending Products
    |--------------------------------------------------------------------------
    */
    public function getPending()
    {
        $query = "SELECT
                    p.*,
                    c.category_name,
                    u.full_name AS seller_name
                  FROM products p
                  JOIN categories c
                    ON p.category_id = c.category_id
                  JOIN users u
                    ON p.seller_id = u.user_id
                  WHERE p.status='Pending'
                  ORDER BY p.created_at DESC";

        return $this->conn
                    ->query($query)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Seller Products
    |--------------------------------------------------------------------------
    */
    public function getSellerProducts($seller_id)
    {
        $query = "SELECT
                    p.*,
                    c.category_name
                  FROM products p
                  JOIN categories c
                    ON p.category_id = c.category_id
                  WHERE p.seller_id=:seller_id
                  ORDER BY p.created_at DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':seller_id' => $seller_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Product By ID
    |--------------------------------------------------------------------------
    */
    // public function getById($id)
    // {
    //     $query = "SELECT *
    //               FROM products
    //               WHERE product_id=:id
    //               LIMIT 1";

    //     $stmt = $this->conn->prepare($query);

    //     $stmt->execute([
    //         ':id' => $id
    //     ]);

    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    /*
    |--------------------------------------------------------------------------
    | Update Product
    |--------------------------------------------------------------------------
    */
    public function update($data)
    {
        $query = "UPDATE products
                  SET
                    category_id=:category_id,
                    product_name=:product_name,
                    description=:description,
                    price=:price,
                    stock=:stock,
                    image=:image,
                    status='Pending'
                  WHERE product_id=:product_id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':category_id' => $data['category_id'],
            ':product_name'=> $data['product_name'],
            ':description' => $data['description'],
            ':price'       => $data['price'],
            ':stock'       => $data['stock'],
            ':image'       => $data['image'],
            ':product_id'  => $data['product_id']
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Product
    |--------------------------------------------------------------------------
    */
    public function delete($id)
    {
        $query = "DELETE FROM products
                  WHERE product_id=:id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':id'=>$id
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Approve Product
    |--------------------------------------------------------------------------
    */
    public function approve($product_id, $admin_id)
    {
        $query = "UPDATE products
                  SET
                    status='Approved',
                    approved_by=:admin,
                    approved_at=NOW(),
                    rejection_reason=NULL
                  WHERE product_id=:id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':admin'=>$admin_id,
            ':id'=>$product_id
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Reject Product
    |--------------------------------------------------------------------------
    */
    public function reject($product_id, $reason)
    {
        $query = "UPDATE products
                  SET
                    status='Rejected',
                    rejection_reason=:reason
                  WHERE product_id=:id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':reason'=>$reason,
            ':id'=>$product_id
        ]);
    }
    /**
 * Get All Approved Products
 */
public function getApprovedProducts()
{
    $query = "SELECT
                p.*,
                c.category_name,
                u.full_name AS seller_name
              FROM products p
              INNER JOIN categories c
                    ON p.category_id = c.category_id
              INNER JOIN users u
                    ON p.seller_id = u.user_id
              WHERE p.status='Approved'
              ORDER BY p.created_at DESC";

    return $this->conn
                ->query($query)
                ->fetchAll(PDO::FETCH_ASSOC);
}
public function getById($id)
{
    $query = "SELECT
                p.*,
                c.category_name,
                u.full_name AS seller_name
              FROM products p
              INNER JOIN categories c
                    ON p.category_id = c.category_id
              INNER JOIN users u
                    ON p.seller_id = u.user_id
              WHERE p.product_id = :id
              LIMIT 1";

    $stmt = $this->conn->prepare($query);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>