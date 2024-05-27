--
-- Data base name = 'registro_u'


-- Drop existing database
-- DROP DATABASE registro_u;


-- Database
-- CREATE DATABASE registro_u;


-- Change to database
\c registro_u


-- Drop data types
DROP TYPE active_type CASCADE;
DROP TYPE delete_type CASCADE;
-- Drop foreign keys
ALTER TABLE registro_usuarios
DROP CONSTRAINT registro_menus;
ALTER TABLE menus
DROP CONSTRAINT menus_modulos;
ALTER TABLE usuarios
DROP CONSTRAINT usuario_menus;
-- Drop existing tables (4)
DROP TABLE registro_usuarios;
DROP TABLE menus;
DROP TABLE modulos;
DROP TABLE usuarios;


-- Create data types
CREATE TYPE active_type AS ENUM ('activo', 'inactivo');
CREATE TYPE delete_type AS ENUM ('si', 'no');


-- Create tables
-- registo
CREATE TABLE registro_usuarios (
  id_usuario SERIAL PRIMARY KEY,                    -- PRIMARY KEY -> id del usuarios
  inss VARCHAR(12) NOT NULL,                        -- inss del usuario
  nombre VARCHAR(25) NOT NULL,                      -- nombre del usuario
  apellidos VARCHAR(30) NOT NULL,                   -- apellidos del usuario
  cod_fac VARCHAR(10) NOT NULL,                     -- identificador de facultad
  cargo VARCHAR(15) NOT NULL,                       -- cargo del usuario
  activo active_type NOT NULL DEFAULT 'activo',     -- estado actividad del usuario
  eliminado delete_type NOT NULL DEFAULT 'no',      -- estado de eliminación del usuario
  fecha_creacion DATE NOT NULL,                     -- fecha de creacion del registro
  id_menu SERIAL NOT NULL                           -- FORAIGN KEY -> menús
);

-- menu
CREATE TABLE menus (
  id_menu SERIAL NOT NULL PRIMARY KEY,              -- PRIMARY KEY -> id del menú
  nombre VARCHAR(25) NOT NULL,                      -- nombre del menú
  tipo_menu INT NOT NULL UNIQUE,                    -- tipo de menú
  activo active_type NOT NULL DEFAULT 'activo',     -- estado actividad del menú
  eliminado delete_type NOT NULL DEFAULT 'no',      -- estado de eliminación del menú
  fecha_registro DATE NOT NULL CURRENT_DATE,        -- fecha del registro
  modulos INT[] NOT NULL                            -- FORAIGN KEY -> modulos
);

-- modulos
CREATE TABLE modulos (
  modulos SERIAL NOT NULL PRIMARY KEY,              -- PRIMARY KEY -> id del módulo
  nombre VARCHAR(25) NOT NULL UNIQUE                -- nombre del módulo
  direccion VARCHAR(125) NOT NULL UNIQUE            -- nombre del módulo
);

-- usuarios
CREATE TABLE usuarios (
  cod_usuario SERIAL NOT NULL PRIMARY KEY,          -- PRIMARY KEY -> id del usuario
  nombre VARCHAR(50) NOT NULL,                      -- nombre del usuario
  clave VARCHAR(15) NOT NULL,                       -- clabe del usuario
  cod_fac VARCHAR(10) NOT NULL,                     -- identificador de facultad
  fecha_creacion DATE NOT NULL,                     -- fecha de creacion del usuario
  usuario_creador VARCHAR(25) NOT NULL,             -- nombre del usuario creador
  activo active_type NOT NULL DEFAULT 'activo',     -- estado actividad del menú
  tipo_menu VARCHAR(15) NOT NULL                    -- FORAIGN KEY -> menús
);

-- create a FOREIGN KEYS
ALTER TABLE registro_usuarios
ADD CONSTRAINT registro_menus
FOREIGN KEY (id_menu)
REFERENCES menus (id_menu);

ALTER TABLE menus
ADD CONSTRAINT menus_modulos
FOREIGN KEY (modulos)
REFERENCES modulos (modulos);

ALTER TABLE usuarios
ADD CONSTRAINT usuarios_menus
FOREIGN KEY (tipo_menu)
REFERENCES menus (tipo_menu);


