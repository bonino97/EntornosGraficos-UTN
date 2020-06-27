CREATE TABLE IF NOT EXISTS Catalogo (
  Id int(10) NOT NULL AUTO_INCREMENT,
  Producto varchar(100) NOT NULL,
  Precio decimal(9,2) NOT NULL,
  Imagen varchar(100),
  PRIMARY KEY (Id)
);