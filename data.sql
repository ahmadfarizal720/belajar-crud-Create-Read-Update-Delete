CREATE DATABASE dashboard_db;
USE dashboard_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_hp VARCHAR(20),
    peran ENUM('Admin', 'User') DEFAULT 'User',
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);