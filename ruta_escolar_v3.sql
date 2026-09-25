
DROP DATABASE ruta_escolar_v3;

CREATE DATABASE ruta_escolar_v3;
USE ruta_escolar_v3;

-- ===========================
-- TABLAS MAESTRAS
-- ===========================

CREATE TABLE curso (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE conductor (
    num_doc_conductor INT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20)
);

CREATE TABLE ruta (
    id_ruta INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    fk_num_doc_conductor INT NOT NULL UNIQUE,
		
    CONSTRAINT fk_ruta_conductor
        FOREIGN KEY (fk_num_doc_conductor)
        REFERENCES conductor(num_doc_conductor),
    
    UNIQUE (id_ruta,fk_num_doc_conductor)
	
);

CREATE TABLE parada (
    id_parada INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    comunidad VARCHAR(100) NOT NULL,
    km_referencia DECIMAL(6,2),
    fk_id_ruta INT NOT NULL,

    CONSTRAINT fk_parada_ruta
        FOREIGN KEY (fk_id_ruta)
        REFERENCES ruta(id_ruta)
);

-- ===========================
-- ESTUDIANTES Y ACUDIENTES
-- ===========================

CREATE TABLE estudiante (
    num_doc_estu VARCHAR(20) PRIMARY KEY,
    tipo_doc_estu VARCHAR(20) NOT NULL,
    nombre VARCHAR(45) NOT NULL,
    segundo_nombre VARCHAR(45),
    apellido VARCHAR(45) NOT NULL,
    segundo_apellido VARCHAR(45),

    fk_id_curso INT NOT NULL,
    fk_id_parada INT NOT NULL,

    CONSTRAINT fk_estudiante_curso
        FOREIGN KEY (fk_id_curso)
        REFERENCES curso(id_curso),

    CONSTRAINT fk_estudiante_parada
        FOREIGN KEY (fk_id_parada)
        REFERENCES parada(id_parada)

);

CREATE TABLE acudiente (
    num_doc_acu VARCHAR(20) PRIMARY KEY,
    nombre_acu VARCHAR(100) NOT NULL,
    apellido_acu VARCHAR(100) NOT NULL,
    telefono VARCHAR(20)
);

CREATE TABLE parentesco (
    id_parentesco INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE acudiente_estudiante (
    fk_num_doc_acu VARCHAR(20) NOT NULL,
    fk_num_doc_estu VARCHAR(20) NOT NULL,
    fk_id_parentesco INT NOT NULL,
    tipo_acudiente ENUM('PRINCIPAL','SUPLENTE') NOT NULL,

    PRIMARY KEY (fk_num_doc_acu, fk_num_doc_estu),

    CONSTRAINT fk_ae_acudiente
        FOREIGN KEY (fk_num_doc_acu)
        REFERENCES acudiente(num_doc_acu),

    CONSTRAINT fk_ae_estudiante
        FOREIGN KEY (fk_num_doc_estu)
        REFERENCES estudiante(num_doc_estu),

    CONSTRAINT fk_ae_parentesco
        FOREIGN KEY (fk_id_parentesco)
        REFERENCES parentesco(id_parentesco),

    -- Un estudiante solo puede tener un principal y un suplente.
    UNIQUE (fk_num_doc_estu, tipo_acudiente)
);

-- ===========================
-- USUARIOS DEL SISTEMA
-- ===========================

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE administrador (
    fk_id_usuario INT PRIMARY KEY,
    
    CONSTRAINT fk_admin_usuario
        FOREIGN KEY (fk_id_usuario)
        REFERENCES usuario(id_usuario)
        ON DELETE CASCADE
);

CREATE TABLE auxiliar (
    fk_id_usuario INT PRIMARY KEY,
    fk_id_ruta INT NOT NULL,

    CONSTRAINT fk_aux_usuario
        FOREIGN KEY (fk_id_usuario)
        REFERENCES usuario(id_usuario)
        ON DELETE CASCADE,

    CONSTRAINT fk_aux_ruta
        FOREIGN KEY (fk_id_ruta)
        REFERENCES ruta(id_ruta),

	UNIQUE(fk_id_usuario,fk_id_ruta)
);

-- ===========================
-- ASISTENCIAS
-- ===========================

CREATE TABLE jornada(
	id_jornada INT AUTO_INCREMENT PRIMARY KEY,
    fk_id_ruta INT NOT NULL,
    fk_id_usuario INT NOT NULL,
    tipo_recorrido ENUM("IDA","REGRESO") NOT NULL,
    fecha DATE NOT NULL DEFAULT (CURRENT_DATE),
    
    CONSTRAINT fk_jornada_ruta
		FOREIGN KEY (fk_id_ruta)
        REFERENCES ruta (id_ruta),
        
	CONSTRAINT fk_jornada_usuario
		FOREIGN KEY (fk_id_usuario)
        REFERENCES usuario(id_usuario)
    );


CREATE TABLE asistencia (
    id_asistencia INT AUTO_INCREMENT PRIMARY KEY,
    fk_num_doc_estu VARCHAR(20) NOT NULL,
    fk_jornada INT NOT NULL,
    hora TIME NOT NULL DEFAULT (CURRENT_TIME),
    estado ENUM("REGISTRADO","PENDIENTE") DEFAULT "PENDIENTE",
	

    CONSTRAINT fk_asistencia_estudiante
        FOREIGN KEY (fk_num_doc_estu)
        REFERENCES estudiante(num_doc_estu),
	
    CONSTRAINT fk_asistencia_jornada
		FOREIGN KEY (fk_jornada)
        REFERENCES jornada (id_jornada),
	
    UNIQUE (fk_num_doc_estu,fk_jornada)
);

