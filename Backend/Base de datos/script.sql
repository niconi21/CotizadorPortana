CREATE DATABASE cotizador;
USE cotizador;
CREATE TABLE Cliente(
  id INT AUTO_INCREMENT NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  telefono VARCHAR(10) NOT NULL,
  CONSTRAINT pk_cliente PRIMARY KEY(id)
);
CREATE TABLE Direccion(
  id INT AUTO_INCREMENT NOT NULL,
  direccion VARCHAR(200) NOT NULL,
  CONSTRAINT pk_direccion PRIMARY KEY(id)
);

CREATE TABLE ClienteDireccion(
  id INT AUTO_INCREMENT NOT NULL,
  direccion INT NOT NULL,
  cliente INT NOT NULL,
  CONSTRAINT fk_direccion_to_direccion FOREIGN KEY(direccion) REFERENCES Direccion(id),
  CONSTRAINT fk_cliente_to_cliente FOREIGN KEY(cliente) REFERENCES Cliente(id),
  CONSTRAINT pk_ClienteDireccion PRIMARY KEY(id)
);

CREATE TABLE Salario(
  id INT AUTO_INCREMENT NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  cantidad INT NOT NULL,
  CONSTRAINT pk_salario PRIMARY KEY(id)
);
CREATE TABLE Empleado(
  id INT AUTO_INCREMENT NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  telefono VARCHAR(10) NOT NULL,
  CONSTRAINT pk_empleado PRIMARY KEY(id)
);

