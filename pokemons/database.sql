drop database pokedex;
-- creamos la base de datos
create database if not exists pokedex;
-- ponemos en uso a la base de datos
use pokedex;


-- creamos la tabla
create table pokemon(
id int not null auto_increment,
numero int not null,
tipo varchar(45) not null,
nombre varchar(45),
imagen varchar(45),
primary key(id)

);

-- insertamos algunos pokemones en la tabla
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(1,'Veneno','Bulbasaur','Bulbasaur.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(2,'Veneno','Ivysaur','Ivysaur.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(3,'Fuego','Venusaur','Venusaur.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(4,'Fuego','Charmander','Charmander.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(5,'Fuego','Charmeleon','Charmeleon.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(6,'Agua','Charizard','Charizard.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(7,'Agua','Squirtle','Squirtle.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(8,'Agua','Wartortle','Wartortle.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(9,'Tierra','Blastoise','Blastoise.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(10,'Tierra','Caterpie','Caterpie.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(11,'Tierra','Metapod','Metapod.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(12,'Veneno','Butterfree','Butterfree.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(13,'Veneno','Weedle','Weedle.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(14,'Veneno','Kakuna','Kakuna.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(15,'Veneno','Beedrill','Beedrill.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(16,'Tierra','Pnumerogey','Pidgey.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(17,'Tierra','Pnumerogeotto','Pidgeotto.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(18,'Tierra','Pnumerogeot','Pidgeot.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(19,'Tierra','Rattata','Rattata.PNG');
INSERT INTO pokemon(numero,tipo,nombre,imagen) values(20,'Tierra','Raticate','Raticate.PNG');

-- creamos la tabla usuario
create table usuario(
	numero int not null auto_increment,
    nombre varchar(45) not null,
    pass varchar(100) not null,
    constraint primary key(numero)
    
);

-- insertamos algunos usuarios a la tabla usuario
-- Solamente estos usuarios pueden acceder al home
insert into usuario(nombre,pass)values('Joel','abcd4321');
insert into usuario(nombre,pass)values('Laura','efgh5678');
insert into usuario(nombre,pass)values('Evelina','ijkl91011');
insert into usuario(nombre,pass)values('Ezequiel','mnopq121314');

