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
	valoracion int(5),
	resena varchar(500),
	PRIMARY KEY (id),
	FOREIGN KEY (nif_usuario) REFERENCES usuario(nif),
	FOREIGN KEY (id_oferta) REFERENCES oferta(id)
);

-- INSERT EN USUARIO
insert into usuario values('47342916S','Cristian','De los Santos Pariente','77858968E','España','Baby','cristian@gmail.com','41410','user-default.png','Sevilla','C/ Despeñaperros','acuatica','ddf7057a2557945754e0da8348c6dfb3');
insert into usuario values('47342917S','Fran','Alcon','77648961F','España','FranPLayer','Fran@gmail.com','41410','user-default.png','Sevilla','C/ Bami','aire','bfdd41f4f0c93fbc96c29cdd3da95c0a');
insert into usuario values('47342918S','Fredy','Jerby','79536514O','España','Jefry','Fredy@gmail.com','41410','user-default.png','Sevilla','C/ Dos Hermanas','aire','4951387aa6f624c9b807d4196f12c222');
insert into usuario values('47342919S','Javi','Jimenez','76254868T','España','Moro','javi@gmail.com','41410','user-default.png','Sevilla','C/ Nervion Plaza','nieve','193b0ab64631d233958f5b7afb948f5c');
insert into usuario values('47342916J','Juan','Delgado','77867347H','España','juandels3','juan@gmail.com','41410','user-default.png','Sevilla','C/ Mares del Sur 16','tierra','c7f626ad40317f4dc7b295c6f04c850d');


-- INSERT EN EMPRESA
insert into empresa values('g2468123j','Caminos de Yucatán','955648457','Sevilla,','Sevilla','CY_Actividades','user-default.png','agua','www.caminosyucatan.com','yucatanactividades@gmail.com','Apúntate a las actividades de los Caminos de Yucatán y respira el aire libre. Especialistas en actividades acuáticas','41410','c43839f50b944003d68676f70333242d');
insert into empresa values('v1685473s','Madrid Adventures','902575841','Madrid,','Madrid','MAD','user-default.png','tierra','www.mad.net','mad@actividades.com','En Madrid Adventures creamos actividades al aire libre para todos los públicos','65413','f73a0f6ca4c997b5d84a09159907c9d9');


-- INSERT EN OFERTA
insert into oferta values(1,'v1685473s','Surf Extreme','Cádiz','Conil de la Frontera','40','15','surf','Disfruta del buen surf extremo. 40 minutos de surf en Conil con monitores de calidad','Conil de la Frontera',22,'media','surf.jpg','acuatica','18-06-22','18-06-24');
insert into oferta values(2,'g2468123j','Senderismo por el valle','Sevilla','San Nicolás','40','25','senderismo','Disfruta de una ruta con vistas inolvidables','Cerro del Hierro',10,'facil','cerrodelhierro.jpg','tierra','18-06-25','18-06-30');
insert into oferta values(3,'g2468123j','En el fondo del mar','Huelva','Isla del Moral','60','30','submarinismo','Visualiza la belleza del mar en las profundidades en una experiencia única','Club de buceo Islasub',25,'media','submarinismo.jpg','agua','18-06-27','18-07-01');
