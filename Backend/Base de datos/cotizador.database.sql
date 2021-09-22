CREATE DATABASE cotizador;
USE cotizador;
CREATE TABLE Cliente(
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(60),
  correo VARCHAR(60),
  telefono VARCHAR(10),
  CONSTRAINT pk_cliente PRIMARY KEY (id),
  CONSTRAINT uk_cliente_nombre UNIQUE (nombre),
  CONSTRAINT uk_cliente_correo UNIQUE (correo),
  CONSTRAINT uk_cliente_telefono UNIQUE (telefono)
);
CREATE TABLE Direccion(
  id INT NOT NULL AUTO_INCREMENT,
  ciudad VARCHAR(30),
  colonia VARCHAR(30),
  calle VARCHAR(30),
  noExt INT,
  noInt INT,
  referencia VARCHAR(200),
  cliente INT,
  CONSTRAINT pk_direccion PRIMARY KEY (id),
  CONSTRAINT fk_direccion_to_cliente FOREIGN KEY (cliente) REFERENCES Cliente (id)
);
CREATE TABLE Proyecto(
  id INT NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(500),
  fecha DATE,
  cliente INT,
  CONSTRAINT pk_proyecto PRIMARY KEY (id),
  CONSTRAINT fk_proyecto_to_cliente FOREIGN KEY (cliente) REFERENCES Cliente (id)
);
CREATE TABLE Personal(
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(60),
  fechaAlta DATE,
  CONSTRAINT pk_personal PRIMARY KEY (id),
  CONSTRAINT uk_personal_nombre UNIQUE (nombre)
);
CREATE TABLE Labor(
  id INT NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(500),
  fechaAlta DATE,
  personal INT,
  proyecto INT,
  CONSTRAINT pk_labor PRIMARY KEY (id),
  CONSTRAINT fk_labor_to_personal FOREIGN KEY (personal) REFERENCES Personal(id),
  CONSTRAINT fk_labor_to_proyecto FOREIGN KEY (proyecto) REFERENCES Proyecto(id)
);
CREATE TABLE GastosOperativos(
  id INT NOT NULL AUTO_INCREMENT,
  horas INT,
  costoHora FLOAT,
  labor INT,
  CONSTRAINT pk_gastoOperativo PRIMARY KEY (id),
  CONSTRAINT fk_gastoOperativo_to_labor FOREIGN KEY (labor) REFERENCES Labor(id)
);
CREATE TABLE TipoMaterial(
  id INT NOT NULL AUTO_INCREMENT,
  tipo VARCHAR(20),
  CONSTRAINT pk_TipoMaterial PRIMARY KEY (id)
);
CREATE TABLE Material(
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(20),
  precio FLOAT,
  disponible TINYINT(1),
  largo FLOAT,
  ancho FLOAT,
  grosor FLOAT,
  color VARCHAR(20),
  tipoMaterial INT,
  CONSTRAINT pk_material PRIMARY KEY (id),
  CONSTRAINT fk_material_to_tipoMaterial FOREIGN KEY (tipoMaterial) REFERENCES TipoMaterial(id),
  CONSTRAINT uk_material_nombre UNIQUE (nombre)
);
CREATE TABLE MaterialProyecto(
  id INT NOT NULL AUTO_INCREMENT,
  cantidad FLOAT,
  precio FLOAT,
  material INT,
  proyecto INT,
  CONSTRAINT pk_materialProyecto PRIMARY KEY (id),
  CONSTRAINT fk_materialProyecto_to_material FOREIGN KEY (material) REFERENCES Material(id),
  CONSTRAINT fk_materialProyecto_to_proyecto FOREIGN KEY (proyecto) REFERENCES Proyecto(id)
);