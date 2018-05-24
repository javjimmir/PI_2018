DROP DATABASE IF EXISTS actividades;
CREATE DATABASE actividades;
use actividades

CREATE TABLE usuario(
	nif varchar(30) NOT NULL,
	nombre varchar(25),
	apellidos varchar(30),
	telefono varchar(9),
	pais varchar(25),
	alias varchar(25),
	email varchar(50),
	cp varchar(5),
	provincia varchar(30),
	direccion varchar(30),
	actividad_fav varchar(20),
	password varchar(50),
	PRIMARY KEY (nif)
);

CREATE TABLE empresa(
	cif varchar(30) NOT NULL,
	nombre varchar(30),
	telefono varchar(9),
	pais varchar(30),
	provincia varchar(30),
	alias varchar(30),
	tipo_actividad varchar(30),
	web varchar(35),
	email varchar(35),
	descripcion varchar(150),
	cp varchar(5),
	password varchar(20),
	PRIMARY KEY (cif)
);

CREATE TABLE oferta(
	id int NOT NULL AUTO_INCREMENT,
	cif_empresa varchar(9),
	nombre varchar(25),
	provincia varchar(30),
	municipio varchar(30),
	duracion varchar(30),
	num_plazas int,
	tipo_actividad varchar(30),
	descripcion varchar(150),
	localizacion varchar(30),
	precio double(5,2),
	dificultad varchar(15),
  imagen_perfil varchar(100),
  categoria varchar(20),
	fecha_inicio date,
	fecha_fin date,
	PRIMARY KEY (id),
	FOREIGN KEY (cif_empresa) REFERENCES empresa(cif)
);

CREATE TABLE reserva(
	id int NOT NULL AUTO_INCREMENT,
	nif_usuario varchar(9),
	id_oferta int,
	fecha_reserva date,
	num_plazas_reserva int,
	coste_reserva double(5,2),
	valoración int(5),
	reseña varchar(500),
	PRIMARY KEY (id),
	FOREIGN KEY (nif_usuario) REFERENCES usuario(nif),
	FOREIGN KEY (id_oferta) REFERENCES oferta(id)
);

-- INSERT EN USUARIO
insert into usuario values('47342916S','Cristian','De los Santos Pariente','999999999','España','Baby','cristian@gmail.com','41410','Sevilla','C/Despeñaperros','Snorkel','cristian1234');
insert into usuario values('47342917S','Fran','Alcon','999999999','España','FranPLayer','Fran@gmail.com','41410','Sevilla','C/Bami','Correr','Fran1234');
insert into usuario values('47342918S','Fredy','Jerby','999999999','España','Jefry','Fredy@gmail.com','41410','Sevilla','C/DosHermanas','Salto','Fredy1234');
insert into usuario values('47342919S','Javi','Jimenez','999999999','España','Moro','javi@gmail.com','41410','Sevilla','C/Sevilla','Gimna','javi1234');
insert into usuario values('47342916J','Juan','Delgado','999999999','España','juandels3','juan@gmail.com','41410','Sevilla','C/ave','Snorkel','juan1234');
/* insert erroneo (key repetida)
insert into usuario values('47342916J','Juan','Delgado','999999999','España','juandels3','juan@gmail.com','41410','Sevilla','C/ave','Snorkel','juan1234');
*/

-- INSERT EN EMPRESA
insert into empresa values('11111111k','Sevilla Aventura','999999999','Sevilla,','Sevilla','S_Adventures','Snorkel','www.sevillaaventura.com','sevillaaventura@gmail.com','lorem ipsum','41410','sevillaventura1234');
insert into empresa values('22222222s','Madrid Mataos','888888888','Madrid,','Madrid','MM','Submarinismo','www.madridmataos.net','mm@mataos.com','lorem ipsum siamet','65413','madridmataos1234');
/* insert erroneo (nif repetido)
insert into empresa values('22222222s','Madriles','888888888','Madrid,','Madrid','MM','Submarinismo','www.madridmataos.net','mm@mataos.com','lorem ipsum siamet','65413','madridmataos1234');
*/

-- INSERT EN OFERTA
insert into oferta values(1,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','submarinismo','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(2,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(3,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(4,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','submarinismo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
/* insert erroneo
insert into oferta values(2,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','116-07-15','20-08-18');
*/

-- INSERT EN RESERVA
insert into reserva values(1,'47342916S',1,'18-04-14',3,61.5,5,'excelente actividad');
insert into reserva values(2,'47342918S',1,'18-04-14',4,82.0,3,'el tiempo no se ajusta al indicado y el nivel es superior al esperado');
insert into reserva values(3,'47342918S',1,'18-04-14',4,82.0,1,'mal, muy mal');


/* insert erroneo
insert into reserva values(4,'99999999S',1,'18-04-14',3,69.69); -- El NIF no existe en los users.
insert into reserva values(3,'47342916S',2,'18-04-14',4,82.0); -- Se repite ID, dará error.
*/
