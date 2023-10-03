-- ###########################################################
-- #### Masaele Karshenasie Oomoomi

create table public_experting_questions(
   id int not null auto_increment primary key,
   title varchar(200),
   question varchar(300),
   status enum('0', '1') default '0',

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);

-- ###########################################################
-- #### Gozine Haye Karshenasi Oomoomi

create table public_experting_answers(
   id int not null auto_increment primary key,
   answer varchar(300),
   status enum('0', '1') default '0',

   public_experting_id int,

   index public_experting_answer_public_experting_index(public_experting_id),
   CONSTRAINT public_experting_answer_public_experting_fk FOREIGN Key(public_experting_id) REFERENCES public_experting_questions(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);

-- ###########################################################
-- #### Masaele Karshenasie Oomoomi

create table private_experting_questions(
   id int not null auto_increment primary key,
   title varchar(200),
   question varchar(300),
   status enum('0', '1') default '0',
   category_id int,

   index private_experting_question_category_index(category_id),
   CONSTRAINT private_experting_question_category_fk FOREIGN Key(category_id) REFERENCES categories(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);

-- ###########################################################
-- #### Gozine Haye Karshenasi Oomoomi

create table private_experting_answers(
   id int not null auto_increment primary key,
   answer varchar(300),
   status enum('0', '1') default '0',

   private_experting_id int,

   index private_experting_answer_private_experting_index(private_experting_id),
   CONSTRAINT private_experting_answer_private_experting_fk FOREIGN Key(private_experting_id) REFERENCES private_experting_questions(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);

-- ###########################################################
-- #### Gozine Haye Karshenasi Oomoomi

create table experting_types(
   id int not null auto_increment primary key,
   title varchar(200),
   cost decimal(15,2),
   category_id int,

   index experting_type_category_index(category_id),
   CONSTRAINT experting_type_category_fk FOREIGN Key(category_id) REFERENCES categories(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);

-- ###########################################################
-- #### Karshenasi ****

create table expertings(
   id int not null auto_increment primary key,
   title varchar(200),
   product_id int,
   register_user_id int,
   karshenas_user_id int,
   type_id int,


   index experting_product_index(product_id),
   CONSTRAINT experting_product_fk FOREIGN Key(product_id) REFERENCES products(id) ,

   index experting_register_user_index(register_user_id),
   CONSTRAINT experting_register_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) ,

   index experting_karshenas_user_index(karshenas_user_id),
   CONSTRAINT experting_karshenas_user_fk FOREIGN Key(karshenas_user_id) REFERENCES users(id) ,

   index experting_type_index(type_id),
   CONSTRAINT experting_type_fk FOREIGN Key(type_id) REFERENCES experting_types(id) ,



   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);



-- ###########################################################
-- #### Jadval Vaset Karshenasi, Pasokh Karshenasi, Soalate Ekhtesasi Va Oomoomi Karshenasi

create table experting_questions(
   id int not null auto_increment primary key,

   private_question_id int,
   public_question_id int,
   experting_id int,

   index privat_public_experting_answer_private_question_index(private_question_id),
   CONSTRAINT privat_public_experting_answer_private_question_fk FOREIGN Key(private_question_id) REFERENCES private_experting_questions(id) ,

   index privat_public_experting_answer_public_question_index(public_question_id),
   CONSTRAINT privat_public_experting_answer_public_question_fk FOREIGN Key(public_question_id) REFERENCES public_experting_questions(id) ,

   index privat_public_experting_answer_experting_index(experting_id),
   CONSTRAINT privat_public_experting_answer_experting_fk FOREIGN Key(experting_id) REFERENCES expertings(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);


-- ###########################################################
-- #### Gozine Haye Karshenasi

create table experting_answers(
   id int not null auto_increment primary key,
   answer varchar(300),

   public_experting_answer_id int,
   private_experting_answer_id int,
   experting_id int,
   experting_question_id int,

   index experting_answer_public_experting_answer_index(public_experting_answer_id),
   CONSTRAINT experting_answer_public_experting_answer_fk FOREIGN Key(public_experting_answer_id) REFERENCES public_experting_answers(id) ,

   index experting_answer_private_experting_answer_index(private_experting_answer_id),
   CONSTRAINT experting_answer_private_experting_answer_fk FOREIGN Key(private_experting_answer_id) REFERENCES private_experting_answers(id) ,

   index experting_answer_experting_index(experting_id),
   CONSTRAINT experting_answer_experting_fk FOREIGN Key(experting_id) REFERENCES expertings(id) ,

   index experting_answer_experting_question_index(experting_question_id),
   CONSTRAINT experting_answer_experting_question_fk FOREIGN Key(experting_question_id) REFERENCES experting_questions(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);

###########################################################
#### File Haye Pasokh Haye Karshenasi

create table experting_answer_files(
   id int not null auto_increment primary key,
   file_path text,
   extension varchar(200),
   experting_answer_id int,
   register_user_id int,

   index experting_answer_file_experting_answer_index(experting_answer_id),
   CONSTRAINT experting_answer_file_experting_answer_fk FOREIGN Key(experting_answer_id) REFERENCES experting_answers(id) ,

   index experting_answer_file_user_index(register_user_id),
   CONSTRAINT experting_answer_file_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) ,

   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
   updated_at datetime null DEFAULT null,
   deleted_at datetime null DEFAULT null
);

