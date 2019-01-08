CREATE TABLE user (
	id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL UNIQUE,
	name VARCHAR(255) NOT NULL,
	password VARCHAR(32) NOT NULL,
	hash VARCHAR(32),
	reset_hash VARCHAR(32),
	role ENUM('admin', 'user') DEFAULT 'user',
	register_date DATETIME,
	PRIMARY KEY(id)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE category (
	id INT NOT NULL AUTO_INCREMENT,
	parent_id INT,
	name VARCHAR(255) NOT NULL UNIQUE,
	creation_date DATETIME,
	image_url VARCHAR(255),
	alias VARCHAR(300),
	PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE product (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	alias VARCHAR(300),
	description VARCHAR(1000),
	sku VARCHAR(255),
	item_code VARCHAR(255),
	barcode VARCHAR(255),
	ingredients VARCHAR(1000),
	specification VARCHAR(1000),
	product_usage VARCHAR(2000),
	warning VARCHAR(2000),
	has_discount BOOLEAN,
	price FLOAT(6, 2),
	actual_price FLOAT(6, 2),
	is_deleted BOOLEAN,
	in_stock BOOLEAN,
	is_popular BOOLEAN,
	small_image_url VARCHAR(500),
	big_image_url VARCHAR(500),
	creation_date DATETIME,
	category_id INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE news (
	id INT NOT NULL AUTO_INCREMENT,
	title VARCHAR(255),
	alias VARCHAR(255),
	big_image_url VARCHAR(255),
	small_image_url VARCHAR(255),
	content VARCHAR(40000),
	content_preview VARCHAR(400),
	meta_description VARCHAR(500),
	meta_keywords VARCHAR(500),
	date_keyword VARCHAR(50),
	creation_date DATETIME,
	is_published BOOLEAN,
	PRIMARY KEY(id)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE wishlist (
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT,
	product_id INT,
	creation_date DATETIME,
	PRIMARY KEY(id),
	CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_product FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE slide (
	id INT NOT NULL AUTO_INCREMENT,
	alias VARCHAR(255),
	url VARCHAR(500),
	image_url VARCHAR(500),
	position INT,
	PRIMARY KEY(id)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE setting (
	id INT NOT NULL AUTO_INCREMENT,
	setting_key VARCHAR(100) NOT NULL UNIQUE,
	name VARCHAR(255) NOT NULL UNIQUE,
	value VARCHAR(255),
	PRIMARY KEY(id)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE subscriber (
	id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(100) NOT NULL UNIQUE,
	hash VARCHAR(32),
	is_subscribed BOOLEAN,
	creation_date DATETIME,
	PRIMARY KEY(id)
) ENGINE=InnoDB CHARACTER SET utf8;