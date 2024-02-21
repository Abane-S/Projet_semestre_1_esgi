DROP TABLE IF EXISTS `esgi_comment`;
DROP TABLE IF EXISTS `esgi_menus`;
DROP TABLE IF EXISTS `esgi_pages`;
DROP TABLE IF EXISTS `esgi_user`;
DROP TABLE IF EXISTS `esgi_templates`;

CREATE TABLE `esgi_comment` (
                                `id` INT AUTO_INCREMENT PRIMARY KEY,
                                `id_page` INT NOT NULL,
                                `valid` BOOLEAN DEFAULT FALSE,
                                `fullname` VARCHAR(100) NOT NULL,
                                `commenttitle` VARCHAR(100),
                                `comment` TEXT,
                                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `esgi_menus` (
                              `id` INT AUTO_INCREMENT PRIMARY KEY,
                              `title` VARCHAR(255) NOT NULL,
                              `meta_description` TEXT,
                              `miniature` VARCHAR(255),
                              `content` TEXT,
                              `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              `title_menu` VARCHAR(255) NOT NULL,
                              `icon_menu` CHAR(255) NOT NULL
);

CREATE TABLE `esgi_pages` (
                              `id` INT AUTO_INCREMENT PRIMARY KEY,
                              `title` VARCHAR(255) NOT NULL,
                              `meta_description` TEXT,
                              `miniature` VARCHAR(255),
                              `comments` BOOLEAN DEFAULT FALSE,
                              `content` TEXT,
                              `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `esgi_user` (
                             `id` INT AUTO_INCREMENT PRIMARY KEY,
                             `firstname` VARCHAR(25) NOT NULL,
                             `lastname` VARCHAR(50) NOT NULL,
                             `email` VARCHAR(320) NOT NULL,
                             `pwd` VARCHAR(255) NOT NULL,
                             `role` VARCHAR(10) DEFAULT 'user' NOT NULL,
                             `verification_token` VARCHAR(255),
                             `email_verified` BOOLEAN DEFAULT FALSE,
                             `date_inserted` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                             `isdeleted` BOOLEAN DEFAULT FALSE
);

CREATE TABLE `esgi_templates` (
                                  `id` INT AUTO_INCREMENT PRIMARY KEY,
                                  `name` VARCHAR(255) NOT NULL,
                                  `background_color` VARCHAR(255) NOT NULL,
                                  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                  `active` BOOLEAN DEFAULT FALSE NOT NULL,
                                  `navbar_color` VARCHAR(255),
                                  `menu_color` VARCHAR(255),
                                  `text_color` VARCHAR(255),
                                  `police_size` INT NOT NULL,
                                  `police_name` VARCHAR(255),
                                  `default_tpl` BOOLEAN DEFAULT FALSE NOT NULL
);

INSERT INTO `esgi_templates` (`id`, `name`, `background_color`, `created_at`, `active`, `navbar_color`, `menu_color`, `text_color`, `police_size`, `police_name`, `default_tpl`) VALUES
                                                                                                                                                                                     (9998, 'Template_Default', '#f1efef', '2024-02-19 13:20:10.12797', TRUE, '#ffffff', '#0a70f5', '#000000', 15, 'Euclid Circular Regular, sans-serif', TRUE),
                                                                                                                                                                                     (9999, 'Dark_mode', '#050505', '2024-02-19 15:09:18.741549', FALSE, '#1d1b1b', '#ffffff', '#ffffff', 15, 'Euclid Circular Regular, sans-serif', TRUE);
