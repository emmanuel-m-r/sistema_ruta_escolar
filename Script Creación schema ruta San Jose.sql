USE rutasanjose;

CREATE TABLE `Usuario` (
  `Id_usuario` int PRIMARY KEY,
  `Nombre` varchar(255),
  `Apellido` varchar(255),
  `correo` varchar(255),
  `contraseña` varchar(255)
);

CREATE TABLE `Conductor` (
  `Id_Conductor` int PRIMARY KEY,
  `Nombre` varchar(255),
  `Apellido` varchar(255),
  `Num_documento` varchar(255),
  `Id_ruta` int
);

CREATE TABLE `Estudiante` (
  `Id_estudiante` int PRIMARY KEY,
  `Nombre` varchar(255),
  `Apellido` varchar(255),
  `Num_documento` varchar(255),
  `Tipo_doc` varchar(255),
  `Id_acudiente` int,
  `Id_ruta` int,
  `Id_curso` int
);

CREATE TABLE `Acudiente` (
  `Id_acudiente` int PRIMARY KEY,
  `Nombre_acu` varchar(255),
  `Apellido_acu` varchar(255),
  `Num_documento` varchar(255),
  `Cel_emergencia` varchar(255),
  `Parentesco` varchar(255)
);

CREATE TABLE `Ruta` (
  `Id_ruta` int PRIMARY KEY,
  `Nombre` varchar(255),
  `Id_conductor` int
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

CREATE TABLE `ASISTENCIAS` (
  `Id_asistencias` int PRIMARY KEY,
  `Id_estudiante` int,
  `Id_usuario` int,
  `Id_ruta` int,
  `Fecha` date,
  `Hora_registro` time
);

CREATE TABLE `acudiente_estudiante` (
  `Num_doc_acu` varchar(255),
  `Num_doc_estu` varchar(255)
);

ALTER TABLE `ASISTENCIAS` ADD FOREIGN KEY (`Id_usuario`) REFERENCES `Usuario` (`Id_usuario`);

ALTER TABLE `Ruta` ADD FOREIGN KEY (`Id_conductor`) REFERENCES `Conductor` (`Id_Conductor`);

ALTER TABLE `PARADAS` ADD FOREIGN KEY (`Id_ruta`) REFERENCES `Ruta` (`Id_ruta`);

ALTER TABLE `ASISTENCIAS` ADD FOREIGN KEY (`Id_ruta`) REFERENCES `Ruta` (`Id_ruta`);

ALTER TABLE `ASISTENCIAS` ADD FOREIGN KEY (`Id_estudiante`) REFERENCES `Estudiante` (`Id_estudiante`);

ALTER TABLE `Estudiante` ADD FOREIGN KEY (`Id_curso`) REFERENCES `CURSO` (`Id_curso`);

ALTER TABLE `Estudiante` ADD FOREIGN KEY (`Id_ruta`) REFERENCES `Ruta` (`Id_ruta`);

ALTER TABLE `acudiente_estudiante` ADD FOREIGN KEY (`Num_doc_acu`) REFERENCES `Acudiente` (`Num_documento`);

ALTER TABLE `acudiente_estudiante` ADD FOREIGN KEY (`Num_doc_estu`) REFERENCES `Estudiante` (`Num_documento`);

ALTER TABLE `Acudiente` ADD FOREIGN KEY (`Id_acudiente`) REFERENCES `Estudiante` (`Id_acudiente`);
