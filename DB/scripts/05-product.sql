

create table pre_products(
   id int not null auto_increment primary key,
   title varchar(200),
   description text,
   type enum('0','1') DEFAULT '1', -- Khadamat = 0, Kala = 1
   `show` enum('0','1') DEFAULT '0', -- Namayesh Dade Beshavad = 1, Nashavad = 0
   register_user_id int,
   category_id int,

   index pre_product_user_index(register_user_id),
   CONSTRAINT pre_product_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) ,

   index pre_product_category_index(category_id),
   CONSTRAINT pre_product_category_fk FOREIGN Key(category_id) REFERENCES categories(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);



create table product_service(
   id int not null auto_increment primary key,
   title varchar(200),

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);


create table products(
   id int not null auto_increment primary key,
   title varchar(200),
   description text,
   `show` enum('0','1') DEFAULT '0', -- namayesh dade beshavad = '1' | nashavad = '0'
   price decimal(15,2),
   takkhfif_price decimal(15,2),
   expert_price decimal(15,2) default 0.00, -- gheimati ke karshenas be ma pishnahad mide
   address text,
   phone varchar(200),
   lat varchar(100),
   lng varchar(100),
   only_exchange enum('0','1') DEFAULT '0', -- baraye exchange = '0' | baraye froosh = '1' | exchange va froosh = '2'
   is_active enum('0','1') DEFAULT '1',
   pre_product_id int,
   discount_price decimal(15.2) default 0.00,
   discount_percentage int default 0,
   city_id int,
   category_id int,
   register_user_id int,
   product_service_id int,

   index product_pre_product_index(pre_product_id),
   CONSTRAINT product_pre_product_fk FOREIGN Key(pre_product_id) REFERENCES pre_products(id) ,

   index product_city_index(city_id),
   CONSTRAINT product_city_fk FOREIGN Key(city_id) REFERENCES cities(id) ,

   index product_category_index(category_id),
   CONSTRAINT product_category_fk FOREIGN Key(category_id) REFERENCES categories(id),

   index product_user_index(register_user_id),
   CONSTRAINT product_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) ,

   index product_product_service_index(product_service_id),
   CONSTRAINT product_product_service_fk FOREIGN Key(product_service_id) REFERENCES product_service(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);


create table default_val_product(
   id int not null auto_increment primary key,
   default_val_id int,
   product_id int,

   index default_val_product_default_value_index(default_val_id),
   CONSTRAINT default_val_product_default_value_fk FOREIGN Key(default_val_id) REFERENCES default_values(id) on update cascade on delete cascade,

   index default_val_product_product_index(product_id),
   CONSTRAINT default_val_product_product_fk FOREIGN Key(product_id) REFERENCES products(id) on update cascade on delete cascade,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null
);


create table product_attr_values(
   id int not null auto_increment primary key,
   `value` varchar(200),
   attribute varchar(200),

   product_id int,
   register_user_id int,

   index product_attr_value_product_index(product_id),
   CONSTRAINT product_attr_value_product_fk FOREIGN Key(product_id) REFERENCES products(id) ,

   index product_attr_value_user_index(register_user_id),
   CONSTRAINT product_attr_value_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);
