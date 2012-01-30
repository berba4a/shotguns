create table currency (
  id int not null primary key auto_increment,
  currency varchar(20) not null
);
insert into currency (id, currency) values (1, 'Лева');
insert into currency (id, currency) values (2, 'EUR');

create table cities (
  id int not null primary key auto_increment,
  city varchar(75) not null comment 'Име на града'
) comment 'Списък с градовете';
insert into cities (city) values ('Айтос');
insert into cities (city) values ('Аксаково');
insert into cities (city) values ('Алфатар');
insert into cities (city) values ('Антоново');
insert into cities (city) values ('Априлци');
insert into cities (city) values ('Ардино');
insert into cities (city) values ('Асеновград');
insert into cities (city) values ('Ахелой');
insert into cities (city) values ('Ахтопол');
insert into cities (city) values ('Балчик');
insert into cities (city) values ('Банкя');
insert into cities (city) values ('Банско');
insert into cities (city) values ('Баня');
insert into cities (city) values ('Батак');
insert into cities (city) values ('Батановци');
insert into cities (city) values ('Белене');
insert into cities (city) values ('Белица');
insert into cities (city) values ('Белово');
insert into cities (city) values ('Белоградчик');
insert into cities (city) values ('Белослав');
insert into cities (city) values ('Берковица');
insert into cities (city) values ('Благоевград');
insert into cities (city) values ('Бобов дол');
insert into cities (city) values ('Бобошево');
insert into cities (city) values ('Божурище');
insert into cities (city) values ('Бойчиновци');
insert into cities (city) values ('Болярово');
insert into cities (city) values ('Борово');
insert into cities (city) values ('Ботевград');
insert into cities (city) values ('Брацигово');
insert into cities (city) values ('Брегово');
insert into cities (city) values ('Брезник');
insert into cities (city) values ('Брезово');
insert into cities (city) values ('Брусарци');
insert into cities (city) values ('Бургас');
insert into cities (city) values ('Бухово');
insert into cities (city) values ('Българово');
insert into cities (city) values ('Бяла (Област Варна)');
insert into cities (city) values ('Бяла (Област Русе)');
insert into cities (city) values ('Бяла Слатина');
insert into cities (city) values ('Бяла черква');
insert into cities (city) values ('Варна');
insert into cities (city) values ('Велики Преслав');
insert into cities (city) values ('Велико Търново');
insert into cities (city) values ('Велинград');
insert into cities (city) values ('Ветово');
insert into cities (city) values ('Ветрен');
insert into cities (city) values ('Видин');
insert into cities (city) values ('Враца');
insert into cities (city) values ('Вълчедръм');
insert into cities (city) values ('Вълчи дол');
insert into cities (city) values ('Върбица');
insert into cities (city) values ('Вършец');
insert into cities (city) values ('Габрово');
insert into cities (city) values ('Генерал Тошево');
insert into cities (city) values ('Главиница');
insert into cities (city) values ('Глоджево');
insert into cities (city) values ('Годеч');
insert into cities (city) values ('Горна Оряховица');
insert into cities (city) values ('Гоце Делчев');
insert into cities (city) values ('Грамада');
insert into cities (city) values ('Гулянци');
insert into cities (city) values ('Гурково');
insert into cities (city) values ('Гълъбово');
insert into cities (city) values ('Две могили');
insert into cities (city) values ('Дебелец');
insert into cities (city) values ('Девин');
insert into cities (city) values ('Девня');
insert into cities (city) values ('Джебел');
insert into cities (city) values ('Димитровград');
insert into cities (city) values ('Димово');
insert into cities (city) values ('Добринище');
insert into cities (city) values ('Добрич');
insert into cities (city) values ('Долни чифлик');
insert into cities (city) values ('Долна баня');
insert into cities (city) values ('Долна Митрополия');
insert into cities (city) values ('Долна Оряховица');
insert into cities (city) values ('Долни Дъбник');
insert into cities (city) values ('Доспат');
insert into cities (city) values ('Драгоман');
insert into cities (city) values ('Дряново');
insert into cities (city) values ('Дулово');
insert into cities (city) values ('Дунавци');
insert into cities (city) values ('Дупница');
insert into cities (city) values ('Дългопол');
insert into cities (city) values ('Елена');
insert into cities (city) values ('Елин Пелин');
insert into cities (city) values ('Елхово');
insert into cities (city) values ('Етрополе');
insert into cities (city) values ('Завет');
insert into cities (city) values ('Земен');
insert into cities (city) values ('Златарица');
insert into cities (city) values ('Златица');
insert into cities (city) values ('Златоград');
insert into cities (city) values ('Ивайловград');
insert into cities (city) values ('Игнатиево');
insert into cities (city) values ('Искър');
insert into cities (city) values ('Исперих');
insert into cities (city) values ('Ихтиман');
insert into cities (city) values ('Каблешково');
insert into cities (city) values ('Каварна');
insert into cities (city) values ('Казанлък');
insert into cities (city) values ('Калофер');
insert into cities (city) values ('Камено');
insert into cities (city) values ('Каолиново');
insert into cities (city) values ('Карлово');
insert into cities (city) values ('Карнобат');
insert into cities (city) values ('Каспичан');
insert into cities (city) values ('Кермен');
insert into cities (city) values ('Килифарево');
insert into cities (city) values ('Китен');
insert into cities (city) values ('Клисура');
insert into cities (city) values ('Кнежа');
insert into cities (city) values ('Козлодуй');
insert into cities (city) values ('Койнаре');
insert into cities (city) values ('Копривщица');
insert into cities (city) values ('Костандово');
insert into cities (city) values ('Костенец');
insert into cities (city) values ('Костинброд');
insert into cities (city) values ('Котел');
insert into cities (city) values ('Кочериново');
insert into cities (city) values ('Кресна');
insert into cities (city) values ('Криводол');
insert into cities (city) values ('Кричим');
insert into cities (city) values ('Крумовград');
insert into cities (city) values ('Кубрат');
insert into cities (city) values ('Куклен');
insert into cities (city) values ('Кула');
insert into cities (city) values ('Кърджали');
insert into cities (city) values ('Кюстендил');
insert into cities (city) values ('Левски');
insert into cities (city) values ('Летница');
insert into cities (city) values ('Ловеч');
insert into cities (city) values ('Лозница');
insert into cities (city) values ('Лом');
insert into cities (city) values ('Луковит');
insert into cities (city) values ('Лъки');
insert into cities (city) values ('Любимец');
insert into cities (city) values ('Лясковец');
insert into cities (city) values ('Мадан');
insert into cities (city) values ('Маджарово');
insert into cities (city) values ('Малко Търново');
insert into cities (city) values ('Мартен');
insert into cities (city) values ('Мездра');
insert into cities (city) values ('Мелник');
insert into cities (city) values ('Меричлери');
insert into cities (city) values ('Мизия');
insert into cities (city) values ('Момин проход');
insert into cities (city) values ('Момчилград');
insert into cities (city) values ('Монтана');
insert into cities (city) values ('Мъглиж');
insert into cities (city) values ('Неделино');
insert into cities (city) values ('Несебър');
insert into cities (city) values ('Николаево');
insert into cities (city) values ('Никопол');
insert into cities (city) values ('Нова Загора');
insert into cities (city) values ('Нови Искър');
insert into cities (city) values ('Нови пазар');
insert into cities (city) values ('Обзор');
insert into cities (city) values ('Омуртаг');
insert into cities (city) values ('Опака');
insert into cities (city) values ('Оряхово');
insert into cities (city) values ('Павел баня');
insert into cities (city) values ('Павликени');
insert into cities (city) values ('Пазарджик');
insert into cities (city) values ('Панагюрище');
insert into cities (city) values ('Перник');
insert into cities (city) values ('Перущица');
insert into cities (city) values ('Петрич');
insert into cities (city) values ('Пещера');
insert into cities (city) values ('Пирдоп');
insert into cities (city) values ('Плачковци');
insert into cities (city) values ('Плевен');
insert into cities (city) values ('Плиска');
insert into cities (city) values ('Пловдив');
insert into cities (city) values ('Полски Тръмбеш');
insert into cities (city) values ('Поморие');
insert into cities (city) values ('Попово');
insert into cities (city) values ('Пордим');
insert into cities (city) values ('Правец');
insert into cities (city) values ('Приморско');
insert into cities (city) values ('Провадия');
insert into cities (city) values ('Първомай');
insert into cities (city) values ('Раднево');
insert into cities (city) values ('Радомир');
insert into cities (city) values ('Разград');
insert into cities (city) values ('Разлог');
insert into cities (city) values ('Ракитово');
insert into cities (city) values ('Раковски');
insert into cities (city) values ('Рила');
insert into cities (city) values ('Роман');
insert into cities (city) values ('Рудозем');
insert into cities (city) values ('Русе');
insert into cities (city) values ('Садово');
insert into cities (city) values ('Самоков');
insert into cities (city) values ('Сандански');
insert into cities (city) values ('Сапарева баня');
insert into cities (city) values ('Свети Влас');
insert into cities (city) values ('Свиленград');
insert into cities (city) values ('Свищов');
insert into cities (city) values ('Своге');
insert into cities (city) values ('Севлиево');
insert into cities (city) values ('Сеново');
insert into cities (city) values ('Септември');
insert into cities (city) values ('Силистра');
insert into cities (city) values ('Симеоновград');
insert into cities (city) values ('Симитли');
insert into cities (city) values ('Славяново');
insert into cities (city) values ('Сливен');
insert into cities (city) values ('Сливница');
insert into cities (city) values ('Сливо поле');
insert into cities (city) values ('Смолян');
insert into cities (city) values ('Смядово');
insert into cities (city) values ('Созопол');
insert into cities (city) values ('Сопот');
insert into cities (city) values ('София');
insert into cities (city) values ('Средец');
insert into cities (city) values ('Стамболийски');
insert into cities (city) values ('Стара Загора');
insert into cities (city) values ('Стражица');
insert into cities (city) values ('Стралджа');
insert into cities (city) values ('Стрелча');
insert into cities (city) values ('Суворово');
insert into cities (city) values ('Сунгурларе');
insert into cities (city) values ('Сухиндол');
insert into cities (city) values ('Съединение');
insert into cities (city) values ('Сърница');
insert into cities (city) values ('Твърдица');
insert into cities (city) values ('Тервел');
insert into cities (city) values ('Тетевен');
insert into cities (city) values ('Тополовград');
insert into cities (city) values ('Троян');
insert into cities (city) values ('Трън');
insert into cities (city) values ('Тръстеник');
insert into cities (city) values ('Трявна');
insert into cities (city) values ('Тутракан');
insert into cities (city) values ('Търговище');
insert into cities (city) values ('Угърчин');
insert into cities (city) values ('Хаджидимово');
insert into cities (city) values ('Харманли');
insert into cities (city) values ('Хасково');
insert into cities (city) values ('Хисаря');
insert into cities (city) values ('Царево');
insert into cities (city) values ('Цар Калоян');
insert into cities (city) values ('Чепеларе');
insert into cities (city) values ('Червен бряг');
insert into cities (city) values ('Черноморец');
insert into cities (city) values ('Чипровци');
insert into cities (city) values ('Чирпан');
insert into cities (city) values ('Шабла');
insert into cities (city) values ('Шивачево');
insert into cities (city) values ('Шипка');
insert into cities (city) values ('Шумен');
insert into cities (city) values ('Ябланица');
insert into cities (city) values ('Якоруда');
insert into cities (city) values ('Ямбол');

create table users (
  id int not null primary key auto_increment,
  username varchar(50) not null,
  password varchar(50) not null,
  real_name varchar(100),
  phone varchar(100),
  email varchar(100) not null,
  is_real_email bool not null default 0,
  is_active bool not null default 1,
  is_dealer bool not null,
  city_id int,
  website varchar(100),
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
--insert into pistol_marks (type_id, mark) values (1, 'Марка 1-1');
--insert into pistol_marks (type_id, mark) values (1, 'Марка 1-2');
--insert into pistol_marks (type_id, mark) values (1, 'Марка 1-3');
--insert into pistol_marks (type_id, mark) values (2, 'Марка 2-1');
--insert into pistol_marks (type_id, mark) values (3, 'Марка 3-1');

create table pistol_models (
  id int not null primary key auto_increment,
  mark_id int not null comment 'Марка пистолет',
  model varchar(100) not null comment 'Модел пистолет',
  constraint fk_pistolet_modles_mark foreign key (mark_id) references pistol_marks(id)
) comment 'Модели пистолети';
--insert into pistol_models (mark_id, model) values (1, 'Модел 1-1');
--insert into pistol_models (mark_id, model) values (1, 'Модел 1-2');
--insert into pistol_models (mark_id, model) values (1, 'Модел 1-3');
--insert into pistol_models (mark_id, model) values (2, 'Модел 2-1');
--insert into pistol_models (mark_id, model) values (3, 'Модел 3-1');

create table pistol_calibers (
  id int not null primary key auto_increment,
  model_id varchar(100) not null comment 'Модел пистолет',
  caliber varchar(100) not null comment 'Калибър на пистолета',
  constraint fk_pistol_calibers_model foreign key (model_id) references pistol_models(id)
) comment 'Калибри на пистолети';
--insert into pistol_calibers (model_id, caliber) values (1, 'Калибър 1-1');
--insert into pistol_calibers (model_id, caliber) values (1, 'Калибър 1-2');
--insert into pistol_calibers (model_id, caliber) values (2, 'Калибър 2-1');
--insert into pistol_calibers (model_id, caliber) values (2, 'Калибър 2-2');
--insert into pistol_calibers (model_id, caliber) values (2, 'Калибър 2-3');
--insert into pistol_calibers (model_id, caliber) values (3, 'Калибър 3-1');
--insert into pistol_calibers (model_id, caliber) values (4, 'Калибър 4-1');
--insert into pistol_calibers (model_id, caliber) values (4, 'Калибър 4-2');
--insert into pistol_calibers (model_id, caliber) values (5, 'Калибър 5-1');

create table pistols (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  is_old bool not null comment 'Стара/Нова',
  type_id int not null comment 'Тип пистолет',
  mark_id int not null comment 'Марка',
  model_id int not null comment 'Модел',
  caliber_id varchar(20) not null comment 'Калибър',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  real_price real not null comment 'Цената в левове',
  currency_id int not null comment 'Валута',
  description text comment 'Описание',
  is_active_user bool not null default 0 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  created timestamp default CURRENT_TIMESTAMP(),
  constraint fk_pistols_user foreign key (user_id) references users(id),
  constraint fk_pistols_makr foreign key (mark_id) references pistol_marks(id),
  constraint fk_pistols_model foreign key (model_id) references pistol_models(id),
  constraint fk_pistols_type foreign key (type_id) references pistol_types(id),
  constraint fk_pistols_city foreign key (city_id) references cities(id),
  constraint fk_pistols_currency foreign key (currency_id) references currency(id)
);

create table pistol_images (
  id int not null primary key auto_increment,
  pistol_id int not null,
  image varchar(100),
  constraint fk_pistol_images_pistol foreign key (pistol_id) references pistols(id)
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

create table optic_types (
  id int not null primary key auto_increment,
  type varchar(100) not null comment 'Тип оптика'
) comment 'Типове оптики';
insert into optic_types values (1, 'Оптичен мерник');
insert into optic_types values (2, 'Бинокъл');
insert into optic_types values (3, 'Уред за нощно виждане');
insert into optic_types values (4, 'Лазерен прицел');
insert into optic_types values (5, 'Уред за термално виждане');


create table optic_marks (
  id int not null primary key auto_increment,
  type_id int not null comment 'Тип оптика',
  mark varchar(100) not null comment 'Марка оптика',
  constraint fk_optic_mark_types foreign key (type_id) references optic_types(id)
) comment 'Марки оптики';
insert into optic_marks values (1, 1, 'Марка 1');
insert into optic_marks values (2, 2, 'Марка 2');
insert into optic_marks values (3, 3, 'Марка 3');
insert into optic_marks values (4, 4, 'Марка 4');
insert into optic_marks values (5, 5, 'Марка 5');
insert into optic_marks values (6, 1, 'Марка 6');
insert into optic_marks values (7, 2, 'Марка 7');
insert into optic_marks values (8, 3, 'Марка 8');
insert into optic_marks values (9, 4, 'Марка 9');
insert into optic_marks values (10, 5, 'Марка 10');


create table optic_models (
  id int not null primary key auto_increment,
  mark_id int not null comment 'Марка оптика',
  model varchar(100) not null comment 'Модел оптика',
  constraint fk_optic_model_types foreign key (mark_id) references optic_marks(id)
) comment 'Модели оптики';
insert into optic_models values (1, 1, 'Модел 1');
insert into optic_models values (2, 2, 'Модел 2');
insert into optic_models values (3, 3, 'Модел 3');
insert into optic_models values (4, 4, 'Модел 4');
insert into optic_models values (5, 5, 'Модел 5');
insert into optic_models values (6, 6, 'Модел 6');
insert into optic_models values (7, 7, 'Модел 7');
insert into optic_models values (8, 8, 'Модел 8');
insert into optic_models values (9, 9, 'Модел 9');
insert into optic_models values (10, 10, 'Модел 10');
insert into optic_models values (11, 1, 'Модел 11');
insert into optic_models values (12, 2, 'Модел 12');
insert into optic_models values (13, 3, 'Модел 13');
insert into optic_models values (14, 4, 'Модел 14');
insert into optic_models values (15, 5, 'Модел 15');

create table optic_sizes (
  id int not null primary key auto_increment,
  model_id int not null comment 'Модел оптика',
  size varchar(100) not null comment 'Размер оптика',
  constraint fk_optic_size_modles foreign key (model_id) references optic_models(id)
);
insert into optic_sizes values (1, 1, 'Размер 1');
insert into optic_sizes values (2, 2, 'Размер 2');
insert into optic_sizes values (3, 3, 'Размер 3');
insert into optic_sizes values (4, 4, 'Размер 4');
insert into optic_sizes values (5, 5, 'Размер 5');
insert into optic_sizes values (6, 6, 'Размер 6');
insert into optic_sizes values (7, 7, 'Размер 7');
insert into optic_sizes values (8, 8, 'Размер 8');
insert into optic_sizes values (9, 9, 'Размер 9');
insert into optic_sizes values (10, 10, 'Размер 10');
insert into optic_sizes values (11, 11, 'Размер 11');
insert into optic_sizes values (12, 12, 'Размер 12');
insert into optic_sizes values (13, 13, 'Размер 13');
insert into optic_sizes values (14, 14, 'Размер 14');
insert into optic_sizes values (15, 15, 'Размер 15');
insert into optic_sizes values (16, 6, 'Размер 16');
insert into optic_sizes values (17, 7, 'Размер 17');
insert into optic_sizes values (18, 8, 'Размер 18');
insert into optic_sizes values (19, 9, 'Размер 19');
insert into optic_sizes values (20, 2, 'Размер 20');
insert into optic_sizes values (21, 1, 'Размер 21');

create table optics (
  id int not null primary key auto_increment,
  user_id int not null comment 'Собственик',
  is_old bool not null comment 'Стара/Нова',
  type_id int not null comment 'Тип',
  mark_id int not null comment 'Марка',
  model_id int not null comment 'Модел',
  size_id int not null comment 'Размер',
  city_id int not null comment 'Град/Местоположение',
  price real not null comment 'Цена',
  real_price real not null comment 'Цената в левове',
  currency_id int not null comment 'Валута',
  description text comment 'Описание',
  is_active_user bool not null default 1 comment 'Активна от потребителя',
  is_active_admin bool not null default 1 comment 'Активна от администратор',
  created timestamp default CURRENT_TIMESTAMP(),
  constraint fk_optics_user foreign key (user_id) references users(id),
  constraint fk_optics_type foreign key (type_id) references optic_types(id),
  constraint fk_optics_model foreign key (model_id) references optics_models(id),
  constraint fk_optics_makr foreign key (mark_id) references optics_marks(id),
  constraint fk_optics_size foreign key (size_id) references optics_sizes(id),
  constraint fk_optics_currency foreign key (currency_id) references currency(id),
  constraint fk_optics_city foreign key (city_id) references cities(id)
) comment 'Оптики';



create table optic_images (
  id int not null primary key auto_increment,
  optic_id int not null,
  image varchar(100),
  constraint fk_optic_images_pistol foreign key (optic_id) references optics(id)
);