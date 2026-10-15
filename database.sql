CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE KEY,
  `phone` varchar(20) DEFAULT NULL UNIQUE KEY,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP()
) 

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`) VALUES
(1, 'Ardon Reyes', 'ardon.reyes@gmail.com', '0912345671', '2026-09-22 02:30:23'),
(2, 'Samantha Ching', 'samantha.ching@gmail.com', '0912345672', '2026-09-22 02:30:23'),
(3, 'Carl Eugenio', 'carl.eugenio@gmail.com', '0912345673', '2026-09-22 02:30:23'),
(4, 'Ayeza Arcilla', 'ayeza.arcilla@gmail.com', '0912345674', '2026-09-22 02:30:23'),
(5, 'Diongeles Vanderbilt', 'diongeles.vanderbilt@gmail.com', '0912345675', '2026-09-22 02:30:23');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(50) NOT NULL UNIQUE KEY,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'User',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP()
)

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `profile`, `role`, `created_at`) VALUES
(1, 'ardonreyes', '', 'Ardon Reyes', NULL, 'Admin', '2026-09-22 02:30:23'),
(2, 'samanthaching', '', 'Samantha Ching', NULL, 'Admin', '2026-09-22 02:30:23'),
(3, 'carleugenio', '', 'Carl Eugenio', NULL, 'User', '2026-09-22 02:30:23'),
(4, 'ayezaarcilla', '', 'Ayeza Arcilla', NULL, 'User', '2026-09-22 02:30:23'),
(5, 'diongelesvanderbilt', '', 'Diongeles Vanderbilt', NULL, 'User', '2026-09-22 02:30:23');
