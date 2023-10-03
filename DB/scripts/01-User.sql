
    create table countries(
       id int not null auto_increment primary key,
       name varchar(200),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );



    create table ostans(
       id int not null auto_increment primary key,
       name varchar(200),
       country_id int,

       index ostan_coutry_index(country_id),

       constraint ostan_coutry_fk foreign key (country_id) references countries(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );



    create table cities(
       id int not null auto_increment primary key,
       name varchar(200),
       country_id int,
       ostan_id int,

       index city_country_index(country_id),
       index city_ostan_index(ostan_id),

       constraint city_country_fk foreign key (country_id) references countries(id),
       constraint city_ostan_fk foreign key (ostan_id) references ostans(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );



    create table users(
       id int not null auto_increment primary key,
       `name` varchar(200),
       family varchar(200),
       ncode varchar(200),
       gender enum('male', 'female'),
       birthday date,
       username varchar(200),
       `password` varchar(200),
       email varchar(200) unique,
       pic_file text,
       description text,
       email_verified_at timestamp,
       mobile varchar(200),
       mobile_verified enum ('1', '0') default '0',
       mobile_verification_code varchar(200),
       mobile_verification_time timestamp null default null,

       is_geniue enum('1', '0') default '0',  -- Haghighi = '1' Ya Hoghooghi = '0'
       is_cutomer enum('1', '0') default '1',
       is_personel enum('1', '0') default '0',
       personnel_code varchar(20),
       remember_token varchar(100),

       city_id int,
       ostan_id int,
       country_id int,
       register_customer_id int,

       index user_city_index(city_id),
       index user_ostan_index(ostan_id),
       index user_country_index(country_id),
       index user_user_index(register_customer_id),

       constraint user_city_fk foreign key (city_id) references cities(id),
       constraint user_ostan_fk foreign key (ostan_id) references ostans(id),
       constraint user_country_fk foreign key (country_id) references countries(id),
       constraint user_user_fk foreign key (register_customer_id) references users(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );


    create table user_bank_accounts(
       id int not null auto_increment primary key,
       bank varchar(200),
       title varchar(200),
       card_number varchar(50),
       sheba varchar(100),

       user_id int,

       index user_bank_account_user_index(user_id),
       constraint user_bank_accounts_user_fk foreign key (user_id) references users(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );


    create table user_files(
       id int not null auto_increment primary key,
       title varchar(200),
       path_info text,
       extension varchar(200),

       user_id int,
       uploader_user_id int,

       index userfile_user_index(user_id),
       index userfile_uploader_user_index(uploader_user_id),

       constraint userfile_user_fk foreign key (user_id) references users(id),
       constraint userfile_uploader_user_fk foreign key (uploader_user_id) references users(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );



    create table user_madareks(
       id int not null auto_increment primary key,
       title varchar(200),
       path text,
       extension varchar(200),
       user_id int,
       uploader_user_id int,

       index usermadarek_user_index(user_id),
       index usermadarek_uploader_user_index(uploader_user_id),

       constraint usermadarek_user_fk foreign key (user_id) references users(id),
       constraint usermadarek_uploader_user_fk foreign key (uploader_user_id) references users(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );



    create table user_addresses(
       id int not null auto_increment primary key,
       title varchar(200),
       postal_code varchar(20),
       address text,

       city_id int,
       user_id int,

       index user_address_city_index(city_id),
       index user_address_user_index(user_id),

       constraint user_address_city_fk foreign key (city_id) references cities(id),
       constraint user_address_user_fk foreign key (user_id) references users(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );


    create table user_phones(
       id int not null auto_increment primary key,
       title varchar(200),
       phone varchar(20),

       user_id int,

       index user_phone_user_index(user_id),
       constraint user_phone_user_fk foreign key (user_id) references users(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null,
       deleted_at datetime null DEFAULT null
    );


    create table customer_karshenas(
       id int not null auto_increment primary key,
       customer_user_id int,
       karshenas_user_id int,

       index customer_karshenas_customer_user_index(customer_user_id),
       index customer_karshenas_karshenas_user_index(karshenas_user_id),

       constraint customer_karshenas_customer_user_fk foreign key (customer_user_id) references users(id),
       constraint customer_karshenas_karshenas_user_fk foreign key (karshenas_user_id) references users(id),

       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
       updated_at datetime null DEFAULT null
    );
