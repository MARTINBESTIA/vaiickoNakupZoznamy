DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS zoznam;

CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(15) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE zoznam (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE groups (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE user_in_group (
    user_in_group_id int(11) NOT NULL AUTO_INCREMENT,
    user_id int(11) NOT NULL,
    group_id int(11) NOT NULL,
    PRIMARY KEY (user_in_group_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE
);
