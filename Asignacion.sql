CREATE DATABASE Asignacion;
USE Asignacion;
Create table Alumno(
    boleta INT PRIMARY KEY,
    Nombre VARCHAR(50),
    primerApe VARCHAR(30),
    segundoApe VARCHAR(30),
    telefono VARCHAR(10),
    estatura FLOAT,
    edad INT,
    correo VARCHAR(100),
    credencial BLOB,
    Horario BLOB,
    usuario_alum VARCHAR(50),
    contra_alum VARCHAR(40)
);

CREATE TABLE Solicitud(
    id_soli INT AUTO_INCREMENT PRIMARY KEY,
    boleta INT,
    usuario_alum VARCHAR(50),
    tipo_soli VARCHAR(25),
    estado_soli VARCHAR(25),
    hora_registro TIME,
    casillero_anterior INT DEFAULT NULL,
    FOREIGN KEY(boleta) REFERENCES Alumno(boleta)
);

CREATE TABLE Casillero(
    num_casillero INT AUTO_INCREMENT PRIMARY KEY,
    id_soli INT,
    estado_cas VARCHAR(25),
    FOREIGN KEY(id_soli) REFERENCES Solicitud(id_soli)
);

CREATE TABLE Comprobante(
    id_compro INT AUTO_INCREMENT PRIMARY KEY,
    id_soli INT,
    archivo_pdf BLOB,
    FOREIGN KEY(id_soli) REFERENCES Solicitud(id_soli)
);

CREATE TABLE Administrador(
    usuario_admin VARCHAR(50) PRIMARY KEY,
    contra_admin VARCHAR(50)
);