CREATE VIEW vista_panel_asistencia_diaria AS
SELECT 
    e.num_doc_estu AS documento,
    e.tipo_doc_estu AS tipo_documento,
    CONCAT_WS(' ', e.apellido, e.segundo_apellido, e.nombre, e.segundo_nombre) AS estudiante,
    c.nombre AS curso,
    p.nombre AS parada,
    r.nombre AS ruta,
    CONCAT_WS(' ', acu.nombre_acu, acu.apellido_acu) AS acudiente_principal,
    par.nombre AS parentesco_acudiente,
    asis_ida.hora AS hora_ida,
    asis_regreso.hora AS hora_regreso
FROM estudiante e
INNER JOIN curso c ON e.fk_id_curso = c.id_curso
INNER JOIN parada p ON e.fk_id_parada = p.id_parada
INNER JOIN ruta r ON p.fk_id_ruta = r.id_ruta
LEFT JOIN acudiente_estudiante ae 
    ON e.num_doc_estu = ae.fk_num_doc_estu AND ae.tipo_acudiente = 'PRINCIPAL'
LEFT JOIN acudiente acu 
    ON ae.fk_num_doc_acu = acu.num_doc_acu
LEFT JOIN parentesco par 
    ON ae.fk_id_parentesco = par.id_parentesco
LEFT JOIN (
    SELECT a.fk_num_doc_estu, a.hora
    FROM asistencia a
    INNER JOIN jornada j ON a.fk_jornada = j.id_jornada
    WHERE j.tipo_recorrido = 'IDA' AND j.fecha = CURRENT_DATE
) asis_ida ON e.num_doc_estu = asis_ida.fk_num_doc_estu
LEFT JOIN (
    SELECT a.fk_num_doc_estu, a.hora
    FROM asistencia a
    INNER JOIN jornada j ON a.fk_jornada = j.id_jornada
    WHERE j.tipo_recorrido = 'REGRESO' AND j.fecha = CURRENT_DATE
) asis_regreso ON e.num_doc_estu = asis_regreso.fk_num_doc_estu;
