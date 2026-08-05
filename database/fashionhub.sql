
DROP DATABASE IF EXISTS fashionhub;
CREATE DATABASE fashionhub;
USE fashionhub;

CREATE TABLE users (
 user_id INT AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(100) NOT NULL,
 email VARCHAR(100) UNIQUE NOT NULL,
 password VARCHAR(255) NOT NULL,
 phone VARCHAR(20),
 address TEXT,
 role ENUM('customer','seller','admin') DEFAULT 'customer',
 status ENUM('Pending','Approved','Blocked') DEFAULT 'Pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories(
 category_id INT AUTO_INCREMENT PRIMARY KEY,
 category_name VARCHAR(100) UNIQUE NOT NULL,
 description TEXT
);

CREATE TABLE products(
 product_id INT AUTO_INCREMENT PRIMARY KEY,
 seller_id INT NOT NULL,
 category_id INT NOT NULL,
 product_name VARCHAR(150) NOT NULL,
 description TEXT,
 price DECIMAL(10,2) NOT NULL,
 stock INT DEFAULT 0,
 image VARCHAR(255),
 status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
 rejection_reason TEXT,
 approved_by INT NULL,
 approved_at TIMESTAMP NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (seller_id) REFERENCES users(user_id) ON DELETE CASCADE,
 FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE,
 FOREIGN KEY (approved_by) REFERENCES users(user_id) ON DELETE SET NULL
);

CREATE TABLE cart(
 cart_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL UNIQUE,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE cart_items(
 cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
 cart_id INT NOT NULL,
 product_id INT NOT NULL,
 quantity INT NOT NULL DEFAULT 1,
 FOREIGN KEY(cart_id) REFERENCES cart(cart_id) ON DELETE CASCADE,
 FOREIGN KEY(product_id) REFERENCES products(product_id) ON DELETE CASCADE,
 UNIQUE(cart_id,product_id)
);

CREATE TABLE orders(
 order_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 total_amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('Cash on Delivery','eSewa') NOT NULL,
 payment_status ENUM('Pending','Paid','Failed') DEFAULT 'Pending',
 order_status ENUM('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
 shipping_address TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE order_items(
 order_item_id INT AUTO_INCREMENT PRIMARY KEY,
 order_id INT NOT NULL,
 product_id INT NOT NULL,
 quantity INT NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 FOREIGN KEY(order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
 FOREIGN KEY(product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE payments(
 payment_id INT AUTO_INCREMENT PRIMARY KEY,
 order_id INT NOT NULL,
 transaction_id VARCHAR(100),
 amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('Cash on Delivery','eSewa') NOT NULL,
 payment_status ENUM('Pending','Completed','Failed','Refunded') DEFAULT 'Pending',
 paid_at TIMESTAMP NULL,
 FOREIGN KEY(order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);

CREATE TABLE reviews(
 review_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 product_id INT NOT NULL,
 rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
 comment TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE,
 FOREIGN KEY(product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Initial administrator account. The password is hashed; sign in with Admin@123.
INSERT INTO users (full_name, email, password, phone, address, role, status)
VALUES ('Ujjwal Jaiswal', 'ujwaljaiswal29@gmail.com', '$2y$12$C5STitZLLjhJuvga2xDqSePcHuvCilaqBebBpDsO8mgdUA5zV.eZq', '9860599493', 'Kathmandu', 'admin', 'Approved');

INSERT INTO categories (category_name, description) VALUES
('Men', 'Fashion for men'),
('Women', 'Fashion for women'),
('Kids', 'Fashion for kids'),
('Accessories', 'Fashion accessories');

USE fashionhub;

CREATE TABLE site_settings (
    setting_key VARCHAR(100) PRIMARY KEY,
    setting_value TEXT NOT NULL,
    updated_by INT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_settings_admin
        FOREIGN KEY (updated_by)
        REFERENCES users(user_id)
        ON DELETE SET NULL
);

INSERT INTO site_settings (setting_key, setting_value) VALUES
('website_name', 'FashionHub'),
('support_email', 'support@fashionhub.com'),
('contact_number', '9860599493'),
('store_address', 'Kathmandu, Nepal'),
('currency', 'NPR');

CREATE TABLE report_snapshots (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    report_type ENUM('daily', 'monthly', 'custom') NOT NULL,
    period_start DATE NOT NULL,
    period_end DATE NOT NULL,
    total_revenue DECIMAL(12,2) NOT NULL DEFAULT 0,
    total_orders INT NOT NULL DEFAULT 0,
    total_customers INT NOT NULL DEFAULT 0,
    products_sold INT NOT NULL DEFAULT 0,
    generated_by INT NULL,
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_report_admin
        FOREIGN KEY (generated_by)
        REFERENCES users(user_id)
        ON DELETE SET NULL
);
