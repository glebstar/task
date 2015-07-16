CREATE TABLE `user` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(20) NOT NULL,
    `password` VARCHAR(32) NOT NULL,
    `salt` VARCHAR(5) NOT NULL,
    `firstname` VARCHAR(30) DEFAULT '',
    `lastname` VARCHAR(30) DEFAULT '',
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (login, password, salt, firstname, lastname) VALUES ('test', '7adf184b7f6a2efd9c3de2dfa6cee215', 't23Abv', 'Petr', 'Pupkin');