CREATE DATABASE hospital;

USE hospital;

CREATE TABLE especialidad (
    idEspecialidad INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL
);

INSERT INTO especialidad (nombre) VALUES ("Pediatria");
INSERT INTO especialidad (nombre) VALUES ("Medicina General");

CREATE TABLE medico (
    idMedico INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    apellidoPa VARCHAR(150) NOT NULL,
    apellidoMa VARCHAR(150) NULL,
    telefono VARCHAR(10) NULL,
    cedula VARCHAR(100) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    password VARCHAR(100) NOT NULL,
    admin boolean not null,
    idEspecialidad int not null,

    CONSTRAINT fk_especialidad
    FOREIGN KEY (idEspecialidad) REFERENCES especialidad(idEspecialidad)

);

INSERT INTO medico (nombre, apellidoPa, apellidoMa, telefono, cedula,correo,password,admin,idEspecialidad) VALUES 
					('Juan', 'González', 'López', '+123456789', 'ABC12345','doctor@gmail.com','1234',1,1);

CREATE TABLE Farmacia (
    idFarmacia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion VARCHAR(255) NOT NULL

);

INSERT INTO Farmacia (nombre, descripcion) VALUES ('Medicamento A', 'Antiinflamatorio para aliviar el dolor.');
INSERT INTO Farmacia (nombre, descripcion) VALUES ('Vacuna C', 'Inmunización contra enfermedades infecciosas.');


CREATE TABLE medicamento (
    idMedicamento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre Varchar(255),
    fechaCaducidad DATE NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    ingredientes VARCHAR(255) NULL,
    descripcion VARCHAR(255) NULL
);

INSERT INTO medicamento (nombre,fechaCaducidad, precio, ingredientes, descripcion) VALUES ("MEDIPLUS",'2024-06-30', 25.99, 'Ibuprofeno, Paracetamol', 'Medicamento para el alivio del dolor.');
INSERT INTO medicamento (nombre,fechaCaducidad, precio, ingredientes, descripcion) VALUES ("JARABE",'2024-08-15', 15.50, 'Ácido Acetilsalicílico, Cafeína', 'Analgésico y estimulante.');
INSERT INTO medicamento (nombre,fechaCaducidad, precio, ingredientes, descripcion) VALUES ("PARACETAMOL",'2024-07-20', 10.75, 'Penicilina', 'Antibiótico de amplio espectro.');
INSERT INTO medicamento (nombre,fechaCaducidad, precio, ingredientes, descripcion) VALUES ("IBUPROFENO",'2024-09-10', 30.25, 'Lidocaína, Epinefrina', 'Anestésico local.');
INSERT INTO medicamento (nombre,fechaCaducidad, precio, ingredientes, descripcion) VALUES ("SIMI JARABE",'2024-10-05', 18.99, 'Salbutamol', 'Broncodilatador para el tratamiento del asma.');

CREATE TABLE detalleFarmacia (
    idMedicamento INT NOT NULL,
    idFarmacia INT NOT NULL,
    cantidad INT NOT NULL,
   
    PRIMARY KEY (idMedicamento, idFarmacia),
    CONSTRAINT fk_detalleFarmacia_medicamento
    FOREIGN KEY (idMedicamento) REFERENCES medicamento(idMedicamento),
    CONSTRAINT fk_detalleFarmacia_farmacia
    FOREIGN KEY (idFarmacia) REFERENCES Farmacia(idFarmacia)
);

INSERT INTO detalleFarmacia (idMedicamento, idFarmacia, cantidad) VALUES (1, 1, 100);


CREATE TABLE paciente (
    idPaciente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    apellidoPaterno VARCHAR(150) NOT NULL,
    apellidoMaterno VARCHAR(150) NULL,
    fechaNacimiento date not null,
    correo VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO paciente (nombre, apellidoPaterno, apellidoMaterno,fechaNacimiento,correo) VALUES ('Juan', 'Martínez', 'López','25-02-20','juan.lopez@example.com');

CREATE TABLE consulta (
    idConsulta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idPaciente INT NOT NULL,
    idMedico INT NOT NULL,
    fecha DATE NOT NULL,
    padecimiento TEXT NULL,
    
    CONSTRAINT fk_consulta_paciente
    FOREIGN KEY (idPaciente) REFERENCES paciente(idPaciente),
    CONSTRAINT fk_consulta_medico
    FOREIGN KEY(idMedico) REFERENCES medico(idMedico)
);

INSERT INTO consulta (idPaciente,idMedico,fecha,padecimiento) VALUES (1,1,'2025-02-12','infeccion de garganta');

CREATE TABLE receta (
    idReceta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idConsulta INT NOT NULL UNIQUE,
    fecha DATE NOT NULL,
    indicaciones TEXT NULL,
    comentarios TEXT NULL,

    CONSTRAINT fk_receta_consulta
    FOREIGN KEY(idConsulta) REFERENCES consulta(idConsulta)
);

INSERT INTO receta (idConsulta,fecha, indicaciones, comentarios) VALUES (1,'2024-04-10', 'Tomar medicamento A cada 8 horas', 'Ninguno');

CREATE TABLE detallesReceta (
    idReceta INT NOT NULL,
    idMedicamento INT NOT NULL,

    PRIMARY KEY(idReceta, idMedicamento),
    CONSTRAINT fk_detallesReceta_receta
    FOREIGN KEY(idReceta) REFERENCES receta(idReceta),
    CONSTRAINT fk_detallesReceta_medicamento
    FOREIGN KEY (idMedicamento) REFERENCES medicamento(idMedicamento)
);

INSERT INTO detallesReceta (idReceta, idMedicamento) VALUES (1, 1);


-- Procedures

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pacientes_insert`( IN `nombre` TEXT,  IN `apellidoPat` TEXT, IN `apellidoMat` TEXT, IN `fechaNac` TEXT, IN `correoPac` TEXT
)
BEGIN
    IF NOT EXISTS (SELECT idPaciente FROM paciente WHERE correo = correoPac) THEN
        INSERT INTO paciente (nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, correo)
        VALUES (nombre, apellidoPat, apellidoMat, fechaNac, correoPac);
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El paciente ya se encuentra registrado';
    END IF;
END$$
DELIMITER ;