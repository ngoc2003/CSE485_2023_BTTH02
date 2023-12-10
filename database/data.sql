-- cms_user: ADMIN
-- tkhoan: admin@gmail.com ; mkhau: admin123
INSERT INTO cms_user (id, first_name, last_name, email, password, type) VALUES (1, 'My', 'Admin', 'admin@gmail.com', '$2y$10$N/ibOJm38SgqPjmLaPTEi.k9B8wn.NJblWaM1.5brx/EftkiBpICO', 1);

-- cms_categories
INSERT INTO `cms_category` (`id`, `name`) VALUES
(1, 'PHP'),
(2, 'jQuery'),
(3, 'JavaScript'),
(5, 'HTML'),
(6, 'Java');