CREATE TABLE user(
    u_id VARCHAR(15) NOT NULL PRIMARY KEY,
    pwd VARCHAR(20) NOT NULL,
    username VARCHAR(30) NOT NULL,
    usersex varchar(10) NOT NULL,
    preferred VARCHAR(30)
);

CREATE INDEX index_username ON user(username);
CREATE INDEX index_usersex_preferred ON user(usersex, preferred);


CREATE TABLE movie_boxoffice(
    m_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(50) NOT NULL,
    released_date date NOT NULL,
    sales bigint NOT NULL,
    audience int NOT NULL,
    screen_num int NOT NULL,
    country	varchar(20) NOT NULL,
    genre varchar(20) NOT NULL,
    poster varchar(200) NOT NULL
);


CREATE TABLE user_like(
    u_id VARCHAR(15),
    m_id INT,
    FOREIGN KEY (u_id) REFERENCES user(u_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (m_id) REFERENCES movie_boxoffice(m_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE rating(
    m_id int,
    rating decimal(2, 1) NOT NULL,
    FOREIGN KEY (m_id) REFERENCES movie_boxoffice(m_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE director(
    m_id int,
    distributor varchar(50) NOT NULL,
    director varchar(20) NOT NULL,
    FOREIGN KEY (m_id) REFERENCES movie_boxoffice(m_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE movie_month 
(
    year	varchar(300),
    month	varchar(300),
    k_release	varchar(300),
    k_screen	varchar(300),
    k_sales	varchar(300),
    k_audience	varchar(300),
    k_share	varchar(300),
    f_release	varchar(300),
    f_screen	varchar(300),
    f_sales	varchar(300),
    f_audience	varchar(300),
    f_share	varchar(300)
);
