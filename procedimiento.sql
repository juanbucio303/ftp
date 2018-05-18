DELIMITER $$
CREATE PROCEDURE registro (
    IN nombre VARCHAR(50),
    IN contra VARCHAR(255))
BEGIN
DECLARE id_aux INT;
	INSERT INTO usuarios(id_usuario,nombre_usuario,contra,estado,id_tipo_usuario,id_directorio) VALUES(null,nombre,contra,1,2,null);
    SELECT id_usuario INTO id_aux FROM usuarios WHERE id_usuario= (SELECT MAX(id_usuario) FROM usuarios);
    INSERT INTO directorios(id_directorio,nombre_directorio) VALUES(id_aux,nombre);
    UPDATE usuarios SET id_directorio=id_aux WHERE id_usuario=id_aux;
    INSERT INTO permisos(id_permisos,id_usuario,id_tipo_permiso,estado) VALUES (null,id_aux,1,1);
    INSERT INTO permisos(id_permisos,id_usuario,id_tipo_permiso,estado) VALUES (null,id_aux,2,1);
 END $$
