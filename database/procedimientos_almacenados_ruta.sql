-- Procedimientos almacenados:

DELIMITER //

CREATE PROCEDURE obtener_rol_usuario(
    IN p_id_usuario INT
)
BEGIN
    SELECT
        u.id_usuario,
        CASE
            WHEN a.fk_id_usuario IS NOT NULL
                THEN 'administrador'
            WHEN aux.fk_id_usuario IS NOT NULL
                THEN 'auxiliar'
            ELSE NULL
        END AS rol,
        aux.fk_id_ruta
    FROM usuario u
    LEFT JOIN administrador a
        ON a.fk_id_usuario = u.id_usuario
    LEFT JOIN auxiliar aux
        ON aux.fk_id_usuario = u.id_usuario
    WHERE u.id_usuario = p_id_usuario
    LIMIT 1;
END //

DELIMITER ;
