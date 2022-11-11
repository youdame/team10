CREATE TABLE user(
    id VARCHAR(15) NOT NULL PRIMARY KEY,
    pwd VARCHAR(20) NOT NULL,
    username VARCHAR(30) NOT NULL,
    preferred VARCHAR(30)
);

CREATE TABLE movie_boxoffice(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(50) NOT NULL,
    released_date date NOT NULL,
    sales int NOT NULL,
    audience int NOT NULL,
    screen_num int NOT NULL,
    country	varchar(20) NOT NULL,
    distributor varchar(50) NOT NULL,
    director varchar(20) NOT NULL,
    genre varchar(20) NOT NULL,
    rating decimal(2, 1) NOT NULL
);

CREATE TABLE movie_info (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    SN DECIMAL(30,0),
    MOVIE_NM VARCHAR(200),
    MNG_NM VARCHAR(200),
    MAKR_NM VARCHAR(200),
    IMPORT_CMPNY_NM VARCHAR(200),
    DISTB_CMPNY_NM VARCHAR(200),
    OPEN_DE VARCHAR(8),
    MOVIE_TY_NM VARCHAR(200),
    MOVIE_STLE_NM VARCHAR(200),
    NLTY_NM VARCHAR(200),
    WNTY_SCREEN_CO DECIMAL(28,5),
    WNTY_SELNG_AM DECIMAL(28,5),
    WNTY_AUDE_CO DECIMAL(28,5),
    SU_SELNG_AM DECIMAL(28,5),
    SU_AUDE_CO DECIMAL(28,5),
    GENRE_NM VARCHAR(200),
    GRAD_NM VARCHAR(200),
    MOVIE_SE VARCHAR(30)
);