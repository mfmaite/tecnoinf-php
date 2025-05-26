CREATE DATABASE IF NOT EXISTS restaurant;
USE restaurant;

DROP TABLE IF EXISTS `favorites`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `favorites` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `menu_id` int(11) NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES users(`id`),
    FOREIGN KEY (`menu_id`) REFERENCES menus(`id`),
    UNIQUE(user_id, menu_id),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `menus` (`name`, `price`, `photoUrl`) VALUES
('Beyond burger', 600.00, 'https://img2.rtve.es/n/2119800'),
('Pulled Pork', 620.00, 'https://www.giallozafferano.com/images/284-28461/Pulled-Pork_1200x800.jpg'),
('Classic Cheese Burger', 550.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFnPwnmWfGuVXblPZHvkl_CFBU46SdPyrz-g&s'),
('Spicy Jalapeño Burger', 590.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScxTJH03WMbg0qeJEQTYfMk0Qqzopp3JU5aA&s'),
('Avocado Ranch Burger', 650.00, 'https://carmyy.com/wp-content/uploads/2023/01/Avocado-Burgers-500x500.jpg'),
('Onion Ring Burger', 670.00, 'https://static.wixstatic.com/media/19cb78_d38457f7e3ab4faa980c6fb014517496~mv2.png/v1/fill/w_1081,h_1081,al_c/BBQ%20Chili%20Onion%20Ring%20Burger.%20png.png'),
('Blue Cheese Burger', 640.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhhP4c2exuSrBhkRNGJkhs8QmCJ9ioWR72Wg&s');

-- password: pass
INSERT INTO users (email, password_hash, role) VALUES
('admin@pachepe.com', '$2y$10$jhPUclwL80KJKAs4wCsSk.8Ogps9ASzaEKoW2vnV2m0HDkPZRPw3.', 'admin');

INSERT INTO users (email, password_hash, role) VALUES
('user@pachepe.com', '$2y$10$jhPUclwL80KJKAs4wCsSk.8Ogps9ASzaEKoW2vnV2m0HDkPZRPw3.', 'user');
