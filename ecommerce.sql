CREATE TABLE `users` (
    `id` int NOT NULL,
    `emri` varchar(255) NOT NULL,
    `username` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `confirm_password` varchar(255) NOT NULL,
    `is_admin` varchar(255) NOT NULL
);

INSERT INTO `users` (`id`, `emri`, `username`, `email`, `password`, `confirm_password`, `is_admin`) VALUES
(1, 'Altina', 'altinaa', 'altina.braha@gmail.com', 'altina123', 'true', 'false'),
(2, 'Test', 'test', 'test.braha@gmail.com', 'test123', 'true', 'false');

ALTER TABLE `users`
ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


CREATE TABLE products (
    id int NOT NULL,
    name VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    reviews INT NOT NULL,
    img_url VARCHAR(255) NOT NULL
);

INSERT INTO products (id, name, price, reviews, img_url) VALUES 
(2,'Uni-Brow Universal Eyebrow Pencil', 18.00, 378, 'unibrow_pencil.jpg'),
(3,'ExtraWlash Mascara', 18.00, 342, 'extrawlash_mascara.jpg'),
(4,'PurrfectPout Lipstick', 18.00, 224, 'purrfectpout_lipstick.jpg');

ALTER TABLE `products`
ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

CREATE TABLE `contactform` (
    `id` INT NOT NULL, 
    `name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL, 
    `message` VARCHAR(255) NOT NULL,
    `submission_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP 
);

INSERT INTO `contactform` (name, email, message) VALUES 
('John Doe', 'john.doe@example.com', 'I am interested in your services.'),
('Jane Smith', 'jane.smith@example.com', 'Could you please provide more details?'),
('Alice Johnson', 'alice.johnson@example.com', 'I have a question about my order.');

ALTER TABLE `contactform`
ADD PRIMARY KEY (`id`);


ALTER TABLE `contactform`
MODIFY `id` INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;