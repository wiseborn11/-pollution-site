-- 1. Create the Database
CREATE DATABASE IF NOT EXISTS plastic_pollutions_db;
USE plastic_pollutions_db;

-- 2. Users Table: Stores credentials and security status
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    visitor_id VARCHAR(8) NOT NULL UNIQUE, -- Added for PUXXXXXX format
    login_attempts INT DEFAULT 0,
    lockout_until DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Donations Table: Tracks financial contributions
CREATE TABLE donations (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    message TEXT NULL, -- Added optional message
    donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. Petitions Table: For the "What to Do" page signature feature
CREATE TABLE petitions (
    petition_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    signed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 5. Site Statistics Table: Tracks visitors and general counters
CREATE TABLE site_stats (
    stat_name VARCHAR(50) PRIMARY KEY,
    stat_value INT DEFAULT 0
);

-- Initialize site statistics
INSERT INTO site_stats (stat_name, stat_value) VALUES ('visitor_count', 0);

-- 6. Visitors Log Table (IP tracking)
CREATE TABLE visitors_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    visited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
