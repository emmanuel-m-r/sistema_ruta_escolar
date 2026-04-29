CREATE SCHEMA `prueba`;

USE `prueba`;

CREATE TABLE `Usuario` (
  `Id_usuario` int PRIMARY KEY,
  `Nombre` varchar(255),
  `Apellido` varchar(255),
  `correo` varchar(255),
  `contraseña` varchar(255)
);

CREATE TABLE `Conductor` (
  `Num_documento` int PRIMARY KEY,
  `Nombre` varchar(255),
  `Apellido` varchar(255),
  `Id_ruta` int
);

CREATE TABLE `Estudiante` (
  `num_documento_estu` int PRIMARY KEY,
  `Nombre` varchar(255),
  `Apellido` varchar(255),
  `Tipo_doc` varchar(255),
  `Id_ruta` int,
  `Id_curso` int
);

CREATE TABLE `Acudiente` (
  `Num_documento` int PRIMARY KEY,
  `Nombre_acu` varchar(255),
  `Apellido_acu` varchar(255),
  `Cel_emergencia` varchar(255)
);

CREATE TABLE `Ruta` (
  `Id_ruta` int PRIMARY KEY,
  `Nombre` varchar(255),
  `fk_doc_conductor` int
);

CREATE TABLE `PARADAS` (
  `Id_paradas` int PRIMARY KEY,
  `Nombre_parada` varchar(255),
  `Km_referencia` varchar(255),
  `Comunidad` varchar(255),
  `Id_ruta` int
);

CREATE TABLE `CURSO` (
  `Id_curso` int PRIMARY KEY,
  `Nombre_curso` varchar(255)
);


CREATE TABLE `prueba`.`acudiente_estudiante` (
  `Num_doc_acu` INT NOT NULL,
  `Num_doc_estu` INT NOT NULL,
  PRIMARY KEY (`Num_doc_acu`, `Num_doc_estu`));

CREATE TABLE `ASISTENCIAS` (			
  `Id_asistencias` int PRIMARY KEY,
  `fk_doc_estudiante` int not null,
  `Id_usuario` int not null,
  `Id_ruta` int not null,
  `Fecha` date,
  `Hora_registro` time
);

ALTER TABLE `asistencias` ADD FOREIGN KEY (`Id_usuario`) REFERENCES `usuario` (`Id_usuario`);


ALTER TABLE asistencias
ADD CONSTRAINT fk_id_ruta
FOREIGN KEY (Id_ruta) REFERENCES ruta (id_ruta);

ALTER TABLE asistencias
ADD CONSTRAINT fk_doc_estudiante
FOREIGN KEY (fk_doc_estudiante) REFERENCES estudiante(num_documento_estu);

ALTER TABLE ruta
ADD CONSTRAINT fk_doc_conductor
FOREIGN KEY (fk_doc_conductor) REFERENCES conductor (Num_documento);

ALTER TABLE `paradas` ADD FOREIGN KEY (`Id_ruta`) REFERENCES `ruta` (`Id_ruta`);

ALTER TABLE `estudiante` ADD FOREIGN KEY (`Id_curso`) REFERENCES `curso` (`Id_curso`);

ALTER TABLE `estudiante` ADD FOREIGN KEY (`Id_ruta`) REFERENCES `ruta` (`Id_ruta`);

ALTER TABLE `acudiente_estudiante` ADD FOREIGN KEY (`Num_doc_acu`) REFERENCES `acudiente` (`Num_documento`);

ALTER TABLE `acudiente_estudiante` ADD FOREIGN KEY (`Num_doc_estu`) REFERENCES `estudiante` (`Num_documento_estu`);

