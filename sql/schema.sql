SET NAMES 'utf8';
SET CHARACTER SET 'utf8';
SET SESSION collation_connection = 'utf8_general_ci';

CREATE TABLE `user` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(20) NOT NULL,
    `password` VARCHAR(32) NOT NULL,
    `salt` VARCHAR(5) NOT NULL,
    `firstname` VARCHAR(30) DEFAULT '',
    `lastname` VARCHAR(30) DEFAULT '',
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (login, password, salt, firstname, lastname) VALUES ('test', '7adf184b7f6a2efd9c3de2dfa6cee215', 't23Abv', 'Вася', 'Пупкин');

CREATE TABLE `task_urg` (
    `id` INT(1) UNSIGNED NOT NULL,
    `value` VARCHAR(15),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `task_urg` (id, value) VALUES(1, 'Низкая');
INSERT INTO `task_urg` (id, value) VALUES(2, 'Средняя');
INSERT INTO `task_urg` (id, value) VALUES(3, 'Высокая');

CREATE TABLE `task_comp` (
    `id` INT(1) UNSIGNED NOT NULL,
    `value` VARCHAR(15),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `task_comp` (id, value) VALUES(1, 'Легкая');
INSERT INTO `task_comp` (id, value) VALUES(2, 'Средняя');
INSERT INTO `task_comp` (id, value) VALUES(3, 'Сложная');

CREATE TABLE `task_status` (
    `id` INT(1) UNSIGNED NOT NULL,
    `value` VARCHAR(15),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `task_status` (id, value) VALUES(1, 'Новая');
INSERT INTO `task_status` (id, value) VALUES(2, 'Выполняется');
INSERT INTO `task_status` (id, value) VALUES(3, 'Закрыта');

CREATE TABLE `task` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `create_time` DATETIME NOT NULL,
    `create_user_id` INT(11) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `subject` VARCHAR(50) NOT NULL,
    `text` TEXT NOT NULL,
    `task_urg_id` INT(1),
    `task_comp_id` INT(1),
    `task_status_id` INT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `task` (create_time, create_user_id, user_id, subject, text, task_urg_id, task_comp_id, task_status_id) VALUES('2015-07-16 12:00', 1, 1, 'Прикрутить верстку', 'Нужно натянуть верстку на движок', 2, 2, 3);

CREATE TABLE `task_comment` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `create_time` DATETIME NOT NULL,
    `task_id` INT(11) UNSIGNED NOT NULL,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `message` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
