INSERT INTO user (email, password, role, name, register_date) VALUES ('a.y.stetsyura@gmail.com', 'acf2d89c77e8af6d8de1bb7b86abcbd7', 'admin', 'Алексей Стецюра', '2019-01-08 18:19:54');

INSERT INTO setting (setting_key, name, value) VALUES ('support-email', 'E-mail администратора', 'a.y.stetsyura@gmail.com');
INSERT INTO setting (setting_key, name, value) VALUES ('average-delivery-time-order', 'Средний срок доставки под заказ (дней)', 20);
INSERT INTO setting (setting_key, name, value) VALUES ('average-delivery-time-instock', 'Средний срок доставки при наличии (дней)', 2);

INSERT INTO category (id, creation_date, alias, original_name, name) VALUES (1, '2018-01-08 18:19:54', 'unsorted', 'Unsorted sets', 'Несортированные товары');
