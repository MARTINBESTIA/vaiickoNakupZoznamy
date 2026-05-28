DROP TABLE IF EXISTS zoznam_in_group;
DROP TABLE IF EXISTS user_in_group;
DROP TABLE IF EXISTS zoznam;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS users;


CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(15) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE zoznam (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    creator_id int(11) NOT NULL,
    is_bought CHAR(1) NOT NULL DEFAULT 'N',
    PRIMARY KEY (id),
    FOREIGN KEY (creator_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE groups (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    creator_id int(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (creator_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE user_in_group (
    user_in_group_id int(11) NOT NULL AUTO_INCREMENT,
    user_id int(11) NOT NULL,
    group_id int(11) NOT NULL,
    PRIMARY KEY (user_in_group_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE
);

CREATE TABLE zoznam_in_group (
    zoznam_in_group_id int(11) NOT NULL AUTO_INCREMENT,
    zoznam_id int(11) NOT NULL,
    group_id int(11) NOT NULL,
    PRIMARY KEY (zoznam_in_group_id),
    FOREIGN KEY (zoznam_id) REFERENCES zoznam(id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES groups(id) ON DELETE CASCADE
);
