
CREATE TABLE meal (
    mid     INT AUTO_INCREMENT PRIMARY KEY,
    uid     INT,
    mName   VARCHAR(64),
    image   VARCHAR(64)
);

CREATE TABLE recipe_step (
    mid     INT,
    rid     INT,
    step    VARCHAR(256),
    PRIMARY KEY (mid, rid)
);

CREATE TABLE ingredient (
    iid     INT AUTO_INCREMENT PRIMARY KEY,
    iName   VARCHAR(64),
    type    VARCHAR(32)
);

CREATE TABLE user (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    uName      VARCHAR(64) UNIQUE,
    pWord      VARCHAR(128)
);

CREATE TABLE admin (
    aid     INT PRIMARY KEY,
    FOREIGN KEY (aid) REFERENCES user(id)
);

CREATE TABLE end (
    uid     INT PRIMARY KEY,
    FOREIGN KEY (uid) REFERENCES user(id)
);

CREATE TABLE possess (
    uid     INT,
    iid     INT,
    UNIQUE (uid, iid)
);

CREATE TABLE review (
    uid     INT,
    mid     INT,
    rating  INT,
    review  VARCHAR(256)
);

CREATE TABLE manages (
    aid  INT,
    uid  INT,
    UNIQUE (aid, uid)
);

-- Ingredients Used in meals
CREATE TABLE meal_uses (
    mid  INT,
    iid  INT,
    UNIQUE (mid, iid)
);

CREATE TABLE click (
    cid     INT AUTO_INCREMENT PRIMARY KEY,
    mid     INT,
    cdate   DATE
);
