CREATE TABLE `social`.`post_comments`
  (
     `id`         INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
     `post_body`  TEXT NOT NULL,
     `posted_by`  VARCHAR(100) NOT NULL,
     `posted_to`  VARCHAR(100) NOT NULL,
     `date_added` DATETIME NOT NULL,
     `removed`    VARCHAR(3) NOT NULL,
     `post_id`    INT NOT NULL
  )
engine = innodb; 