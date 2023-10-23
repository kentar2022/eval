-- db/migration/V1__create_admin_table.sql
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
-- db/migration/V2__create_users_table.sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);
-- db/migration/V3__create_cars_table.sql
CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    mileage INT NOT NULL,
    color VARCHAR(50) NOT NULL,
    color_html VARCHAR(7) NOT NULL,
    release_date DATE NOT NULL,
    details TEXT
);
-- db/migration/V4__create_schedule_table.sql
CREATE TABLE schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day VARCHAR(50) NOT NULL,
    time_intervals VARCHAR(255) NOT NULL
);
-- db/migration/V5__create_comments_table.sql
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    nickname VARCHAR(255),
    rating INT NOT NULL
);
-- db/migration/V6__create_filtred_comment_table.sql
CREATE TABLE filtred_comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    nickname VARCHAR(255),
    rating INT NOT NULL
);
