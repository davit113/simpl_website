CREATE DATABASE id21009493_db_basic;
USE id21009493_db_basic;


CREATE TABLE product(
    sku varchar(255) NOT NULL,
    name varchar(255) NOT NULL,
    price float NOT NULL,
    PRIMARY KEY(sku)
);
CREATE TABLE book(
    book_weight float NOT NULL,
    product_sku VARCHAR(255) NOT NULL,
    CONSTRAINT FOREIGN KEY (product_sku) REFERENCES product(sku) ON DELETE CASCADE
);
CREATE TABLE dvd(
    dvd_size float NOT NULL,
    product_sku VARCHAR(255) NOT NULL,
    CONSTRAINT FOREIGN KEY (product_sku) REFERENCES product(sku) ON DELETE CASCADE
);
CREATE TABLE furniture(
    width float NOT NULL,
    length float NOT NULL,
    height float NOT NULL,
    product_sku VARCHAR(255) NOT NULL,
    CONSTRAINT FOREIGN KEY (product_sku) REFERENCES product(sku) ON DELETE CASCADE
);