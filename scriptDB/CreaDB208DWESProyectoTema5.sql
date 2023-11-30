-- Crea la base de datos DB208DWESProyectoTema4
CREATE DATABASE IF NOT EXISTS DB208DWESLoginLogoffTema5;

-- Selecciona la base de datos recién creada
USE DB208DWESLoginLogoffTema5;


-- Crea la tabla Usuarios
CREATE TABLE IF NOT EXISTS T01_Usuario (
    T01_CodUsuario CHAR(8) NOT NULL CHECK(CHAR_LENGTH(T01_CodUsuario) BETWEEN 4 AND 8),
    T01_Password VARCHAR(255) NOT NULL,
    T01_DescUsuario VARCHAR(255) NOT NULL,
    T01_NumConexiones INT DEFAULT 1 NOT NULL DEFAULT 1,
    T01_FechaHoraUltimaConexion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    T01_Perfil ENUM('usuario', 'administrador') NOT NULL DEFAULT 'usuario',
    T01_ImagenUsuario LONGBLOB,
    PRIMARY KEY (T01_CodUsuario)
);

-- Crea la tabla Departamento
CREATE TABLE IF NOT EXISTS T02_Departamento (
    T02_CodDepartamento CHAR(3) NOT NULL,
    T02_DescDepartamento VARCHAR(255) NOT NULL,
    T02_FechaCreacionDepartamento DATETIME NOT NULL,
    T02_VolumenDeNegocio FLOAT NOT NULL,
    T02_FechaBajaDepartamento DATETIME DEFAULT NULL,
    PRIMARY KEY (T02_CodDepartamento)
);

-- Crear usuario y dar privilegios
CREATE USER 'user208DWESLoginLogoffTema5'@'%' IDENTIFIED BY 'paso';
GRANT ALL PRIVILEGES ON DB208DWESLoginLogoffTema5.* TO 'user208DWESLoginLogoffTema5';
