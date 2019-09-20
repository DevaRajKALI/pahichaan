
CREATE TABLE `pahichaan`.`posts`
  (
     `id`          INT NOT NULL auto_increment,
     `body`        TEXT NOT NULL,
     `added_by`    VARCHAR(100) NOT NULL,
     `user_to`     VARCHAR(100) NOT NULL,
     `date_added`  DATETIME NOT NULL,
     `user_closed` VARCHAR(3) NOT NULL,
     `deleted`     VARCHAR(3) NOT NULL,
     `likes`       INT NOT NULL,
     PRIMARY KEY (`id`)
  )
engine = innodb;