-- Tạo cơ sở dữ liệu nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS ecommerce;
USE ecommerce;
-- Bảng categories - lưu danh mục sản phẩm
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Bảng brands - lưu thông tin về thương hiệu
CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Bảng products - lưu thông tin về sản phẩm
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    brand_id INT,
    name VARCHAR(100) NOT NULL,
    thumbnail_url VARCHAR(255),
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE
    SET NULL,
        FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE
    SET NULL
);
-- Bảng product_images - lưu hình ảnh sản phẩm
CREATE TABLE product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    image_url VARCHAR(255) NOT NULL,
    is_main TINYINT(1) DEFAULT 0,
    -- 1 là ảnh chính, 0 là ảnh phụ
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
-- Bảng discounts - lưu thông tin về giảm giá sản phẩm
CREATE TABLE discounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    discount_percentage DECIMAL(5, 2) NOT NULL,
    start_date DATE,
    end_date DATE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
-- Bảng stocks - lưu thông tin về số lượng sản phẩm trong kho
CREATE TABLE stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
-- Bảng customers - lưu thông tin khách hàng
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    -- sửa username thành first_name và last_name
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);
-- Bảng orders - lưu thông tin đơn hàng
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);
-- Bảng order_items - lưu chi tiết sản phẩm trong đơn hàng
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE
    SET NULL
);
-- Bảng order_billing_details - lưu thông tin thanh toán của đơn hàng
CREATE TABLE order_billing_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    company_name VARCHAR(100),
    address VARCHAR(255) NOT NULL,
    country VARCHAR(50),
    region VARCHAR(50),
    city VARCHAR(50),
    zip_code VARCHAR(20),
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);
-- Bảng reviews - lưu đánh giá của khách hàng về sản phẩm
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    customer_id INT,
    rating INT CHECK (
        rating >= 1
        AND rating <= 5
    ),
    comment TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE
    SET NULL
);
-- Bảng cart - lưu giỏ hàng của khách hàng (tạm thời trước khi tạo đơn hàng)
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);
-- Bảng cart_items - lưu thông tin sản phẩm trong giỏ hàng
CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES cart(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Bảng contact - Lưu thông tin contact
CREATE TABLE contacts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(100) NULL,
    second_name VARCHAR(100) NULL,
    email VARCHAR(255) NULL,
    number_phone VARCHAR(20) NULL,
    subject ENUM('General Inquiry', 'Support', 'Feedback', 'Other') NULL,
    message TEXT NOT NULL,
    PRIMARY KEY (id)
);
-- thêm một dòng dữ liệu vào bảng users
ALTER TABLE users
ADD COLUMN role ENUM('admin', 'user') NOT NULL DEFAULT 'user';
-- thứ tự xóa bảng
-- DROP TABLE cart_items;
-- DROP TABLE cart;
-- DROP TABLE reviews;
-- DROP TABLE order_billing_details;
-- DROP TABLE order_items;
-- DROP TABLE orders;
-- DROP TABLE stocks;
-- DROP TABLE discounts;
-- DROP TABLE product_images;
-- DROP TABLE products;
-- DROP TABLE customers;
-- DROP TABLE brands;
-- DROP TABLE categories;
-- thêm role cho customer
ALTER TABLE customers
ADD COLUMN role ENUM('admin', 'user') NOT NULL DEFAULT 'user';
SHOW INDEX
FROM customers
WHERE Non_unique = 0
    AND Column_name = 'username';
-- xóa unique cho username
ALTER TABLE customers DROP INDEX username;
-- thêm thumbnail_url cho categories
ALTER TABLE categories
ADD COLUMN thumbnail_url VARCHAR(255);
ALTER TABLE orders
MODIFY customer_id INT NULL;
-- sửa username thành first_name và last_name
ALTER TABLE customers CHANGE COLUMN username first_name VARCHAR(50);
ALTER TABLE customers
ADD COLUMN last_name VARCHAR(50);