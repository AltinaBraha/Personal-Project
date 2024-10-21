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