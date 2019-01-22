CREATE DATABASE legostore CHARACTER SET utf8 COLLATE utf8_general_ci;

USE legostore;

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
	name VARCHAR(255) NOT NULL UNIQUE,
	original_name VARCHAR(255) NOT NULL UNIQUE,
	description VARCHAR(5000),
	creation_date DATETIME,
	small_image_url VARCHAR(255),
	big_image_url VARCHAR(255),
	thumb_image_url VARCHAR(255),
	logo_image_url VARCHAR(255),
	cover_color VARCHAR(255),
	alias VARCHAR(300),
	is_popular BOOLEAN,
	youtube_link VARCHAR(500),
	PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE product (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	original_name VARCHAR(255),
	description VARCHAR(5000),
	item_code VARCHAR(255),
	year_released INT,
	parts_count INT,
	minifigures_count INT,
	item_condition ENUM('used', 'new') DEFAULT 'used',
	has_all_parts BOOLEAN,
	has_instructions BOOLEAN,
	has_box BOOLEAN,
	item_state ENUM('order', 'instock', 'hidden') DEFAULT 'order',
	has_discount BOOLEAN,
	price FLOAT(6, 2),
	actual_price FLOAT(6, 2),
	is_deleted BOOLEAN,
	is_popular BOOLEAN,
	small_image_url VARCHAR(500),
	big_image_url VARCHAR(500),
	creation_date DATETIME,
	category_id INT,
	sellings_count INT DEFAULT 0,
	PRIMARY KEY (id),
	CONSTRAINT fk_product_category FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE NO ACTION ON UPDATE NO ACTION
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
	CONSTRAINT fk_wishlist_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_wishlist_product FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE slide (
	id INT NOT NULL AUTO_INCREMENT,
	alias VARCHAR(255),
	button_url VARCHAR(500),
	button_text VARCHAR(200),
	button_color VARCHAR(255),
	header_text VARCHAR(500),
	slide_description VARCHAR(1000),
	image_url VARCHAR(500),
	cover_color VARCHAR(255),
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

CREATE TABLE address (
	id INT NOT NULL AUTO_INCREMENT,
	city VARCHAR(255),
	post_office VARCHAR(1000),
	email VARCHAR(100),
	phone VARCHAR(100),
	client_name VARCHAR(255),
	user_id INT,
	PRIMARY KEY (id),
	CONSTRAINT fk_address_user FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE client_order (
	id INT NOT NULL AUTO_INCREMENT,
	order_date DATETIME,
	shipping_cost FLOAT(6, 2),
	items_cost FLOAT(6, 2),
	total_cost FLOAT(6, 2),
	order_status ENUM('new', 'ready', 'delivered', 'cancelled') DEFAULT 'new',
	notes VARCHAR(2000),
	user_id INT,
	address_id INT NOT NULL,
	PRIMARY KEY(id),
	CONSTRAINT fk_client_order_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_client_order_address FOREIGN KEY (address_id) REFERENCES address(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB CHARACTER SET utf8;

CREATE TABLE order_item (
	id INT NOT NULL AUTO_INCREMENT,
	product_id INT NOT NULL,
	price FLOAT(6, 2),
	actual_price FLOAT(6, 2),
	has_discount BOOLEAN,
	item_count INT,
	total_item_cost FLOAT(6, 2),
	client_order_id INT,
	PRIMARY KEY(id),
	CONSTRAINT fk_order_item_product FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_order_item_client_order FOREIGN KEY (client_order_id) REFERENCES client_order(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB CHARACTER SET utf8;