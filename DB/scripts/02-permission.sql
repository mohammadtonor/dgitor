
create table permissions(
   id int not null auto_increment primary key,
   name_en varchar(200),
   name_fa varchar(200),

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);



create table roles(
   id int not null auto_increment primary key,
   name_en varchar(200),
   name_fa varchar(200),
   `status` enum('1', '0') default '0',

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);



create table role_permission(
   id int not null auto_increment primary key,
   role_id int,
   permission_id int,

   index role_permission_role_index(role_id),
   index role_permission_permission_index(permission_id),

   constraint role_permission_role_fk foreign key (role_id) references roles(id),
   constraint role_permission_permission_fk foreign key (permission_id) references permissions(id),

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null
);


create table vip_permission(
   id int not null auto_increment primary key,
   permission_id int,
   user_id int,

   index vip_permission_permission_index(permission_id),
   index vip_permission_user_index(user_id),

   constraint vip_permission_permission_fk foreign key (permission_id) references permissions(id),
   constraint vip_permission_user_fk foreign key (user_id) references users(id),

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null
);



create table block_permission(
   id int not null auto_increment primary key,
   permission_id int,
   user_id int,

   index block_permission_permission_index(permission_id),
   index block_permission_user_index(user_id),

   constraint block_permission_permission_fk foreign key (permission_id) references permissions(id),
   constraint block_permission_user_fk foreign key (user_id) references users(id),

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null
);



create table role_user(
   id int not null auto_increment primary key,
   role_id int,
   user_id int,

   index role_user_role_index(role_id),
   index role_user_user_index(user_id),

   constraint role_user_role_fk foreign key (role_id) references roles(id),
   constraint role_user_user_fk foreign key (user_id) references users(id),

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null
);
