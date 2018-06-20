DROP DATABASE IF EXISTS actividades;
CREATE DATABASE actividades;
use actividades;

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
	nombre varchar(35),
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
	valoracion int(5),
	resena varchar(500),
	PRIMARY KEY (id),
	FOREIGN KEY (nif_usuario) REFERENCES usuario(nif),
	FOREIGN KEY (id_oferta) REFERENCES oferta(id)
);

-- INSERT EN USUARIO
insert into usuario values('47342916S','Cristian','De los Santos Pariente','955662454','España','Baby','cristian@gmail.com','41410','user-default.png','Sevilla','C/ Despeñaperros','acuatica','ddf7057a2557945754e0da8348c6dfb3');
insert into usuario values('47342917S','Fran','Alcon','954354547','España','FranPLayer','Fran@gmail.com','41410','user-default.png','Sevilla','C/ Bami','aire','bfdd41f4f0c93fbc96c29cdd3da95c0a');
insert into usuario values('47342918S','Fredy','Jerby','954254584','España','Jefry','Fredy@gmail.com','41410','user-default.png','Sevilla','C/ Dos Hermanas','aire','4951387aa6f624c9b807d4196f12c222');
insert into usuario values('47342919S','Javi','Jimenez','955256325','España','Moro','javi@gmail.com','41410','user-default.png','Sevilla','C/ Nervion Plaza','nieve','193b0ab64631d233958f5b7afb948f5c');
insert into usuario values('47342916J','Juan','Delgado','954785474','España','juandels3','juan@gmail.com','41410','user-default.png','Sevilla','C/ Mares del Sur 16','tierra','c7f626ad40317f4dc7b295c6f04c850d');


-- INSERT EN EMPRESA
insert into empresa values('g2468123j','Caminos de Yucatán','955648457','España','Sevilla','CY_Actividades','user-default.png','agua','www.caminosyucatan.com','yucatanactividades@gmail.com','Apúntate a las actividades de los Caminos de Yucatán y respira el aire libre. Especialistas en actividades acuáticas','41410','c43839f50b944003d68676f70333242d');
insert into empresa values('v1685473s','Madrid Adventures','902575841','España','Madrid','MAD','user-default.png','tierra','www.mad.net','mad@actividades.com','En Madrid Adventures creamos actividades al aire libre para todos los públicos','65413','f73a0f6ca4c997b5d84a09159907c9d9');


-- INSERT EN OFERTA
insert into oferta values(1,'v1685473s','Surf Extreme','Cádiz','Conil de la Frontera','40','15','surf','Disfruta del buen surf extremo. 40 minutos de surf en Conil con monitores de calidad','Conil de la Frontera',22,'media','surf.jpg','agua','18-06-22','18-06-24');
insert into oferta values(2,'g2468123j','Senderismo por el valle','Sevilla','San Nicolás','40','25','senderismo','Disfruta de una ruta con vistas inolvidables','Cerro del Hierro',10,'facil','cerrodelhierro.jpg','tierra','18-06-25','18-06-30');
insert into oferta values(3,'g2468123j','En el fondo del mar','Huelva','Isla del Moral','60','30','submarinismo','Visualiza la belleza del mar en las profundidades en una experiencia única','Club de buceo Islasub',25,'media','submarinismo.jpg','agua','18-06-27','18-07-01');
insert into oferta values(4,'v1685473s','Paracaidismo en Utrera','Sevilla','Utrera','120','120','paracaidismo','Experiementa una caida libre de 50 seg y un placido paseo en paracaidas','Utrera',90,'alta','paracaidas.jpg','aire','18-06-28','18-07-28');
insert into oferta values(5,'g2468123j','Buceo en Almeria','Almeria','Cabo de Gata','240','20','buceo','¿Que nos depara el fondo del mar??','Cabo de Gata',35,'media','buceo.jpg','agua','18-07-05','18-07-30');
insert into oferta values(6,'v1685473s','Snorkel','Cádiz','Barbate','100','15','snorkel','Primeras experiencias con el snorkel','Barbate',15,'facil','snorkel.jpg','agua','18-07-22','18-08-15');
insert into oferta values(7,'g2468123j','Senderismo Sierra Norte','Sevilla','Alanís','240','25','senderismo','Conoce la Sierra Norte de Sevilla','Constantina',10,'facil','senderismo.jpg','tierra','18-06-25','18-06-30');
insert into oferta values(8,'v1685473s','Salta desde un avion','Sevilla','Pilas','120','30','paracaidismo','Experiementa una caida libre de 50 seg y un placido paseo en paracaidas','Pilas',100,'alta','paracaidas1.jpg','aire','18-07-28','18-08-28');
insert into oferta values(9,'g2468123j','Surf en Almeria','Almeria','Cabo de Gata','180','20','surf','Empieza a cojer olas en las playas de Almería','Cabo de Gata',15,'media','surf.jpg','agua','18-07-05','18-07-30');
insert into oferta values(10,'v1685473s','Conoce el snorkel','Huelva','Mazagon','100','10','snorkel','Primeras experiencias con el snorkel','Mazagon',15,'facil','snorkel1.jpg','agua','18-08-12','18-08-28');
insert into oferta values(11,'g2468123j','2ªRuta Senderismo Sierra Norte','Sevilla','Alanís','240','25','senderismo','Conoce la Sierra Norte de Sevilla','Constantina',10,'facil','senderismo1.jpg','tierra','18-08-01','18-09-15');
insert into oferta values(12,'g2468123j','Esquí en Sierra Nevada','Granada','Sierra Nevada','240','10','esquí','Aventuras en la nieve','Sierra Nevada',50,'facil','esqui.jpeg','nieve','18-08-01','18-09-15');
insert into oferta values(13,'v1685473s','Snorkel','Cádiz','Barbate','100','15','snorkel','Primeras experiencias con el snorkel','Barbate',15,'facil','snorkel.jpg','agua','18-06-22','18-08-15');
insert into oferta values(14,'g2468123j','3ªRuta Senderismo Sierra Norte','Sevilla','Alanís','240','25','senderismo','Conoce la Sierra Norte de Sevilla','Constantina',10,'facil','senderismo.jpg','tierra','18-06-10','18-07-20');
insert into oferta values(15,'v1685473s','2º Salt0 desde un avion','Sevilla','Pilas','120','30','paracaidismo','Experiementa una caida libre de 50 seg y un placido paseo en paracaidas','Pilas',100,'alta','paracaidas1.jpg','aire','18-07-05','18-08-01');

-- INSERT DE EJEMPLO EN RESERVA
insert into reserva (nif_usuario,id_oferta,fecha_reserva,num_plazas_reserva,coste_reserva, valoracion, resena) values('47342916S',8,'2018-06-12',1,100.00,NULL,NULL);
insert into reserva (nif_usuario,id_oferta,fecha_reserva,num_plazas_reserva,coste_reserva, valoracion, resena) values('47342916J',9,'2018-06-21',2,30.00,NULL,NULL);
