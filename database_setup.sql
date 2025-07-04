-- Create the registration_db database
CREATE DATABASE IF NOT EXISTS registration_db;

-- Use the registration_db database
USE registration_db;

-- Create the student_tb table
CREATE TABLE student_tb (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mobile VARCHAR(10) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    dob DATE NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    pin_code VARCHAR(6) NOT NULL,
    state VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    hobbies TEXT,
    qualification TEXT NOT NULL,
    courses_applied TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional: Create an index on email for faster lookups
CREATE INDEX idx_email ON student_tb(email);

-- Optional: Create an index on mobile for faster lookups
CREATE INDEX idx_mobile ON student_tb(mobile);