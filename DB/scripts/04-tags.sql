


create table tags (
   id int not null auto_increment primary key,
   title varchar(200),

   created_at timestamp null default current_timestamp,
   updated_at timestamp null default null,
   deleted_at timestamp null default null

);


create table category_tag (
   id int not null auto_increment primary key,
   category_id int not null,
   tag_id int not null,

   index category_tag_category_id_index(category_id),
   constraint category_tag_category_fk foreign key (category_id) references categories(id),

   index category_tag_tag_id_index(tag_id),
   constraint category_tag_tag_fk foreign key (tag_id) references tags(id),

   created_at timestamp null default current_timestamp,
   updated_at timestamp null default null
);
