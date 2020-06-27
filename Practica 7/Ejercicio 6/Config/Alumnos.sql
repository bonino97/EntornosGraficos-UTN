CREATE TABLE IF NOT EXISTS Alumnos (
  Codigo int(10) NOT NULL AUTO_INCREMENT,
  Nombre varchar(100) NOT NULL,
  CodigoCurso int(10) NOT NULL,
  Mail varchar(100) NOT NULL,
  PRIMARY KEY (Codigo)
);