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
	nombre varchar(25),
	telefono varchar(9),
	provincia varchar(30),
	municipio varchar(30),
	alias varchar(30),
	tipo_actividad varchar(30),
	web varchar(50),
	email varchar(50),
	descripcion varchar(150),
	cp varchar(5),
	password varchar(30),
	PRIMARY KEY (cif)
);	

CREATE TABLE oferta(
	id int NOT NULL,
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
	fecha_inicio date,
	fecha_fin date,
	PRIMARY KEY (id),
	FOREIGN KEY (cif_empresa) REFERENCES empresa(cif)
);	

CREATE TABLE reserva(
	id int NOT NULL,
	nif_usuario varchar(9),
	id_oferta int,
	fecha_reserva date,
	num_plazas_reserva int,
	coste_reserva double(5,2),
	PRIMARY KEY (id),
	FOREIGN KEY (nif_usuario) REFERENCES usuario(nif),
	FOREIGN KEY (id_oferta) REFERENCES oferta(id)
);
-- INSERT EN USUARIO
insert into usuario values('47342916S','Cristian','De los Santos Pariente','España','Baby','cristian@gmail.com','41410','Sevilla','C/Despeñaperros','Snorkel','cristian1234');	
insert into usuario values('47342917S','Fran','Alcon','España','FranPLayer','Fran@gmail.com','41410','Sevilla','C/Vami','Correr','Fran1234');
insert into usuario values('47342918S','Fredy','Jerby','España','Jefry','Fredy@gmail.com','41410','Sevilla','C/DosHermanas','Salto','Fredy1234');
insert into usuario values('47342919S','Javi','Jimenez','España','Moro','javi@gmail.com','41410','Sevilla','C/Sevilla','Gimna','javi1234');
-- insert erroneo
insert into usuario values('47342916S','Juan','Delgado','España','juan','juan@gmail.com','41410','Sevilla','C/ave','Snorkel','juan1234');



-- INSERT EN EMPRESA
insert into empresa values('11111111k','Sevilla Aventura','Snorkel','www.sevillaaventura.com','sevillaaventura@gmail.com','lorem ipsum','41410','sevillaventura1234');
-- insert erroneo
insert into empresa values('11111111k','Sevilla Aventura','Snorkel','www.sevillaaventura.com','sevillaaventura@gmail.com','lorem ipsum','41410','sevillaventura1234');



-- INSERT EN OFERTA
insert into oferta values(1,'11111111k','snorkel','lorem ipsum','guadalquivir',20.50,'facil','18-04-14','18-04-15');
-- insert erroneo
insert into oferta values(1,'11111111k','snorkel','lorem ipsum','guadalquivir',20.50,'facil','18-04-14','18-04-15');
insert into oferta values(2,'11111111h','snorkel','lorem ipsum','guadalquivir',20.50,'facil','18-04-14','18-04-15');



-- INSERT EN RESERVA
insert into reserva values(1,'47342916S',1,'18-04-14',3,61.5);
insert into reserva values(2,'47342918S',1,'18-04-14',4,82.0);

-- insert erroneo
insert into reserva values(1,'47342916S',1,'18-04-14',3,61.5);
insert into reserva values(3,'47342920S',1,'18-04-14',4,82.0);
insert into reserva values(4,'47342916S',1,'18-04-14',4,82.0);
insert into reserva values(3,'47342916S',2,'18-04-14',4,82.0);
