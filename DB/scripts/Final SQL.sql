
# -------------------------------------------------- Permission Section -------------------------------------------------- #
# ------------------------------ permissions ------------------------------ #
# ----> سطوح دسترسی

create table permissions(
                            id int not null auto_increment primary key,
                            name varchar(200),

                            created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                            updated_at datetime null DEFAULT null,
                            deleted_at datetime null DEFAULT null
);



create table roles(
                      id int not null auto_increment primary key,
                      `name` varchar(200),
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
                      personnel_code varchar(20),
                      remember_token varchar(100),
                      is_customer enum('1', '0') default '0',

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

# ------------------------------ user_files ------------------------------ #
# ----> فایل های کاربر

create table user_files(
                           id int not null auto_increment primary key,
                           title varchar(200),
                           path text,
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

# ------------------------------ user_madareks ------------------------------ #
# ----> مدرک های کاربر

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

# ------------------------------ user_addresses ------------------------------ #
# ----> آدرس های کاربر

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

# ------------------------------ user_phones ------------------------------ #
# ----> شماره های کاربر

create table user_phones(
                            id int not null auto_increment primary key,
                            title varchar(200),
                            phone varchar(20),
                            address text,

                            city_id int,
                            user_id int,

                            index user_phone_city_index(city_id),
                            index user_phone_user_index(user_id),

                            constraint user_phone_city_fk foreign key (city_id) references cities(id),
                            constraint user_phone_user_fk foreign key (user_id) references users(id),

                            created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                            updated_at datetime null DEFAULT null,
                            deleted_at datetime null DEFAULT null
);


# ------------------------------ user_bankaccounts ------------------------------ #
# ----> حساب های بانکی کاربر

create table user_bank_accounts(
                                   id int not null auto_increment primary key,
                                   bank varchar(200),
                                   title varchar(200),
                                   card_number varchar(50),
                                   sheba varchar(100),

                                   city_id int,
                                   user_id int,

                                   index user_bank_account_city_index(city_id),
                                   index user_bank_account_user_index(user_id),

                                   constraint user_bank_account_city_fk foreign key (city_id) references cities(id),
                                   constraint user_bank_accounts_user_fk foreign key (user_id) references users(id),

                                   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                   updated_at datetime null DEFAULT null,
                                   deleted_at datetime null DEFAULT null
);

# ------------------------------ customer_karshenas ------------------------------ #
# ----> جدول میانی مشتری کارشناس

create table customer_karshenas(
                                   id int not null auto_increment primary key,
                                   customer_user_id int,
                                   karshenas_user_id int,

                                   index customer_karshenas_customer_user_index(customer_user_id),
                                   index customer_karshenas_karshenas_user_index(karshenas_user_id),

                                   constraint customer_karshenas_customer_user_fk foreign key (customer_user_id) references users(id),
                                   constraint customer_karshenas_karshenas_user_fk foreign key (karshenas_user_id) references users(id),

                                   created_at datetime null DEFAULT CURRENT_TIMESTAMP
);

# ------------------------------ vip_permission ------------------------------ #
# ----> دسترسی های ویژه کاربر

create table vip_permission(
                               id int not null auto_increment primary key,
                               permission_id int,
                               user_id int,

                               index vip_permission_permission_index(permission_id),
                               index vip_permission_user_index(user_id),

                               constraint vip_permission_permission_fk foreign key (permission_id) references permissions(id),
                               constraint vip_permission_user_fk foreign key (user_id) references users(id),

                               created_at datetime null DEFAULT CURRENT_TIMESTAMP
);

# ------------------------------ block_permission ------------------------------ #
# ----> دسترسی های گرفته شده از کاربر

create table block_permission(
                                 id int not null auto_increment primary key,
                                 permission_id int,
                                 user_id int,

                                 index block_permission_permission_index(permission_id),
                                 index block_permission_user_index(user_id),

                                 constraint block_permission_permission_fk foreign key (permission_id) references permissions(id),
                                 constraint block_permission_user_fk foreign key (user_id) references users(id),

                                 created_at datetime null DEFAULT CURRENT_TIMESTAMP
);

# ------------------------------ role_user ------------------------------ #
# ----> جدول میانی بین users و roles

create table role_user(
                          id int not null auto_increment primary key,
                          role_id int,
                          user_id int,

                          index role_user_role_index(role_id),
                          index role_user_user_index(user_id),

                          constraint role_user_role_fk foreign key (role_id) references roles(id),
                          constraint role_user_user_fk foreign key (user_id) references users(id),

                          created_at datetime null DEFAULT CURRENT_TIMESTAMP
);

# ------------------------------ password_reset_tokens ------------------------------ #
# ----> جدول توکن های ریست پسورد کاربر

create table password_reset_tokens(
                                      id int not null auto_increment primary key,
                                      email varchar(255),
                                      token varchar(255),

                                      created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                      updated_at datetime null DEFAULT null,
                                      deleted_at datetime null DEFAULT null
);


# -------------------------------------------------- Exchange Section -------------------------------------------------- #
# ------------------------------ categories ------------------------------ #
# ----> دسته بندی ها
# - hasan
create table categories(
                           id int not null auto_increment primary key,
                           title varchar(200),
                           description text,
                           depth int,
                           cat_pic varchar(200),
                           extension varchar(200),
                           is_main enum('0','1') DEFAULT '0',
                           has_child enum('0','1') DEFAULT '0',
                           child_count int NULL DEFAULT 0,
                           category_id int,

                           index category_category_index(category_id),
                           CONSTRAINT category_category_fk FOREIGN Key(category_id) REFERENCES categories(id) on update cascade on delete cascade,

                           created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                           updated_at datetime null DEFAULT null,
                           deleted_at datetime null DEFAULT null
);

# ------------------------------ category_user ------------------------------ #
# ---->

create table category_user(
                              id int not null auto_increment primary key,
                              category_id int,
                              user_id int,

                              index category_user_category_index(category_id),
                              CONSTRAINT category_user_category_fk FOREIGN Key(category_id) REFERENCES categories(id) on update cascade on delete cascade,

                              index category_user_user_index(user_id),
                              CONSTRAINT category_user_user_fk FOREIGN Key(user_id) REFERENCES users(id) on update cascade on delete cascade,

                              created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                              updated_at datetime null DEFAULT null,
                              deleted_at datetime null DEFAULT null
);

# ------------------------------ attributes ------------------------------ #
# ----> ویژگی ها

create table attributes(
                           id int not null auto_increment primary key,
                           title varchar(200),
                           category_id int,

                           index attribute_category_index(category_id),
                           CONSTRAINT attribute_category_fk FOREIGN Key(category_id) REFERENCES categories(id) on update cascade on delete cascade,

                           created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                           updated_at datetime null DEFAULT null,
                           deleted_at datetime null DEFAULT null
);

# ------------------------------ default_values ------------------------------ #
# ----> مقادیر از پیش تعریف شده برای ویژگی ها

create table default_values(
                               id int not null auto_increment primary key,
                               title varchar(200),
                               attr_id int,

                               index default_value_attribute_index(attr_id),
                               CONSTRAINT default_value_attribute_fk FOREIGN Key(attr_id) REFERENCES attributes(id) on update cascade on delete cascade,

                               created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                               updated_at datetime null DEFAULT null,
                               deleted_at datetime null DEFAULT null
);

# ------------------------------ pre_products ------------------------------ #
# ----> محصولات از پیش تعریف شده ( محصولاتی که در جدول محصولات موجود نیستند )

create table pre_products(
                             id int not null auto_increment primary key,
                             title varchar(200),
                             description text,
                             type enum('0','1') DEFAULT '1', -- Khadamat = 0, Kala = 1
                             `show` enum('0','1') DEFAULT '0', -- Namayesh Dade Beshavad = 1, Nashavad = 0
                             register_user_id int,
                             category_id int,

                             index pre_product_user_index(register_user_id),
                             CONSTRAINT pre_product_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

                             index pre_product_category_index(category_id),
                             CONSTRAINT pre_product_category_fk FOREIGN Key(category_id) REFERENCES categories(id) on update cascade on delete cascade,

                             created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                             updated_at datetime null DEFAULT null,
                             deleted_at datetime null DEFAULT null
);

# ------------------------------ product_service ------------------------------ #
# ----> سرویس هایی که همراه با کالا یا خدمات ارائه می شود

create table product_service(
                                id int not null auto_increment primary key,
                                title varchar(200),

                                created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                updated_at datetime null DEFAULT null,
                                deleted_at datetime null DEFAULT null
);

# ------------------------------ products ------------------------------ #
# ----> کالا ها یا خدمات
# - hasan
create table products(
                         id int not null auto_increment primary key,
                         title varchar(200),
                         description text,
                         `show` enum('0','1') DEFAULT '0', -- namayesh dade beshavad = '1' | nashavad = '0'
                         price decimal(15,2),
                         expert_price decimal(15,2), -- gheimati ke karshenas be ma pishnahad mide
                         address text,
                         phone varchar(200),
                         lat varchar(100),
                         lng varchar(100),
                         for_sale enum('0','1','2') DEFAULT '0', -- baraye exchange = '0' | baraye froosh = '1' | exchange va froosh = '2'
                         active enum('0','1') DEFAULT '0',
                         pre_product_id int,
                         discount_price decimal(15.2),
    discount_percentage int,
    city_id int,
    category_id int,
    register_user_id int,
    product_service_id int,

	index product_pre_product_index(pre_product_id),
    CONSTRAINT product_pre_product_fk FOREIGN Key(pre_product_id) REFERENCES pre_products(id) on update cascade on delete cascade,

    index product_city_index(city_id),
    CONSTRAINT product_city_fk FOREIGN Key(city_id) REFERENCES cities(id) on update cascade on delete cascade,

    index product_category_index(category_id),
    CONSTRAINT product_category_fk FOREIGN Key(category_id) REFERENCES categories(id) on update cascade on delete cascade,

    index product_user_index(register_user_id),
    CONSTRAINT product_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

    index product_product_service_index(product_service_id),
    CONSTRAINT product_product_service_fk FOREIGN Key(product_service_id) REFERENCES product_service(id) on update cascade on delete cascade,

    created_at datetime null DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime null DEFAULT null,
    deleted_at datetime null DEFAULT null
);

# ------------------------------ product_attr_values ------------------------------ #
# ----> ویژگی های اختصاصی کالا یا خدمات ( به همراه مقادیرشون )

create table product_attr_values(
                                    id int not null auto_increment primary key,
                                    `value` varchar(200),
                                    attribute varchar(200),

                                    product_id int,
                                    register_user_id int,

                                    index product_attr_value_product_index(product_id),
                                    CONSTRAINT product_attr_value_product_fk FOREIGN Key(product_id) REFERENCES products(id) on update cascade on delete cascade,

                                    index product_attr_value_user_index(register_user_id),
                                    CONSTRAINT product_attr_value_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

                                    created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                    updated_at datetime null DEFAULT null,
                                    deleted_at datetime null DEFAULT null
);

# ------------------------------ default_val_product ------------------------------ #
# ----> مقادیر ویژگی های کالا یا خدمات

create table default_val_product(
                                    id int not null auto_increment primary key,
                                    default_val_id int,
                                    product_id int,

                                    index default_val_product_default_value_index(default_val_id),
                                    CONSTRAINT default_val_product_default_value_fk FOREIGN Key(default_val_id) REFERENCES default_values(id) on update cascade on delete cascade,

                                    index default_val_product_product_index(product_id),
                                    CONSTRAINT default_val_product_product_fk FOREIGN Key(product_id) REFERENCES products(id) on update cascade on delete cascade,

                                    created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                    updated_at datetime null DEFAULT null,
                                    deleted_at datetime null DEFAULT null
);

# ------------------------------ product_pics ------------------------------ #
# ----> تصاویر کالا یا خدمات

create table product_pics(
                             id int not null auto_increment primary key,
                             path text,
                             extension varchar(200),
                             product_id int,
                             register_user_id int,

                             index product_pic_product_index(product_id),
                             CONSTRAINT product_pic_product_fk FOREIGN Key(product_id) REFERENCES products(id) on update cascade on delete cascade,

                             index product_pic_user_index(register_user_id),
                             CONSTRAINT product_pic_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

                             created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                             updated_at datetime null DEFAULT null,
                             deleted_at datetime null DEFAULT null
);

# ------------------------------ favorites ------------------------------ #
# ----> علاقه مندی ها

create table favorites(
                          id int not null auto_increment primary key,
                          description text,
                          price decimal(15,2),
                          is_exists enum('0','1') default '0',
                          product_id int,
                          register_user_id int,
                          pre_product_id int,

                          index favorite_product_index(product_id),
                          CONSTRAINT favorite_product_fk FOREIGN Key(product_id) REFERENCES products(id) on update cascade on delete cascade,

                          index favorite_user_index(register_user_id),
                          CONSTRAINT favorite_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

                          index favorite_pre_product_index(pre_product_id),
                          CONSTRAINT favorite_pre_product_fk FOREIGN Key(pre_product_id) REFERENCES pre_products(id) on update cascade on delete cascade,

                          created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                          updated_at datetime null DEFAULT null,
                          deleted_at datetime null DEFAULT null
);

# ------------------------------ periodic_services ------------------------------ #
# ----> خدمات دوره ای
# - hasan
create table periodic_services(
                                  id int not null auto_increment primary key,
                                  type enum('0', '1') default '0', -- kharid = '0' | exchange = '1'

                                  title varchar(200),
                                  description text,
                                  `end` enum('0','1') default '0',

                                  periodic_count int, -- tedade dore haye khadamate doreyie

                                  first_side_confirm enum('0','1') default '0',
                                  second_side_confirm enum('0','1') default '0',

                                  product1_price decimal(15,2),
                                  product2_price decimal(15,2),

                                  mavotafavot decimal(15,2),
                                  payer_mavotafavot enum('1', '2'), -- pardakht konande mavotafavot: tarafe aval = '1' | tarafe dovom = '2'

                                  product1_id int,
                                  product2_id int default null,

                                  pre_product_id int default null,
                                  product1_category_id int,
                                  product2_category_id int default null,
                                  register_user_id int, -- useri ke darkhast dade

                                  index periodic_service_product1_index(product1_id),
                                  CONSTRAINT periodic_service_product1_fk FOREIGN Key(product1_id) REFERENCES products(id) on update cascade on delete cascade,

                                  index periodic_service_product2_index(product2_id),
                                  CONSTRAINT periodic_service_product2_fk FOREIGN Key(product2_id) REFERENCES products(id) on update cascade on delete cascade,

                                  index periodic_service_pre_product_index(pre_product_id),
                                  CONSTRAINT periodic_service_pre_product1_fk FOREIGN Key(pre_product_id) REFERENCES pre_products(id) on update cascade on delete cascade,

                                  index periodic_service_category1_index(product1_category_id),
                                  CONSTRAINT periodic_service_category1_fk FOREIGN Key(product1_category_id) REFERENCES categories(id) on update cascade on delete cascade,

                                  index periodic_service_category2_index(product2_category_id),
                                  CONSTRAINT periodic_service_category2_fk FOREIGN Key(product2_category_id) REFERENCES categories(id) on update cascade on delete cascade,

                                  index periodic_service_user_index(register_user_id),
                                  CONSTRAINT periodic_service_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

                                  created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                  updated_at datetime null DEFAULT null,
                                  deleted_at datetime null DEFAULT null
);

# ------------------------------ periodic_service_pics ------------------------------ #
# ----> تصاویر خدمات دوره ای

create table periodic_service_pics(
                                      id int not null auto_increment primary key,
                                      path text,
                                      extension varchar(200),
                                      periodic_service_id int,
                                      register_user_id int,

                                      index periodic_service_pic_periodic_service_index(periodic_service_id),
                                      CONSTRAINT periodic_service_pic_periodic_service_fk FOREIGN Key(periodic_service_id) REFERENCES periodic_services(id) on update cascade on delete cascade,

                                      index periodic_service_pic_user_index(register_user_id),
                                      CONSTRAINT periodic_service_pic_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

                                      created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                      updated_at datetime null DEFAULT null,
                                      deleted_at datetime null DEFAULT null
);

# ------------------------------ periodic_service_descs ------------------------------ #
# ----> تضیحات خدمات دوره ای

create table periodic_service_descs(
                                       id int not null auto_increment primary key,
                                       description text,
                                       periodic_service_id int,

                                       index periodic_service_desc_periodic_service_index(periodic_service_id),
                                       CONSTRAINT periodic_service_desc_periodic_service_fk FOREIGN Key(periodic_service_id) REFERENCES periodic_services(id) on update cascade on delete cascade,

                                       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                       updated_at datetime null DEFAULT null,
                                       deleted_at datetime null DEFAULT null
);

# ------------------------------ periodic_service_times ------------------------------ #
# ----> زمان یندی خدمات دوره ای
# - hasan
create table periodic_service_times(
                                       id int not null auto_increment primary key,
                                       start_contract_date date, -- tarikhe aghde gharardad
                                       start_date TIMESTAMP null DEFAULT null, -- zaman eraee (shorooe) khadamat
                                       periodic_time int, -- har chand vaght yek bar (datatype = rooz)
                                       how_long enum('hour','day', 'week', 'month', '3 month', '6 month', '9 month', 'year') DEFAULT 'year', -- baraye che modati
                                       periodic_service_id int,

                                       index periodic_service_time_periodic_service_index(periodic_service_id),
                                       CONSTRAINT periodic_service_time_periodic_service_fk FOREIGN Key(periodic_service_id) REFERENCES periodic_services(id) on update cascade on delete cascade,

                                       created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                       updated_at datetime null DEFAULT null,
                                       deleted_at datetime null DEFAULT null
);

# ------------------------------ periodic_service_archives ------------------------------ #
# ----> آرشیو خدمات دوره ای انجام شده

create table periodic_service_archives(
                                          id int not null auto_increment primary key,
                                          service_time TIMESTAMP null DEFAULT null,
                                          done enum('0','1') default '0',
                                          `end` enum('0','1') default '0',
                                          is_satisfied enum('0','1') default '0',
                                          periodic_service_id int,

                                          index periodic_service_archive_periodic_service_index(periodic_service_id),
                                          CONSTRAINT periodic_service_archive_periodic_service_fk FOREIGN Key(periodic_service_id) REFERENCES periodic_services(id) on update cascade on delete cascade,

                                          created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                          updated_at datetime null DEFAULT null,
                                          deleted_at datetime null DEFAULT null
);

# ------------------------------ exchange_statuses ------------------------------ #
# ----> وضعیت معاوضه

create table exchange_statuses(
                                  id int not null auto_increment primary key,
                                  title varchar(200),

                                  created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                  updated_at datetime null DEFAULT null,
                                  deleted_at datetime null DEFAULT null
);

# ------------------------------ exchanges ------------------------------ #
# ----> معاوضه
# - hasan
create table exchanges(
                          id int not null auto_increment primary key,
                          description text,
                          type enum('0', '1') DEFAULT '0', -- Bar Asase Gheymat = '0' Ya Bar Asase Kala = '1'
                          done enum('0','1') default '0',
                          taamin enum('0','1') default '0', -- Dar Hozoor Karshenas = '1'
                          has_expert enum('0','1') default '0', -- Karshenas Dare = '1' Nadare = '0'
                          first_side_confirm enum('0','1') default '0',
                          second_side_confirm enum('0','1') default '0',
                          is_suggested enum('0','1') default '0',  -- Shoma (user 1) Pishnahad Dadid Ya Na
                          is_exchange enum('0','1', '2') default '0', -- kharid = '0' exchange = '1' kharid va exchange = '2'

                          product1_price decimal(15,2),
                          product2_price decimal(15,2),

                          mavotafavot decimal(15,2),
                          payer_mavotafavot enum('1', '2'), -- pardakht konande mavotafavot: tarafe aval = '1' | tarafe dovom = '2'

                          status_id int,

                          product1_id int,
                          product2_id int,

                          pre_product_id int,
                          periodic_service_id int,

                          product1_category_id int,
                          product2_category_id int,

                          register_user1_id int,
                          register_user2_id int,

                          index exchange_status_index(status_id),
                          CONSTRAINT exchange_status_fk FOREIGN Key(status_id) REFERENCES exchange_statuses(id) on update cascade on delete cascade,

                          index exchange_product1_index(product1_id),
                          CONSTRAINT exchange_product1_fk FOREIGN Key(product1_id) REFERENCES products(id) on update cascade on delete cascade,

                          index exchange_product2_index(product2_id),
                          CONSTRAINT exchange_product2_fk FOREIGN Key(product2_id) REFERENCES products(id) on update cascade on delete cascade,

                          index exchange_pre_product_id_index(pre_product_id),
                          CONSTRAINT exchange_pre_product_id_fk FOREIGN Key(pre_product_id) REFERENCES pre_products(id) on update cascade on delete cascade,

                          index exchange_category1_index(product1_category_id),
                          CONSTRAINT exchange_category1_fk FOREIGN Key(product1_category_id) REFERENCES categories(id) on update cascade on delete cascade,

                          index exchange_category2_index(product2_category_id),
                          CONSTRAINT exchange_category2_fk FOREIGN Key(product2_category_id) REFERENCES categories(id) on update cascade on delete cascade,

                          index exchange_periodic_service_index(periodic_service_id),
                          CONSTRAINT exchange_periodic_service_fk FOREIGN Key(periodic_service_id) REFERENCES periodic_services(id) on update cascade on delete cascade,

                          index exchange_user1_index(register_user1_id),
                          CONSTRAINT exchange_user1_fk FOREIGN Key(register_user1_id) REFERENCES users(id) on update cascade on delete cascade,

                          index exchange_user2_index(register_user2_id),
                          CONSTRAINT exchange_user2_fk FOREIGN Key(register_user2_id) REFERENCES users(id) on update cascade on delete cascade,

                          created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                          updated_at datetime null DEFAULT null,
                          deleted_at datetime null DEFAULT null
);

# ------------------------------ attribute_default_val_exchange ------------------------------ #
# ---->

create table attribute_default_val_exchange(
                                               id int not null auto_increment primary key,
                                               attribute_id int,
                                               default_value_id int,
                                               exchange_id int,

                                               index attribute_default_val_exchange_attribute_index(attribute_id),
                                               CONSTRAINT attribute_default_val_exchange_attribute_fk FOREIGN Key(attribute_id) REFERENCES attributes(id) on update cascade on delete cascade,

                                               index attribute_default_val_exchange_default_value_index(default_value_id),
                                               CONSTRAINT attribute_default_val_exchange_default_value_fk FOREIGN Key(default_value_id) REFERENCES default_values(id) on update cascade on delete cascade,

                                               index attribute_default_val_exchange_exchange_index(exchange_id),
                                               CONSTRAINT attribute_default_val_exchange_exchange_fk FOREIGN Key(exchange_id) REFERENCES exchanges(id) on update cascade on delete cascade,

                                               created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                               updated_at datetime null DEFAULT null,
                                               deleted_at datetime null DEFAULT null
);

# ------------------------------ exchange_attr_values ------------------------------ #
# ---->

create table exchange_attr_values(
                                     id int not null auto_increment primary key,
                                     `value` varchar(200),
                                     attribute varchar(200),

                                     exchange_id int,

                                     index exchange_attr_value_exchange_index(exchange_id),
                                     CONSTRAINT exchange_attr_value_exchange_fk FOREIGN Key(exchange_id) REFERENCES exchanges(id) on update cascade on delete cascade,

                                     created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                     updated_at datetime null DEFAULT null,
                                     deleted_at datetime null DEFAULT null
);

# ------------------------------ public_expertings ------------------------------ #
# ----> کارشناسی عمومی
#- hasan
create table public_expertings(
                                  id int not null auto_increment primary key,
                                  title text,
                                  cost decimal(15,2), -- hazine karshenasi

                                  created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                  updated_at datetime null DEFAULT null,
                                  deleted_at datetime null DEFAULT null
);

# ------------------------------ public_experting_options ------------------------------ #
# ----> گزینه های کارشناسی عمومی

create table public_experting_options(
                                         id int not null auto_increment primary key,
                                         title varchar(200),
                                         description text,

                                         public_experting_id int,

                                         index public_experting_option_public_experting_index(public_experting_id),
                                         CONSTRAINT public_experting_option_public_experting_fk FOREIGN Key(public_experting_id) REFERENCES public_expertings(id) on update cascade on delete cascade,

                                         created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                         updated_at datetime null DEFAULT null,
                                         deleted_at datetime null DEFAULT null
);

# ------------------------------ private_expertings ------------------------------ #
# ----> کارشناسی اختصاصی
# - hasan
create table private_expertings(
                                   id int not null auto_increment primary key,
                                   title text,
                                   cost decimal(15,2), -- hazine karshenasi

                                   created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                   updated_at datetime null DEFAULT null,
                                   deleted_at datetime null DEFAULT null
);

# ------------------------------ private_experting_options ------------------------------ #
# ----> گزینه های کارشناسی اختصاصی

create table private_experting_options(
                                          id int not null auto_increment primary key,
                                          title varchar(200),
                                          description text,

                                          private_experting_id int,

                                          index private_experting_option_private_experting_index(private_experting_id),
                                          CONSTRAINT private_experting_option_private_experting_fk FOREIGN Key(private_experting_id) REFERENCES private_expertings(id) on update cascade on delete cascade,

                                          created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                          updated_at datetime null DEFAULT null,
                                          deleted_at datetime null DEFAULT null
);

# ------------------------------ expertings ------------------------------ #
# ----> کارشناسی
# - hasan
create table expertings(
                           id int not null auto_increment primary key,
                           title text,
                           cost decimal(15,2), -- hazine karshenasi
                           product_id int,
                           register_user_id int,
                           private_experting_id int,
                           public_experting_id int,

                           index experting_product_index(product_id),
                           CONSTRAINT experting_product_fk FOREIGN Key(product_id) REFERENCES products(id) on update cascade on delete cascade,

                           index experting_user_index(register_user_id),
                           CONSTRAINT experting_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

                           index experting_private_experting_index(private_experting_id),
                           CONSTRAINT experting_private_experting_fk FOREIGN Key(private_experting_id) REFERENCES private_expertings(id) on update cascade on delete cascade,

                           index experting_public_experting_index(public_experting_id),
                           CONSTRAINT experting_public_experting_fk FOREIGN Key(public_experting_id) REFERENCES public_expertings(id) on update cascade on delete cascade,

                           created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                           updated_at datetime null DEFAULT null,
                           deleted_at datetime null DEFAULT null
);

# ------------------------------ experting_options ------------------------------ #
# ----> گزینه های کارشناسی

create table experting_options(
                                  id int not null auto_increment primary key,
                                  title varchar(200),
                                  description text,

                                  public_experting_option_id int,
                                  private_experting_option_id int,
                                  experting_id int,

                                  index experting_option_public_experting_option_index(public_experting_option_id),
                                  CONSTRAINT experting_option_public_experting_option_fk FOREIGN Key(public_experting_option_id) REFERENCES public_experting_options(id) on update cascade on delete cascade,

                                  index experting_option_private_experting_option_index(private_experting_option_id),
                                  CONSTRAINT experting_option_private_experting_option_fk FOREIGN Key(private_experting_option_id) REFERENCES private_experting_options(id) on update cascade on delete cascade,

                                  index experting_option_experting_index(experting_id),
                                  CONSTRAINT experting_option_experting_fk FOREIGN Key(experting_id) REFERENCES expertings(id) on update cascade on delete cascade,

                                  created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                  updated_at datetime null DEFAULT null,
                                  deleted_at datetime null DEFAULT null
);

# ------------------------------ experting_option_pics ------------------------------ #
# ----> تصاویر گزینه های کارشناسی

create table experting_option_pics(
                                      id int not null auto_increment primary key,
                                      path text,
                                      extension varchar(200),
                                      experting_option_id int,
                                      register_user_id int,

                                      index experting_option_pic_experting_option_index(experting_option_id),
                                      CONSTRAINT experting_option_pic_experting_option_fk FOREIGN Key(experting_option_id) REFERENCES experting_options(id) on update cascade on delete cascade,

                                      index experting_option_pic_user_index(register_user_id),
                                      CONSTRAINT experting_option_pic_user_fk FOREIGN Key(register_user_id) REFERENCES users(id) on update cascade on delete cascade,

                                      created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                      updated_at datetime null DEFAULT null,
                                      deleted_at datetime null DEFAULT null
);

# ------------------------------ tags ------------------------------ #
# ----> تگ ها
# - hasan
create table tags (
                      id int not null auto_increment primary key,
                      title varchar(200),

                      created_at timestamp null default current_timestamp,
                      updated_at timestamp null default null,
                      deleted_at timestamp null default null

) engine=innodb;

# ------------------------------ category_tag ------------------------------ #
# ----> جدول میانی بین tags و categories
# - hasan
create table category_tag (
                              id int not null auto_increment primary key,
                              category_id int not null,
                              tag_id int not null,

                              index category_tag_category_id_index(category_id),
                              constraint category_tag_category_fk foreign key (category_id) references categories(id),

                              index category_tag_tag_id_index(tag_id),
                              constraint category_tag_tag_fk foreign key (tag_id) references tags(id),

                              created_at timestamp null default current_timestamp,
                              updated_at timestamp null default null,
                              deleted_at timestamp null default null
) engine=innodb;


# -------------------------------------------------- Financial Section -------------------------------------------------- #
# ------------------------------ totalfins ------------------------------ #
# ----> وضعیت مالی کلی کاربر
# - hasan
create table totalfins(
                          id int not null auto_increment primary key,
                          total_purchase decimal(15,2), -- ta konoon che ghadr kharid karde
                          total_exchange decimal(15,2), -- ta konoon che ghadr exchange anjam dade ( mavotafavot pardakht karde )
                          total_periodic_service decimal(15,2), -- ta konoon che ghadr periodic service kharidari ya exchange karde
                          total_experting decimal(15,2), -- ta konoon che ghadr az karshenasi estefade karde
                          etebar_naghdi_estefade decimal(15,2),
                          mojodi_wallet decimal(15,2),
                          mojodi_bon decimal(15,2),
                          sum_etebar_wallet_estefade decimal(15,2),
                          sum_etebar_bon_estefade decimal(15,2),
                          sum_trans_dargah decimal(15,2),
                          sum_esterdad decimal(15,2),
                          sum_pouse decimal(15,2),
                          sum_takhfif decimal(15,2),
                          totalkharid decimal(15,2),
                          pardakhti decimal(15,2),

                          user_id int,

                          index user_totalfins_user_index(user_id),
                          CONSTRAINT user_totalfins_user_fk FOREIGN Key(user_id) REFERENCES users(id),

                          created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                          updated_at timestamp null DEFAULT null,
                          deleted_at timestamp null DEFAULT null
);

# ------------------------------ transtypes ------------------------------ #
# ----> نوع تراکنش

create table transtypes(
                           id int not null auto_increment primary key,
                           title varchar(200),
                           description text,

                           created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                           updated_at timestamp null DEFAULT null,
                           deleted_at timestamp null DEFAULT null
);

# ------------------------------ payment_gateways ------------------------------ #
# ----> درگاه های پرداخت

create table payment_gateways(
                                 id int not null auto_increment primary key,
                                 title varchar(200),
                                 description text,
                                 config text,
                                 path text,

                                 is_active enum('0','1') DEFAULT '1',

                                 used_count int DEFAULT 0,
                                 dargah_rial decimal(15,2) DEFAULT 0.00,

                                 created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                 updated_at datetime null DEFAULT null,
                                 deleted_at datetime null DEFAULT null
);

# ------------------------------ periodic_service_detailfins ------------------------------ #
# ----> وضعیت مالی جزئی سرویس های دوره ای
# - hasan
create table periodic_service_detailfins(
                                            id int not null auto_increment primary key,
                                            description text,
                                            price decimal(15,2),
                                            periodic_count int,
                                            total_price decimal(15,2),
                                            final_price decimal(15,2),
                                            mavotafavot decimal(15,2),
                                            esterdadvajh decimal(15,2),
                                            naghdi decimal(15,2),
                                            enteghal decimal(15,2),
                                            pouse decimal(15,2),
                                            dargah decimal(15,2),
                                            wallet decimal(15,2),
                                            wallet_trans decimal(15,2),
                                            bon decimal(15,2),
                                            bon_trans decimal(15,2),
                                            totalkharid decimal(15,2),
                                            bestankar decimal(15,2),
                                            bedehkar decimal(15,2),

                                            periodic_service_id int,

                                            index periodic_service_detailfins_periodic_service_index(periodic_service_id),
                                            CONSTRAINT periodic_service_detailfins_periodic_service_fk FOREIGN Key(periodic_service_id) REFERENCES periodic_services(id),

                                            created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                            updated_at datetime null DEFAULT null,
                                            deleted_at datetime null DEFAULT null
);

# ------------------------------ periodic_service_detailfins_trans ------------------------------ #
# ----> گردش مالی جزئیات مالی سرویس های دوره ای
# - hasan
create table periodic_service_detailfins_trans(
                                                  id int not null auto_increment primary key,
                                                  info longblob,
                                                  price decimal(15,2),
                                                  periodic_count int,
                                                  total_price decimal(15,2),
                                                  final_price decimal(15,2),
                                                  mavotafavot decimal(15,2),
                                                  enteghal decimal(15,2),
                                                  wallet decimal(15,2),
                                                  bon decimal(15,2),
                                                  dargah decimal(15,2),
                                                  pouse decimal(15,2),
                                                  naghdi decimal(15,2),
                                                  sum_takhfif decimal(15,2),
                                                  moghaierat decimal(15,2),
                                                  esterdad_wallet decimal(15,2),
                                                  esterdad_card decimal(15,2),

                                                  detailfin_id int,
                                                  transtype_id int,
                                                  gateway_id int default null,

                                                  index periodic_service_detailfins_trans_detailfin_index(detailfin_id),
                                                  CONSTRAINT periodic_service_detailfins_trans_detailfin_fk FOREIGN Key(detailfin_id) REFERENCES periodic_service_detailfins(id) on update cascade on delete cascade,

                                                  index periodic_service_detailfins_trans_transtype_index(transtype_id),
                                                  CONSTRAINT periodic_service_detailfins_trans_transtype_fk FOREIGN Key(transtype_id) REFERENCES transtypes(id) on update cascade on delete cascade,

                                                  index periodic_service_detailfins_trans_payment_gateway_index(gateway_id),
                                                  CONSTRAINT periodic_service_detailfins_trans_payment_gateway_fk FOREIGN Key(gateway_id) REFERENCES payment_gateways(id) on update cascade on delete cascade,

                                                  created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                                  updated_at datetime null DEFAULT null,
                                                  deleted_at datetime null DEFAULT null
);

# ------------------------------ orders ------------------------------ #
# ----> سفارشات

create table orders(
                       id int not null auto_increment primary key,
                       ordernumber varchar(200),
                       info longblob,
                       rezerv varchar(200),
                       status_id int,
                       user_id int,
                       karshenas_id int default null,

                       index order_user_index(user_id),
                       CONSTRAINT order_user_fk FOREIGN Key(user_id) REFERENCES users(id),

                       index order_karshenas_user_index(karshenas_id),
                       CONSTRAINT order_karshenas_user_fk FOREIGN Key(karshenas_id) REFERENCES users(id),

                       created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                       updated_at timestamp null DEFAULT null,
                       deleted_at timestamp null DEFAULT null
);

# ------------------------------ orderdetails ------------------------------ #
# ----> جزئیات سفارشات

create table orderdetails(
                             id int not null auto_increment primary key,
                             title varchar(200),
                             description text,
                             count int,
                             `status` varchar(200),
                             price decimal(15,2),
                             total_price decimal(15,2),
                             final_price decimal(15,2),
                             product_name varchar(200),
                             takhfif_total decimal(15,2),
                             takhfif_fee decimal(15,2),
                             takhfif_estefade decimal(15,2),
                             takhfif_darsad int,

                             product_id int,
                             order_id int,
                             karshenas_id int default null,

                             index orderdetail_product_index(product_id),
                             CONSTRAINT orderdetail_product_fk FOREIGN Key(product_id) REFERENCES products(id),

                             index orderdetail_order_index(order_id),
                             CONSTRAINT orderdetail_order_fk FOREIGN Key(order_id) REFERENCES orders(id),

                             index orderdetail_user_index(karshenas_id),
                             CONSTRAINT orderdetail_user_fk FOREIGN Key(karshenas_id) REFERENCES users(id),

                             created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                             updated_at timestamp null DEFAULT null,
                             deleted_at timestamp null DEFAULT null
);

# ------------------------------ purchase_detailfins ------------------------------ #
# ----> وضعیت مالی جزئی محصولات

create table purchase_detailfins(
                                    id int not null auto_increment primary key,
                                    description text,
                                    count int,
                                    price decimal(15,2),
                                    total_price decimal(15,2),
                                    final_price decimal(15,2),
                                    dargah decimal(15,2),
                                    wallet decimal(15,2),
                                    wallet_trans int,
                                    bon decimal(15,2),
                                    bon_trans int,
                                    sum_takhfif decimal(15,2),
                                    naghdi decimal(15,2),
                                    enteghal decimal(15,2),
                                    pouse decimal(15,2),

                                    bestankar decimal(15,2),
                                    bedehkar decimal(15,2),

                                    moghaierat decimal(15,2),
                                    esterdadvajh decimal(15,2),
                                    esterdad_wallet decimal(15,2),
                                    esterdad_card decimal(15,2),

                                    order_id int,

                                    index purchase_detailfins_order_index(order_id),
                                    CONSTRAINT purchase_detailfins_order_fk FOREIGN Key(order_id) REFERENCES orders(id),

                                    created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                                    updated_at timestamp null DEFAULT null,
                                    deleted_at timestamp null DEFAULT null
);

# ------------------------------ purchase_detailfins_trans ------------------------------ #
# ----> گردش مالی جزئی محصولات
# - hasan
create table purchase_detailfins_trans(
                                          id int not null auto_increment primary key,
                                          info longblob,
                                          count int,
                                          price decimal(15,2),
                                          total_price decimal(15,2),
                                          final_price decimal(15,2),
                                          wallet decimal(15,2),
                                          bon decimal(15,2),
                                          dargah decimal(15,2),
                                          pouse decimal(15,2),
                                          naghdi decimal(15,2),
                                          sum_takhfif decimal(15,2),
                                          moghaierat varchar(200),
                                          esterdad_wallet varchar(200),
                                          esterdad_card varchar(200),
                                          totalkharid decimal(15,2),

                                          detailfin_id int,
                                          transtype_id int,
                                          gateway_id int default null,

                                          index purchase_detailfins_trans_detailfin_index(detailfin_id),
                                          CONSTRAINT purchase_detailfins_trans_detailfin_fk FOREIGN Key(detailfin_id) REFERENCES purchase_detailfins(id) on update cascade on delete cascade,

                                          index purchase_detailfins_trans_transtype_index(transtype_id),
                                          CONSTRAINT purchase_detailfins_trans_transtype_fk FOREIGN Key(transtype_id) REFERENCES transtypes(id) on update cascade on delete cascade,

                                          index purchase_detailfins_trans_payment_gateway_index(gateway_id),
                                          CONSTRAINT purchase_detailfins_trans_payment_gateway_fk FOREIGN Key(gateway_id) REFERENCES payment_gateways(id) on update cascade on delete cascade,

                                          created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                          updated_at datetime null DEFAULT null,
                                          deleted_at datetime null DEFAULT null
);

# ------------------------------ exchange_detailfins ------------------------------ #
# ----> وضعیت مالی جزئی معاوضه
# - hasan
create table exchange_detailfins(
                                    id int not null auto_increment primary key,
                                    description text,
                                    side1_mavotafavot decimal(15,2),
                                    side2_mavotafavot decimal(15,2),
                                    side1_esterdadvajh decimal(15,2),
                                    side2_esterdadvajh decimal(15,2),
                                    side1_naghdi decimal(15,2),
                                    side2_naghdi decimal(15,2),
                                    side1_pouse decimal(15,2),
                                    side2_pouse decimal(15,2),
                                    side1_enteghal decimal(15,2),
                                    side2_enteghal decimal(15,2),
                                    side1_dargah decimal(15,2),
                                    side2_dargah decimal(15,2),
                                    side1_wallet decimal(15,2),
                                    side2_wallet decimal(15,2),
                                    side1_wallet_trans decimal(15,2),
                                    side2_wallet_trans decimal(15,2),
                                    side1_bon decimal(15,2),
                                    side2_bon decimal(15,2),
                                    side1_bon_trans decimal(15,2),
                                    side2_bon_trans decimal(15,2),
                                    totalkharid decimal(15,2), -- this column should be deleted
                                    side1_bestankar decimal(15,2),
                                    side2_bestankar decimal(15,2),
                                    side1_bedehkar decimal(15,2),
                                    side2_bedehkar decimal(15,2),
                                    side1_sum_takhfif decimal(15,2), -- this column should be deleted
                                    side2_sum_takhfif decimal(15,2), -- this column should be deleted
                                    exchange_id int,

                                    index exchange_detailfins_exchange_index(exchange_id),
                                    CONSTRAINT exchange_detailfins_exchange_fk FOREIGN Key(exchange_id) REFERENCES exchanges(id),

                                    created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                                    updated_at timestamp null DEFAULT null,
                                    deleted_at timestamp null DEFAULT null
);

# ------------------------------ exchange_detailfins_trans ------------------------------ #
# ----> گردش مالی جزئی معاوضه
# - hasan
create table exchange_detailfins_trans(
                                          id int not null auto_increment primary key,
                                          info longblob,
                                          side1_mavotafavot decimal(15,2),
                                          side2_mavotafavot decimal(15,2),
                                          side1_wallet decimal(15,2),
                                          side2_wallet decimal(15,2),
                                          side1_bon decimal(15,2),
                                          side2_bon decimal(15,2),
                                          side1_dargah decimal(15,2),
                                          side2_dargah decimal(15,2),
                                          side1_naghdi decimal(15,2),
                                          side2_naghdi decimal(15,2),
                                          side1_pouse decimal(15,2),
                                          side2_pouse decimal(15,2),
                                          side1_sum_takhfif decimal(15,2),
                                          side2_sum_takhfif decimal(15,2),
                                          side1_moghaierat decimal(15,2),
                                          side2_moghaierat decimal(15,2),
                                          side1_esterdad_wallet decimal(15,2),
                                          side2_esterdad_wallet decimal(15,2),
                                          side1_esterdad_card decimal(15,2),
                                          side2_esterdad_card decimal(15,2),

                                          detailfin_id int,
                                          transtype_id int,
                                          gateway_id int default null,

                                          index exchange_detailfins_trans_detailfin_index(detailfin_id),
                                          CONSTRAINT exchange_detailfins_trans_detailfin_fk FOREIGN Key(detailfin_id) REFERENCES exchange_detailfins(id) on update cascade on delete cascade,

                                          index exchange_detailfins_trans_transtype_index(transtype_id),
                                          CONSTRAINT exchange_detailfins_trans_transtype_fk FOREIGN Key(transtype_id) REFERENCES transtypes(id) on update cascade on delete cascade,

                                          index exchange_detailfins_trans_payment_gateway_index(gateway_id),
                                          CONSTRAINT exchange_detailfins_trans_payment_gateway_fk FOREIGN Key(gateway_id) REFERENCES payment_gateways(id) on update cascade on delete cascade,

                                          created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                          updated_at datetime null DEFAULT null,
                                          deleted_at datetime null DEFAULT null
);

# ------------------------------ experting_detailfins ------------------------------ #
# ----> وضعیت مالی جزئی کارشناسی

create table experting_detailfins(
                                     id int not null auto_increment primary key,
                                     description text,
                                     price decimal(15,2),
                                     esterdadvajh decimal(15,2),
                                     naghdi decimal(15,2),
                                     enteghal decimal(15,2),
                                     pouse decimal(15,2),
                                     dargah decimal(15,2),
                                     wallet decimal(15,2),
                                     wallet_trans decimal(15,2),
                                     bon decimal(15,2),
                                     bon_trans decimal(15,2),
                                     totalkharid decimal(15,2),
                                     bestankar decimal(15,2),
                                     bedehkar decimal(15,2),

                                     experting_id int,

                                     index experting_detailfin_experting_index(experting_id),
                                     CONSTRAINT experting_detailfin_experting_fk FOREIGN Key(experting_id) REFERENCES expertings(id),

                                     created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                     updated_at datetime null DEFAULT null,
                                     deleted_at datetime null DEFAULT null
);

# ------------------------------ experting_detailfins_trans ------------------------------ #
# ----> گردش مالی جزئی کارشناسی

create table experting_detailfins_trans(
                                           id int not null auto_increment primary key,
                                           info longblob,
                                           price decimal(15,2),
                                           enteghal decimal(15,2),
                                           wallet decimal(15,2),
                                           dargah decimal(15,2),
                                           pouse decimal(15,2),
                                           naghdi decimal(15,2),
                                           sum_takhfif decimal(15,2),
                                           moghaierat decimal(15,2),
                                           esterdad_wallet decimal(15,2),
                                           esterdad_card decimal(15,2),

                                           detailfin_id int,
                                           transtype_id int,
                                           gateway_id int default null,

                                           index experting_detailfins_tran_detailfin_index(detailfin_id),
                                           CONSTRAINT experting_detailfins_tran_detailfin_fk FOREIGN Key(detailfin_id) REFERENCES experting_detailfins(id) on update cascade on delete cascade,

                                           index experting_detailfins_tran_transtype_index(transtype_id),
                                           CONSTRAINT experting_detailfins_tran_detailfins_trans_transtype_fk FOREIGN Key(transtype_id) REFERENCES transtypes(id) on update cascade on delete cascade,

                                           index experting_detailfins_tran_payment_gateway_index(gateway_id),
                                           CONSTRAINT experting_detailfins_tran_payment_gateway_fk FOREIGN Key(gateway_id) REFERENCES payment_gateways(id) on update cascade on delete cascade,

                                           created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                                           updated_at datetime null DEFAULT null,
                                           deleted_at datetime null DEFAULT null
);

# ------------------------------ totalfins_trans ------------------------------ #
# ----> گردش مالی کلی کاربر
# - hasan
create table totalfins_trans(
                                id int not null auto_increment primary key,
                                info longblob,
                                description text,

                                product_count int,
                                product_price decimal(15,2),
                                product_total_price decimal(15,2),
                                product_final_price decimal(15,2),

                                periodic_service_count int, -- tedade dore haye khadamate dore yiye
                                periodic_service_price decimal(15,2),
                                periodic_service_total_price decimal(15,2),
                                periodic_service_final_price decimal(15,2),

                                exchange_mavotafavot decimal(15,2),

                                experting_price decimal(15,2), -- hazine ye karshenasi

                                wallet decimal(15,2),
                                bon decimal(15,2),
                                dargah decimal(15,2),
                                naghdi decimal(15,2),
                                enteghal decimal(15,2),
                                pouse decimal(15,2),
                                sum_takhfif decimal(15,2),
                                bestankar decimal(15,2),
                                bedehkar decimal(15,2),
                                totalkharid decimal(15,2),
                                moghaierat decimal(15,2),
                                esterdad_wallet decimal(15,2),
                                esterdad_card decimal(15,2),

                                experting_detailfins_tran_id int default null,
                                periodic_service_detailfins_tran_id int default null,
                                purchase_detailfins_tran_id int default null,
                                exchange_detailfins_tran_id int default null,

                                totalfins_id int,

                                index totalfins_tran_experting_deatilfins_index(experting_detailfins_tran_id),
                                CONSTRAINT totalfins_tran_experting_deatilfins_fk FOREIGN Key(experting_detailfins_tran_id) REFERENCES experting_detailfins_trans(id),

                                index totalfins_tran_periodic_service_deatilfins_index(periodic_service_detailfins_tran_id),
                                CONSTRAINT totalfins_tran_periodic_service_deatilfins_fk FOREIGN Key(periodic_service_detailfins_tran_id) REFERENCES periodic_service_detailfins_trans(id),

                                index totalfins_tran_purchase_detailfins_index(purchase_detailfins_tran_id),
                                CONSTRAINT totalfins_tran_purchase_detailfins_fk FOREIGN Key(purchase_detailfins_tran_id) REFERENCES purchase_detailfins_trans(id),

                                index totalfins_tran_exchange_detailfins_index(exchange_detailfins_tran_id),
                                CONSTRAINT totalfins_tran_exchange_detailfins_fk FOREIGN Key(exchange_detailfins_tran_id) REFERENCES exchange_detailfins_trans(id),

                                index totalfins_tran_totalfin_index(totalfins_id),
                                CONSTRAINT totalfins_tran_totalfin_fk FOREIGN Key(totalfins_id) REFERENCES totalfins(id),

                                created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                                updated_at timestamp null DEFAULT null,
                                deleted_at timestamp null DEFAULT null
);

# ------------------------------ user_bons ------------------------------ #
# ----> بن خرید

create table user_bons(
                          id int not null auto_increment primary key,
                          description text,
                          cost_trans decimal(15,2),
                          cost_final decimal(15,2),
                          cost decimal(15,2),
                          user_id int,

                          index user_bon_user_index(user_id),
                          CONSTRAINT user_bon_user_fk FOREIGN Key(user_id) REFERENCES users(id),

                          created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                          updated_at datetime null DEFAULT null,
                          deleted_at datetime null DEFAULT null
);

# ------------------------------ user_wallets ------------------------------ #
# ----> کیف پول

create table user_wallets(
                             id int not null auto_increment primary key,
                             description text,
                             cost_trans decimal(15,2),
                             cost_final decimal(15,2),
                             mojodi decimal(15,2),
                             user_id int,

                             index user_wallet_user_index(user_id),
                             CONSTRAINT user_wallet_user_fk FOREIGN Key(user_id) REFERENCES users(id),

                             created_at datetime null DEFAULT CURRENT_TIMESTAMP,
                             updated_at datetime null DEFAULT null,
                             deleted_at datetime null DEFAULT null
);

# ------------------------------ user_wallet_trans ------------------------------ #
# ----> گردش مالی کیف پول

create table user_wallet_trans(
                                  id int not null auto_increment primary key,

                                  info longblob,
                                  price decimal(15,2),
                                  `status` enum('variz', 'bardasht') default 'variz',
                                  firstmojodi decimal(15,2),
                                  lastmojodi decimal(15,2),
                                  moghaierat decimal(15,2),

                                  purchase_detailfins_tran_id int default null,
                                  periodic_service_detailfins_tran_id int default null,
                                  exchange_detailfins_tran_id int default null,
                                  experting_detailfins_tran_id int default null,

                                  user_wallet_id int,

                                  index wallet_trans_wallet_index(user_wallet_id),
                                  CONSTRAINT wallet_trans_wallet_fk FOREIGN Key(user_wallet_id) REFERENCES user_wallets(id),

                                  index wallet_trans_purchase_detailfins_index(purchase_detailfins_tran_id),
                                  CONSTRAINT wallet_trans_purchase_detailfins_fk FOREIGN Key(purchase_detailfins_tran_id) REFERENCES purchase_detailfins_trans(id),

                                  index wallet_trans_periodic_service_detailfins_index(periodic_service_detailfins_tran_id),
                                  CONSTRAINT wallet_trans_periodic_service_detailfins_fk FOREIGN Key(periodic_service_detailfins_tran_id) REFERENCES periodic_service_detailfins_trans(id),

                                  index wallet_trans_exchange_detailfins_index(exchange_detailfins_tran_id),
                                  CONSTRAINT wallet_trans_exchange_detailfins_fk FOREIGN Key(exchange_detailfins_tran_id) REFERENCES exchange_detailfins_trans(id),

                                  index wallet_trans_experting_index(experting_detailfins_tran_id),
                                  CONSTRAINT wallet_trans_experting_fk FOREIGN Key(experting_detailfins_tran_id) REFERENCES experting_detailfins_trans(id),

                                  created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                                  updated_at timestamp null DEFAULT null,
                                  deleted_at timestamp null DEFAULT null
);

# ------------------------------ user_bon_trans ------------------------------ #
# ----> گردش مالی بن خرید

create table user_bon_trans(
                               id int not null auto_increment primary key,
                               info longblob,
                               price decimal(15,2),
                               `status` enum('variz', 'bardasht') default 'variz',
                               firstmojodi decimal(15,2),
                               lastmojodi decimal(15,2),
                               moghaierat decimal(15,2),

                               purchase_detailfins_tran_id int default null,
                               periodic_service_detailfins_tran_id int default null,
                               exchange_detailfins_tran_id int default null,
                               experting_detailfins_tran_id int default null,

                               user_bon_id int,

                               index bon_trans_experting_index(experting_detailfins_tran_id),
                               CONSTRAINT bon_trans_experting_fk FOREIGN Key(experting_detailfins_tran_id) REFERENCES experting_detailfins_trans(id),

                               index bon_trans_bon_index(user_bon_id),
                               CONSTRAINT bon_trans_bon_fk FOREIGN Key(user_bon_id) REFERENCES user_bons(id),

                               index bon_trans_purchase_detailfins_trans_index(purchase_detailfins_tran_id),
                               CONSTRAINT bon_trans_purchase_detailfins_trans_fk FOREIGN Key(purchase_detailfins_tran_id) REFERENCES purchase_detailfins_trans(id),

                               index bon_trans_periodic_service_detailfins_trans_index(periodic_service_detailfins_tran_id),
                               CONSTRAINT bon_trans_periodic_service_detailfins_trans_fk FOREIGN Key(periodic_service_detailfins_tran_id) REFERENCES periodic_service_detailfins_trans(id),

                               index bon_trans_exchange_detailfins_trans_index(exchange_detailfins_tran_id),
                               CONSTRAINT bon_trans_exchange_detailfins_trans_fk FOREIGN Key(exchange_detailfins_tran_id) REFERENCES exchange_detailfins_trans(id),

                               created_at timestamp null DEFAULT CURRENT_TIMESTAMP,
                               updated_at timestamp null DEFAULT null,
                               deleted_at timestamp null DEFAULT null
);


# -------------------------------------------------- Organization Section -------------------------------------------------- #
# ------------------------------ holdings ------------------------------ #
# ----> هلدینگ ها

create table holdings(
                         id int not null auto_increment primary key,
                         title varchar(200),
                         description varchar(200),

                         created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                         updated_at TIMESTAMP null DEFAULT null,
                         deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ organizations ------------------------------ #
# ----> سازمان ها

create table organizations(
                              id int not null auto_increment primary key,
                              title varchar(200),
                              holding_id int,
                              register_number varchar(200),
                              economic_number varchar(200),
                              address varchar(200),
                              postal_code varchar(50),
                              tellphone varchar(50),
                              fax varchar(50),
                              establishment_date TIMESTAMP,
                              description varchar(200),

                              index org_holding_index(holding_id),
                              constraint org_holding_fk foreign key (holding_id) references holdings(id),

                              created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                              updated_at TIMESTAMP null DEFAULT null,
                              deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ org_depts ------------------------------ #
# ----> بخش های سازمان

create table org_depts(
                          id int not null auto_increment primary key,
                          title varchar(200),
                          description varchar(200),
                          register_number varchar(200),
                          economic_number varchar(200),
                          address varchar(200),
                          postal_code varchar(50),
                          tellphone varchar(50),
                          fax varchar(50),
                          establishment_date TIMESTAMP,
                          org_id int,

                          index org_dept_org_index(org_id),
                          constraint org_dept_org_fk foreign key (org_id) references organizations(id),

                          created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                          updated_at TIMESTAMP null DEFAULT null,
                          deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ org_positions ------------------------------ #
# ----> موقعیت های سازمان

create table org_positions(
                              id int not null auto_increment primary key,
                              title varchar(200),
                              description VARCHAR(200),

                              org_dept_id int,
                              org_position_id int,

                              index org_position_org_dept_index(org_dept_id),
                              index org_position_org_position_index(org_position_id),

                              constraint org_position_org_dept_fk foreign key (org_dept_id) references org_depts(id),
                              constraint org_position_org_position_fk foreign key (org_position_id) references org_positions(id),

                              created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                              updated_at TIMESTAMP null DEFAULT null,
                              deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ relations ------------------------------ #
# ----> روابط بین موقعیت های سازمان

create table relations(
                          id int not null auto_increment primary key,
                          type_relation enum('higher', 'lower','sameLevel'),
                          org_dept1_id int,
                          org_dept2_id int,

                          index relation_org_dept1_index(org_dept1_id),
                          index relation_org_dept2_index(org_dept2_id),

                          constraint relation_org_dept1_fk foreign key (org_dept1_id) references org_depts(id),
                          constraint relation_org_dept2_fk foreign key (org_dept2_id) references org_depts(id),

                          created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                          updated_at TIMESTAMP null DEFAULT null,
                          deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ position_user ------------------------------ #
# ----> جدول میانی بین users و org_positions ( جدول سمت های کاربر )

create table position_user(
                              id int not null auto_increment primary key,
                              position_id int,
                              user_id int,

                              index position_user_position_index(position_id),
                              index position_user_user_index(user_id),

                              constraint position_user_position_fk foreign key (position_id) references org_positions(id),
                              constraint position_user_user_fk foreign key (user_id) references users(id),

                              created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP
);

# ------------------------------ permission_position ------------------------------ #
# ----> جدول میانی بین permissions و org_positions

create table permission_position(
                                    id int not null auto_increment primary key,
                                    position_id int,
                                    permission_id int,

                                    index permission_position_position_index(position_id),
                                    index permission_position_permission_index(permission_id),
                                    constraint permission_position_position_fk foreign key (position_id) references org_positions(id),
                                    constraint permission_position_permission_fk foreign key (permission_id) references permissions(id),

                                    created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP
);

# ------------------------------ position_user_archives ------------------------------ #
# ----> آرشیو موقعیت ( سمت ) های  کاربر

create table position_user_archives(
                                       id int not null auto_increment primary key,
                                       position_id int,
                                       user_id int,

                                       index position_user_archive_position_index(position_id),
                                       index position_user_archive_user_index(user_id),

                                       constraint position_user_archive_position_fk foreign key (position_id) references org_positions(id),
                                       constraint position_user_archive_user_fk foreign key (user_id) references users(id),

                                       created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                                       updated_at TIMESTAMP null DEFAULT null,
                                       deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ org_position_materials ------------------------------ #
# ----> لوازم و وسایل هر موقعیت سازمان

create table org_position_materials(
                                       id int not null auto_increment primary key,
                                       title varchar(200),
                                       material_type  enum('optional', 'mandatory'),
                                       org_position_id int,
                                       description varchar(200),

                                       index org_position_material_org_position_index(org_position_id),

                                       constraint org_position_material_org_position_fk foreign key (org_position_id) references org_positions(id),

                                       created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                                       updated_at TIMESTAMP null DEFAULT null,
                                       deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ pay_slips ------------------------------ #
# ----> فیش حقوقی

create table pay_slips(
                          id int not null auto_increment primary key,
                          title varchar(200),
                          base_salary varchar(200),
                          salary varchar(200),
                          haghe_jazb varchar(200),
                          ayab_zohab  varchar(200),
                          overtime varchar(200),
                          food_cost  varchar(200),
                          manateghe_khas varchar(200),

                          haghe_olad varchar(200),
                          haghe_maskan varchar(200),
                          haghe_mamoriat varchar(200),
                          boun varchar(200),

                          jame_pardakhti varchar(200),
                          khales_pardakhti varchar(200),
                          talab varchar(200),

                          aghsat_vam varchar(200),
                          maliat varchar(200),
                          bime varchar(200),
                          bime_takmili varchar(200),
                          bime_dandanpezeshki varchar(200),
                          haghe_sandogh varchar(200),
                          mosaedeh varchar(200),

                          month_number varchar(200),

                          count_day_karkard  varchar(200),
                          kasre_kar   varchar(200),

                          user_id int,

                          index pay_slip_user_index(user_id),

                          constraint pay_slip_user_fk foreign key (user_id) references users(id),

                          created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                          updated_at TIMESTAMP null DEFAULT null,
                          deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ mavarede_hoghooghe_sals ------------------------------ #
# ----> موارد حقوق سال

create table mavarede_hoghooghe_sals(
                                        id int not null auto_increment primary key,
                                        title varchar(200),
                                        pardakhti varchar(200),

                                        org_id int,

                                        index mavarede_hoghooghe_sal_org_index(org_id),

                                        constraint mavarede_hoghooghe_sal_org_fk foreign key (org_id) references organizations(id),

                                        created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                                        updated_at TIMESTAMP null DEFAULT null,
                                        deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ position_pay_salary ------------------------------ #
# ---->

create table position_pay_salary(
                                    id int not null auto_increment primary key,
                                    position_id int,
                                    pay_id int,
                                    salary_id int,

                                    index position_pay_salary_position_index(position_id),
                                    index position_pay_salary_pay_index(pay_id),
                                    index position_pay_salary_salary_index(salary_id),

                                    constraint position_pay_salary_position_fk foreign key (position_id) references org_positions(id),
                                    constraint position_pay_salary_pay_fk foreign key (pay_id) references pay_slips(id),
                                    constraint position_pay_salary_salary_fk foreign key (salary_id) references mavarede_hoghooghe_sals(id),

                                    created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                                    updated_at TIMESTAMP null DEFAULT null,
                                    deleted_at TIMESTAMP null DEFAULT null
);

# ------------------------------ fiscal_years ------------------------------ #
# ----> سال مالی

create table fiscal_years(
                             id int not null auto_increment primary key,
                             title varchar(200),
                             start_date datetime,
                             end_date datetime,
                             darayi varchar(200),
                             bedehi varchar(200),
                             sarmaye varchar(200),
                             sood varchar(200),
                             zian varchar(200),
                             gardeshe_vojoohe_naghd text,

                             pardakhti varchar(200),

                             mavared_hoghooghe_sals_id int,

                             index fiscal_year_org_index(mavared_hoghooghe_sals_id),

                             constraint mavarede_hoghooghe_fiscal_fk foreign key (mavared_hoghooghe_sals_id) references mavarede_hoghooghe_sals(id),

                             created_at TIMESTAMP null DEFAULT CURRENT_TIMESTAMP,
                             updated_at TIMESTAMP null DEFAULT null,
                             deleted_at TIMESTAMP null DEFAULT null
);
