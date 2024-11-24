-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `login_register` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Switch to the database
USE `login_register`;

-- Create tables
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category_id INT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_id VARCHAR(100) NOT NULL UNIQUE,
    order_id VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    email VARCHAR(100),
    name VARCHAR(100),
    phone VARCHAR(20),
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_payment_id (payment_id),
    INDEX idx_order_id (order_id)
);

-- Insert some default categories
INSERT IGNORE INTO categories (name, description) VALUES
('Electronics', 'Electronic devices and accessories'),
('Clothing', 'Fashion and apparel'),
('Books', 'Books and publications'),
('Home & Garden', 'Home decor and gardening items');

-- Insert some sample products
INSERT IGNORE INTO products (name, description, price, category_id, image_url) VALUES
('Smartphone', 'Latest model smartphone with advanced features', 699.99, 1, 'images/product_1.jpg'),
('Laptop', 'High-performance laptop for work and gaming', 1299.99, 1, 'images/product_2.jpg'),
('T-shirt', 'Comfortable cotton t-shirt', 19.99, 2, 'images/product_3.jpg'),
('Jeans', 'Classic blue jeans', 49.99, 2, 'images/product_4.jpg');
