CREATE TABLE IF NOT EXISTS `user` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `role` varchar(20) NOT NULL,
    `session_id` varchar(255) NULL,
    PRIMARY KEY (`user_id`)
);

CREATE TABLE IF NOT EXISTS `company` (
    `company_id` int(11) NOT NULL AUTO_INCREMENT,
    `company_name` varchar(100) NOT NULL,
    `address` varchar(255) NOT NULL,
    `year_established` int(4) NOT NULL,
    `email` varchar(100) NOT NULL UNIQUE,
    `status` varchar(20) DEFAULT 'pending',
    PRIMARY KEY (`company_id`)
);
