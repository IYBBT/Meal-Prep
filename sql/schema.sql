
CREATE TABLE meal (
    mid     INT AUTO_INCREMENT PRIMARY KEY,
    mName   VARCHAR(64),
);

CREATE TABLE recipe_step (
    mid     INT,
    rid     INT,
    step    VARCHAR(256)
)

CREATE TABLE ingredient (
    iid     INT AUTO_INCREMENT PRIMARY KEY,
    iName   VARCHAR(64),
    type    VARCHAR(32)
);

CREATE TABLE user (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    uName      VARCHAR(64) UNIQUE,
    pWord      VARCHAR(128),
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
    iid     INT
);

CREATE TABLE review (
    uid     INT,
    mid     INT,
    rating  INT
);

CREATE TABLE manages (
    aid  INT,
    uid  INT
);

-- Ingredients Used in meals
CREATE TABLE meal_uses (
    mid  INT,
    iid  INT
);
