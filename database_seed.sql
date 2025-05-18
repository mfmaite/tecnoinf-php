CREATE DATABASE IF NOT EXISTS restaurant;
USE restaurant;

DROP TABLE IF EXISTS `menus`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `photoUrl` varchar(512) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) UNIQUE NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` ENUM('admin', 'user') DEFAULT 'user',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

INSERT INTO `menus` (`name`, `price`, `photoUrl`) VALUES
('Beyond burger', 600.00, 'https://img2.rtve.es/n/2119800'),
('Pulled Pork', 620.00, 'https://www.giallozafferano.com/images/284-28461/Pulled-Pork_1200x800.jpg');

INSERT INTO users (email, password_hash, role) VALUES
('admin@pachepe.com', '$2y$10$pl0GyhaS/NUtz2akm.ehMuZJeAtec2Qtg/MqFEh.E9AQb3eXD/TaW', 'admin');
