-- table = menus

-- RENAME
--- COLUMN
ALTER TABLE menus RENAME COLUMN id_modulo TO modulos;

-- ADD
--- COLUMNS
---- ARRAY[]
ALTER TABLE menus ADD COLUMN modulos INT[];
---- others
ALTER TABLE modulos ADD COLUMN direccion varchar(125);

--- MODIFY DATA TYPE
ALTER TABLE usuarios ALTER COLUMN tipo_menu SET DATA TYPE INT USING tipo_menu::int;
ALTER TABLE menus ALTER COLUMN tipo_menu SET DATA TYPE INT USING tipo_menu::int;

-- SET
--- DATA TYPE
ALTER TABLE menus ALTER COLUMN fecha_registro SET DEFAULT CURRENT_DATE;

-- UPDATE
--- DATA to DATA
---- column to column
UPDATE menus SET modulos = modulo:int[];

-- DROP
--- CONSTRAINT
ALTER TABLE usuarios DROP CONSTRAINT usuario_menus;
--- DEFAULT
ALTER TABLE menus ALTER COLUMN modulos DROP DEFAULT;
--- COLUMN
ALTER TABLE menus DROP COLUMN modulo;

-- DELETE
--- TABLE DATA
TRUNCATE modulos CASCADE;
TRUNCATE registro_usuarios CASCADE;
TRUNCATE usuarios CASCADE;
TRUNCATE menus CASCADE;

-- Access to server
psql -h pgsql -p 5432 -U postgres -w registro_u
