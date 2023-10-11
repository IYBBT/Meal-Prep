
CREATE TABLE meal (
    mid     INT AUTO_INCREMENT PRIMARY KEY,
    mName   VARCHAR(64),
    recipe  VARCHAR(256),
);

CREATE TABLE ingredient (
    iid     INT AUTO_INCREMENT PRIMARY KEY,
    iName   VARCHAR(64),
    type    VARCHAR(32)
);

CREATE TABLE user (
    username   VARCHAR(64) PRIMARY KEY,
    pWord      VARCHAR(128);
);

CREATE TABLE admin (
    aid        INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(64) FOREIGN KEY
);

CREATE TABLE end (
    uid        INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(64) FOREIGN KEY
);

CREATE TABLE possess (
    uid     INT FOREIGN KEY,
    iid     INT FOREIGN KEY
);

CREATE TABLE review (
    uid     INT FOREIGN KEY,
    mid     INT FOREIGN KEY,
    rating  INT
);

CREATE TABLE manages (
    aid  INT FOREIGN KEY,
    uid  INT FOREIGN KEY
);

CREATE TABLE uses (
    mid  PRIMARY KEY,
    iid  FOREIGN KEY
);
