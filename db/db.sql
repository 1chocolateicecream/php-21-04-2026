CREATE DATABASE IF NOT EXISTS store_dev1;
USE store_dev1;

CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    birth_date DATE,
    points INT
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_date DATE,
    status ENUM('new', 'paid', 'delivered'),
    comment TEXT,
    image VARCHAR(255),
    shipping_date DATE,
    customer_id INT,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

INSERT INTO customers (first_name, last_name, email, birth_date, points) VALUES
('Jānis', 'Bērziņš', 'janis.b@example.com', '1990-05-15', 100),
('Anna', 'Kalniņa', 'anna.k@example.com', '1985-11-20', 250),
('Pēteris', 'Ozols', 'peteris.o@example.com', '1995-02-10', 50),
('Maija', 'Liepa', 'maija.l@example.com', '1988-08-30', 0);

INSERT INTO orders (order_date, status, comment, image, shipping_date, customer_id) VALUES
('2019-10-01', 'delivered', 'Pirmā adrese', NULL, '2023-10-05', 1),
('2020-10-02', 'paid', 'Steidzami', NULL, NULL, 1),
('2021-10-03', 'delivered', 'Dāvana', 'images/plush.webp', '2023-10-06', 2),
('2022-10-04', 'paid', 'Klients atteicās', NULL, NULL, 2),
('2023-10-05', 'delivered', '', NULL, '2023-10-10', 2),
('2024-10-06', 'delivered', 'Lauku adrese', NULL, '2023-10-12', 3),
('2025-10-07', 'new', 'Zvanīt pirms', NULL, NULL, 3);

CREATE USER 'store_app1'@'192.168.10.79' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON store_dev1.* TO 'store_app1'@'192.168.10.79';
FLUSH PRIVILEGES;