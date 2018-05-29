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
  imagen_perfil varchar(100),
	provincia varchar(30),
	direccion varchar(30),
	actividad_fav varchar(20),
	password varchar(150),
	PRIMARY KEY (nif)
);

CREATE TABLE empresa(
	cif varchar(30) NOT NULL,
	nombre varchar(30),
	telefono varchar(9),
	pais varchar(30),
	provincia varchar(30),
	alias varchar(30),
  imagen_perfil varchar(100),
	tipo_actividad varchar(30),
	web varchar(35),
	email varchar(35),
	descripcion varchar(150),
	cp varchar(5),
	password varchar(150),
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
  imagen_oferta varchar(100),
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
	coste_reserva double(8,2),
	valoración int(5),
	reseña varchar(500),
	PRIMARY KEY (id),
	FOREIGN KEY (nif_usuario) REFERENCES usuario(nif),
	FOREIGN KEY (id_oferta) REFERENCES oferta(id)
);

-- INSERT EN USUARIO
insert into usuario values('47342916S','Cristian','De los Santos Pariente','999999999','España','Baby','cristian@gmail.com','41410','img_perfil1.jpg','Sevilla','C/Despeñaperros','Snorkel','ddf7057a2557945754e0da8348c6dfb3');
insert into usuario values('47342917S','Fran','Alcon','999999999','España','FranPLayer','Fran@gmail.com','41410','img_perfil2.jpg','Sevilla','C/Bami','Correr','bfdd41f4f0c93fbc96c29cdd3da95c0a');
insert into usuario values('47342918S','Fredy','Jerby','999999999','España','Jefry','Fredy@gmail.com','41410','img_perfil3.jpg','Sevilla','C/DosHermanas','Salto','4951387aa6f624c9b807d4196f12c222');
insert into usuario values('47342919S','Javi','Jimenez','999999999','España','Moro','javi@gmail.com','41410','img_perfil4.jpg','Sevilla','C/Sevilla','Gimna','193b0ab64631d233958f5b7afb948f5c');
insert into usuario values('47342916J','Juan','Delgado','999999999','España','juandels3','juan@gmail.com','41410','juan.jpg','Sevilla','C/ave','Snorkel','c7f626ad40317f4dc7b295c6f04c850d');
/* insert erroneo (key repetida)
insert into usuario values('47342916J','Juan','Delgado','999999999','España','juandels3','juan@gmail.com','41410','Sevilla','C/ave','Snorkel','juan1234');
*/

-- INSERT EN EMPRESA
insert into empresa values('11111111k','Sevilla Aventura','999999999','Sevilla,','Sevilla','S_Adventures','img_perfil.jpg','Snorkel','www.sevillaaventura.com','sevillaaventura@gmail.com','lorem ipsum','41410','f39ffce37eeba46736be136e3a25c105');
insert into empresa values('22222222s','Madrid Mataos','888888888','Madrid,','Madrid','MM','img_perfil.jpg','Submarinismo','www.madridmataos.net','mm@mataos.com','lorem ipsum siamet','65413','e2ad4ad226efa2430f5e86808a45a0f0');
/* insert erroneo (nif repetido)
insert into empresa values('22222222s','Madriles','888888888','Madrid,','Madrid','MM','Submarinismo','www.madridmataos.net','mm@mataos.com','lorem ipsum siamet','65413','madridmataos1234');
*/

-- INSERT EN OFERTA
insert into oferta values(1,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','submarinismo','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(2,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(3,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','surf','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(4,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','submarinismo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','aire','27-09-18','20-09-18');
insert into oferta values(5,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','buceo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(6,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','submarinismo','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(7,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(8,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(9,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','submarinismo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','aire','27-09-18','20-09-18');
insert into oferta values(10,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','nieve','16-07-18','20-07-18');
insert into oferta values(11,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','submarinismo','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(12,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(13,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','snorkel','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(14,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','surf','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(15,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','aire','16-07-18','20-07-18');
insert into oferta values(16,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','submarinismo','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(17,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','snorkel','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(18,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(19,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','buceo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','aire','27-09-18','20-09-18');
insert into oferta values(20,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','nieve','16-07-18','20-07-18');
insert into oferta values(21,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','surf','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(22,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(23,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(24,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','buceo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(25,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(26,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','submarinismo','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(27,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','snorkel','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','aire','16-07-18','20-07-18');
insert into oferta values(28,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(29,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','submarinismo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(30,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','nieve','16-07-18','20-07-18');
insert into oferta values(31,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','snorkel','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(32,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','aire','16-07-18','20-07-18');
insert into oferta values(33,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','buceo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(34,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','submarinismo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(35,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','aire','16-07-18','20-07-18');
insert into oferta values(36,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','surf','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(37,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','snorkel','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(38,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(39,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','buceo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(40,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(41,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','snorkel','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','nieve','18-04-18','19-04-18');
insert into oferta values(42,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','nieve','16-07-18','20-07-18');
insert into oferta values(43,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(44,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','snorkel','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(45,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','nieve','16-07-18','20-07-18');
insert into oferta values(46,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','surf','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(47,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','snorkel','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(48,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(49,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','buceo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(50,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','snorkel','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(51,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','snorkel','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(52,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','surf','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','aire','16-07-18','20-07-18');
insert into oferta values(53,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(54,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','submarinismo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(55,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','nieve','16-07-18','20-07-18');
insert into oferta values(56,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','surf','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(57,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','aire','16-07-18','20-07-18');
insert into oferta values(58,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','buceo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(59,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','snorkel','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(60,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','aire','16-07-18','20-07-18');
insert into oferta values(61,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','surf','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','acuatica','18-04-18','19-04-18');
insert into oferta values(62,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(63,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(64,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','buceo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(65,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','tierra','16-07-18','20-07-18');
insert into oferta values(66,'11111111k','Nombre1','Provincia1','Municipio1','2 dias','20','snorkel','lorem ipsum','guadalquivir',20.50,'facil','linkimage.jpg','nieve','18-04-18','19-04-18');
insert into oferta values(67,'22222222s','Nombre2','Provincia2','Municipio2','4 dias','40','senderismo','lorem ipsum siamet','monte nuevo',40.55,'moderado','linkimage2.jpg','nieve','16-07-18','20-07-18');
insert into oferta values(68,'22222222s','Nombre3','Provincia3','Municipio3','7 dias','50','paracaidismo','lorem ipsum siametparacaidismo','mount chiliad',100.50,'dificil','linkimage3.jpg','aire','20-08-18','20-08-22');
insert into oferta values(69,'11111111k','Nombre4','Provincia4','Municipio4','5 dias','80','buceo','lorem ipsuma','san lucar',30,'moderado','linkimage4.jpg','acuatica','27-09-18','20-09-18');
insert into oferta values(70,'22222222s','Nombre5','Provincia5','Municipio5','7 dias','30','senderismo','lorem ipsum siamet','cazalla',80.55,'moderado','linkimage5.jpg','nieve','16-07-18','20-07-18');
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
