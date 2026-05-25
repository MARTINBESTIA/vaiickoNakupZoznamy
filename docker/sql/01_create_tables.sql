DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS zoznam;

CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(15) NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE zoznam (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE group (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)
)
