CREATE TABLE `social`.`likes`
  (
     `id`       INT NOT NULL auto_increment,
     `username` VARCHAR(100) NOT NULL,
     `post_id`  INT NOT NULL,
     PRIMARY KEY (`id`)
  )
engine = innodb;  