create table cities (
  id int not null primary key auto_increment,
  city varchar(75) not null comment 'Име на града'
) comment 'Списък с градовете';

create table users (
  id int not null primary key auto_increment,
  real_name varchar(100) not null,
  phone varchar(100) not null,
  email varchar(100) not null,
  city_id int not null,
  constraint fk_users_city foreign key (city_id) references cities(id)
);

create table shotgun_marks (
  id int not null primary key auto_increment,
  mark varchar(100) not null comment 'Марка'
) comment 'Ловни пушки и карабини->Гладкоцевни марки';

create table shotgun_types (
  id int not null primary key auto_increment,
  type varchar(100) not null comment 'Тип'
) comment 'Ловни пушки и карабини->Гладкоцевни типове';
insert into shotgun_types (name) values ('Кремаклийка');
insert into shotgun_types (name) values ('Едноцевка');
insert into shotgun_types (name) values ('Успоредка');
insert into shotgun_types (name) values ('Надцевка');
insert into shotgun_types (name) values ('Полуавтомат');
insert into shotgun_types (name) values ('Автомат');

create table shotgun (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  is_old bool not null comment 'Стара/Нова',
  mark_id int not null comment 'Марка',
  caliber varchar(20) not null comment 'Калибър',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  description text comment 'Описание',
  is_active_user bool not null default 1 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  constraint fk_shotgun_user foreign key (user_id) references users(id),
  constraint fk_shotgun_makr foreign key (makr_id) references shotgun_marks(id),
  constraint fk_shotgun_city foreign key (city_id) references cities(id)
) comment 'Ловни пушки и карабини->Гладкоцевни';

create table shotgun_type (
  id int not null primary key auto_increment,
  shotgun_id int not null comment 'Гладкоцевна',
  type_id int not null comment 'Тип',
  constraint fk_shotgun_type_shotgun foreign key (shotgun_id) references shotgun(id),
  constraint fk_shotgun_type_type foreign key (type_id) references shotgun_types(id)
) comment 'Типове към гладкоцевни обяви';

create table rifle_marks (
  id int not null primary key auto_increment,
  mark varchar(100) not null comment 'Марка'
) comment 'Ловни пушки и карабини->Нарезни марки';

create table rifle (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  is_old bool not null comment 'Стара/Нова',
  mark_id int not null comment 'Марка',
  caliber varchar(20) not null comment 'Калибър',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  description text comment 'Описание',
  is_active_user bool not null default 1 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  constraint fk_rifle_user foreign key (user_id) references users(id),
  constraint fk_rifle_makr foreign key (makr_id) references rifle_marks(id),
  constraint fk_rifle_city foreign key (city_id) references cities(id)
) comment 'Ловни пушки и карабини->Нарезни';

create table nozzle_marks (
  id int not null primary key auto_increment,
  mark varchar(100) not null comment 'Марка'
) comment 'Ловни пушки и карабини->Щуцер марки';

create table nozzle (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  is_old bool not null comment 'Стара/Нова',
  mark_id int not null comment 'Марка',
  caliber_smoothbore varchar(20) not null comment 'Калибър гладкоцевни',
  caliber_barrel varchar(20) not null comment 'Калибър нарезни',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  description text comment 'Описание',
  is_active_user bool not null default 1 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  constraint fk_nozzle_user foreign key (user_id) references users(id),
  constraint fk_nozzle_makr foreign key (makr_id) references nozzle_marks(id),
  constraint fk_nozzle_city foreign key (city_id) references cities(id)
) comment 'Ловни пушки и карабини->Щуцер';

create table air_gun_marks (
  id int not null primary key auto_increment,
  mark varchar(100) not null comment 'Марка'
) comment 'Ловни пушки и карабини->Пневматични марки';

create table air_guns (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  is_old bool not null comment 'Стара/Нова',
  mark_id int not null comment 'Марка',
  caliber varchar(20) not null comment 'Калибър',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  description text comment 'Описание',
  is_active_user bool not null default 1 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  constraint fk_air_guns_user foreign key (user_id) references users(id),
  constraint fk_air_guns_makr foreign key (makr_id) references air_gun_marks(id),
  constraint fk_air_guns_city foreign key (city_id) references cities(id)
) comment 'Ловни пушки и карабини->Пневматични';


-------------------------------------------------------------------------------------
create table pistol_types (
  id int not null primary key auto_increment,
  type varchar(100) not null comment 'Тип пистолет'
) comment 'Видове пистолети';
insert into pistol_types (id, type) values (1, 'Револвери');
insert into pistol_types (id, type) values (2, 'Полуавтоматични');
insert into pistol_types (id, type) values (3, 'Автоматични');
insert into pistol_types (id, type) values (4, 'Пневматични');
insert into pistol_types (id, type) values (5, 'Газови');

create table pistol_marks (
  id int not null primary key auto_increment,
  type_id int not null comment 'Тип пистолет',
  mark varchar(100) not null comment 'Марка пистолет',
  constraint fk_pistolet_marks_type foreign key (type_id) references pistol_types(id)
) comment 'Марки пистолети';

create table pistols (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  is_old bool not null comment 'Стара/Нова',
  type_id int not null comment 'Тип пистолет',
  mark_id int not null comment 'Марка',
  caliber varchar(20) not null comment 'Калибър',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  description text comment 'Описание',
  is_active_user bool not null default 1 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  constraint fk_pistols_user foreign key (user_id) references users(id),
  constraint fk_pistols_makr foreign key (mark_id) references pistol_marks(id),
  constraint fk_pistols_type foreign key (type_id) references pistol_types(id),
  constraint fk_pistols_city foreign key (city_id) references cities(id)
);

------------------------------------------------------------------------------------------------
create table ammunition_types (
  id int not null primary key auto_increment,
  type varchar(100) not null comment 'Тип патрони'
) comment 'Типове патрони';
insert into ammunition_types values (1, 'За гладкоцевни');
insert into ammunition_types values (2, 'За нарезни');

create table ammunition_marks (
  id int not null primary key auto_increment,
  type_id int not null comment 'Тип патрони',
  mark varchar(100) not null comment 'Марка патрони',
  constraint fk_pistolet_marks_type foreign key (type_id) references pistol_types(id)
) comment 'Марки патрони';


create table ammunition_kinds (
  id int not null primary key auto_increment,
  type_id int not null comment 'Тип патрони',
  kind varchar(100) not null comment 'Марка патрони',
  constraint fk_pistolet_kinds_type foreign key (type_id) references pistol_types(id)
) comment 'Марки патрони';
insert into ammunition_kinds (type_id, kind) values (1, 'Магнум');
insert into ammunition_kinds (type_id, kind) values (1, 'Мини-магнум');
insert into ammunition_kinds (type_id, kind) values (1, 'Обикновени');
insert into ammunition_kinds (type_id, kind) values (2, 'Магнум');
insert into ammunition_kinds (type_id, kind) values (2, 'Обикновени');

create table ammunitions (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  kind_id int not null comment 'Вид',
  mark_id int not null comment 'Марка',
  caliber varchar(20) not null comment 'Калибър',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  description text comment 'Описание',
  is_active_user bool not null default 1 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  constraint fk_ammunitions_user foreign key (user_id) references users(id),
  constraint fk_ammunitions_kind foreign key (makr_id) references ammunitions_kinds(id),
  constraint fk_ammunitions_makr foreign key (makr_id) references ammunitions_marks(id),
  constraint fk_ammunitions_city foreign key (city_id) references cities(id)
) comment 'Патрони';

------------------------------------------------------------------------------------------------
/*
create table optic_types (
  id int not null primary key auto_increment,
  type varchar(100) not null comment 'Тип оптика'
) comment 'Типове оптики';
insert into ammunition_types values (1, 'За гладкоцевни');
insert into ammunition_types values (2, 'За нарезни');
*/

create table optic_marks (
  id int not null primary key auto_increment,
  --type_id int not null comment 'Тип оптика',
  mark varchar(100) not null comment 'Марка оптика',
  constraint fk_pistolet_marks_type foreign key (type_id) references pistol_types(id)
) comment 'Марки оптики';


create table optic_kinds (
  id int not null primary key auto_increment,
  --type_id int not null comment 'Тип патрони',
  kind varchar(100) not null comment 'Марка оптика',
  constraint fk_pistolet_kinds_type foreign key (type_id) references pistol_types(id)
) comment 'Марки оптики';
insert into ammunition_kinds (kind) values ('Магнум');
insert into ammunition_kinds (kind) values ('Мини-магнум');
insert into ammunition_kinds (kind) values ('Обикновени');
insert into ammunition_kinds (kind) values ('Магнум');
insert into ammunition_kinds (kind) values ('Обикновени');

create table optics (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  is_old bool not null comment 'Стара/Нова',
  kind_id int not null comment 'Вид',
  mark_id int not null comment 'Марка',
  size varchar(10) not null comment 'Размер',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  description text comment 'Описание',
  is_active_user bool not null default 1 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  constraint fk_optics_user foreign key (user_id) references users(id),
  constraint fk_optics_kind foreign key (makr_id) references optics_kinds(id),
  constraint fk_optics_makr foreign key (makr_id) references optics_marks(id),
  constraint fk_optics_city foreign key (city_id) references cities(id)
) comment 'Патрони';

