-- 홍진서1
CREATE TABLE user(
    u_id VARCHAR(15) NOT NULL PRIMARY KEY,
    pwd VARCHAR(20) NOT NULL,
    username VARCHAR(30) NOT NULL,
    preferred VARCHAR(30) NOT NULL
);

-- 이유림1
CREATE TABLE user_info(
    u_id VARCHAR(15) NOT NULL,
    usersex varchar(10) NOT NULL,
    userage INT NOT NULL,
    FOREIGN KEY (u_id) REFERENCES user(u_id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 조유담1
CREATE TABLE movie_boxoffice(
    m_id int NOT NULL PRIMARY KEY,
    title varchar(50) NOT NULL,
    released_date date NOT NULL,
    sales bigint NOT NULL,
    audience int NOT NULL,
    screen_num int NOT NULL,
    country	varchar(20) NOT NULL,
    distributor varchar(50) NOT NULL,
    d_id int NOT NULL,
    genre varchar(20) NOT NULL,
    poster text NOT NULL
);

-- 이유림2
CREATE TABLE user_like(
    u_id VARCHAR(15),
    m_id INT,
    FOREIGN KEY (u_id) REFERENCES user(u_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (m_id) REFERENCES movie_boxoffice(m_id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 조유담2
CREATE TABLE rating(
    m_id int NOT NULL,
    rating decimal(3, 2) NOT NULL,
    FOREIGN KEY (m_id) REFERENCES movie_boxoffice(m_id)
);

-- 조유담3
CREATE TABLE user_rating(
    u_id VARCHAR(20) NOT NULL,
    m_id INT NOT NULL,
    u_rating INT NOT NULL,
    FOREIGN KEY (u_id) REFERENCES user(u_id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- 김다희1
CREATE TABLE director_table (
    director varchar(300),
    film1 varchar(300),
    film2 varchar(300),
    film3 varchar(300)
);


-- 김다희2
CREATE TABLE director_id(
    d_id INT(10) NOT NULL AUTO_INCREMENT,
    director varchar(300),
    PRIMARY KEY (`d_id`)
);


-- 김다희3
CREATE TABLE director_award(
    d_id INT(10) NOT NULL AUTO_INCREMENT,
    award varchar(300),
    PRIMARY KEY (`d_id`)
);


-- 이유림3
CREATE TABLE movie_month_sales(
    year INT,
    month INT,
    sales BIGINT(20),
    country VARCHAR(300)
);


-- 홍진서2
-- (기준 날짜, 개봉편수, 상영편수, 매출, 관객수, 영화 국가)
CREATE TABLE film_industry(
    reference_date DATE,
    opening INT NOT NULL,
    screening INT NOT NULL,
    sales BIGINT NOT NULL,
    attendance BIGINT NOT NULL,
    country VARCHAR(20) NOT NULL
);
CREATE INDEX index_film_industry ON film_industry(reference_date, sales);

-- 홍진서3
CREATE TABLE movie_profit(
    m_title VARCHAR(50) NOT NULL,
    m_sales BIGINT NOT NULL,
    m_audience BIGINT NOT NULL
);

-- 홍진서4
CREATE TABLE compare_data(
    u_id VARCHAR(15) NOT NULL, 
    input_title VARCHAR(50) NOT NULL,
    input_sales BIGINT NOT NULL,
    input_audience BIGINT NOT NULL,
    FOREIGN KEY (u_id) REFERENCES user(u_id) ON DELETE CASCADE ON UPDATE CASCADE
);
