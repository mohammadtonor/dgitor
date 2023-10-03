
create table categories(
   id int not null auto_increment primary key,
   title varchar(200),
   description text,
   depth int,
   pic_info varchar(200),
   extension varchar(200),
   is_main enum('0','1') DEFAULT '0',
   has_child enum('0','1') DEFAULT '0',
   child_count int NULL DEFAULT 0,
   category_id int,

   index category_category_index(category_id),
   CONSTRAINT category_category_fk FOREIGN Key(category_id) REFERENCES categories(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);



create table attributes(
   id int not null auto_increment primary key,
   title varchar(200),
   category_id int,

   index attribute_category_index(category_id),
   CONSTRAINT attribute_category_fk FOREIGN Key(category_id) REFERENCES categories(id),

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);



create table default_values(
   id int not null auto_increment primary key,
   value varchar(200),
   attribute_id int,

   index default_value_attribute_index(attribute_id),
   CONSTRAINT default_value_attribute_fk FOREIGN Key(attribute_id) REFERENCES attributes(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null
);



