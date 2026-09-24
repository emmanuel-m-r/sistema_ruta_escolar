# ControlRutaEscolar
Documento de Contexto del Proyecto
Sistema Web para la Gestión de Rutas Escolares
Versión: 1.0 (Documento de contexto inicial)
1. Contexto del proyecto
El proyecto consiste en el desarrollo de un sistema web para la administración de una ruta escolar, cuyo propósito es centralizar la información relacionada con estudiantes, acudientes, conductores, rutas, paradas y asistencias, reemplazando el manejo manual de la información y facilitando la consulta y actualización de los registros.
La institución actualmente realiza gran parte del control operativo mediante registros manuales, lo que dificulta el seguimiento de la asistencia de los estudiantes durante los recorridos, la administración de acudientes y la organización de la información de las rutas.
El sistema busca servir como herramienta de apoyo para el personal encargado del transporte escolar, permitiendo registrar información de manera organizada y mantener un historial de los recorridos realizados.
2. Objetivo general
Desarrollar un sistema web respaldado por una base de datos MySQL que permita administrar de forma eficiente la información de las rutas escolares, incluyendo estudiantes, acudientes, conductores, paradas, usuarios del sistema y el registro de asistencias durante los recorridos.
3. Objetivos específicos
•	Centralizar la información del transporte escolar.
•	Registrar estudiantes junto con su curso y parada asignada.
•	Administrar los acudientes principales y suplentes.
•	Gestionar conductores y rutas.
•	Registrar la asistencia de los estudiantes durante cada recorrido.
•	Restringir el acceso de los usuarios según su tipo.
•	Generar reportes relacionados con la asistencia y las rutas.
4. Contexto del funcionamiento en el colegio
El sistema está pensado para apoyar la operación diaria de la ruta escolar.
Flujo operativo actual
El funcionamiento esperado es el siguiente:
1.	Los estudiantes tienen asignada una parada correspondiente a su vivienda.
2.	Las paradas pertenecen a una ruta específica.
3.	Cada ruta tiene asignado un conductor.
4.	Durante el recorrido, el auxiliar de la ruta (o un administrador) registra qué estudiantes utilizaron el servicio.
5.	La información queda almacenada para consultas y reportes posteriores.
Sentido de los recorridos
Actualmente el sistema contempla registrar la asistencia del estudiante cuando utiliza la ruta.
Pendiente
Se definió que posteriormente se añadirá un campo en la entidad Asistencias para indicar el sentido del recorrido.
Los valores previstos son:
•	Casa → Colegio
•	Colegio → Casa
Esto permitirá diferenciar las asistencias del recorrido de la mañana y del recorrido de regreso.
5. Tecnologías definidas
Componente	Tecnología
Base de datos	MySQL
Backend	PHP
Frontend	HTML, CSS, JavaScript
Futuro	Laravel

6. Modelo de datos definido
El modelo E-R se encuentra prácticamente definido y servirá como base para el modelo relacional.
Entidades principales
•	Estudiante
•	Acudiente
•	Parentesco
•	Curso
•	Ruta
•	Parada
•	Conductor
•	Usuario
•	Administrador
•	Auxiliar
•	Asistencias
•	Acudiente_Estudiante (tabla asociativa)
7. Reglas de negocio
7.1 Estudiantes
•	Cada estudiante pertenece a un único curso.
•	Cada estudiante tiene una única parada asignada.
•	La ruta del estudiante se obtiene mediante la parada.
•	El estudiante normalmente aborda y desciende en la parada correspondiente a su vivienda.
Relaciones
Curso (1) ────< Estudiante (N)

Parada (1) ────< Estudiante (N)
7.2 Acudientes
Cada estudiante tiene exactamente:
•	un acudiente principal;
•	un acudiente suplente.
Reglas adicionales
•	Un acudiente puede representar a muchos estudiantes.
•	Un mismo acudiente puede ser principal para un estudiante y suplente para otro.
•	El parentesco depende de la relación entre acudiente y estudiante.
Relación
Se descartó utilizar dos tablas distintas (Acudiente y Acudiente Suplente) para evitar duplicidad.
Se utiliza una única entidad Acudiente relacionada mediante la tabla asociativa Acudiente_Estudiante.
7.3 Tabla asociativa Acudiente_Estudiante
Esta entidad almacena la relación entre estudiantes y acudientes.
Campos previstos:
•	fk_num_doc_acu
•	fk_num_doc_estu
•	fk_id_parentesco
•	tipo_acudiente
Valores de tipo_acudiente:
•	Principal
•	Suplente
Restricciones previstas
•	PK compuesta (fk_num_doc_acu, fk_num_doc_estu)
•	Un único principal por estudiante.
•	Un único suplente por estudiante.
7.4 Parentesco
Se creó una tabla catálogo para evitar repetir textos.
Ejemplos:
•	Padre
•	Madre
•	Abuelo
•	Abuela
•	Tío
•	Tía
El parentesco pertenece a la relación entre estudiante y acudiente.
7.5 Cursos
•	Un curso puede tener muchos estudiantes.
•	Un estudiante pertenece únicamente a un curso.
Relación:
Curso (1) ———< Estudiante (N)
7.6 Rutas
Reglas definidas:
•	Una ruta transporta muchos estudiantes.
•	Un conductor tiene una única ruta asignada.
•	La ruta queda determinada por las paradas que contiene.
7.7 Paradas
Reglas actuales:
•	Cada parada pertenece a una única ruta.
•	Un estudiante tiene una única parada.
•	La comunidad actualmente se considera asociada a una sola parada.
Atributos actuales
•	id_parada
•	nombre_parada
•	km_referencia
•	comunidad
Mejora pendiente
Agregar:
-	orden_parada
para representar el orden del recorrido.
7.8 Conductores
Reglas:
•	Un conductor tiene una única ruta asignada.
•	No se contempla que un conductor tenga varias rutas simultáneamente.
Relación:
Conductor (1)- - Ruta (1)
8. Usuarios del sistema
El sistema diferencia los tipos de usuario porque cada uno posee funciones distintas.
Administrador
Funciones:
•	Administrar el sistema.
•	Registrar información.
•	Registrar asistencias.
•	Consultar información.
•	Generar reportes.
Auxiliar
Cada auxiliar tiene asignada una única ruta.
Funciones:
•	Registrar asistencias.
•	Consultar estudiantes de su ruta.
•	Consultar asistencias de su ruta.
•	Generar reportes únicamente de su ruta.
La asignación de la ruta se realiza mediante una FK hacia Ruta.
9. Asistencias
La asistencia representa un evento.
Cada registro indica que un estudiante utilizó la ruta en un momento determinado.
Campos actuales
•	id_asistencia
•	estudiante
•	usuario
•	fecha
•	hora_registro
Regla de negocio
•	Un usuario puede registrar muchas asistencias.
•	Cada asistencia pertenece a un único usuario.
•	Tanto el Administrador como el Auxiliar pueden registrar asistencias.
Pendiente
Agregar un campo para indicar el sentido del recorrido.
Opciones previstas:
•	Casa → Colegio
•	Colegio → Casa





10. Relaciones principales del modelo

Relación	Cardinalidad
Curso → Estudiante	1:N
Parada → Estudiante	1:N
Ruta → Parada	1:N
Conductor → Ruta	1:1
Usuario → Asistencia	1:N
Estudiante ↔ Acudiente	N:M
Parentesco → Acudiente_Estudiante	1:N

11. Flujo funcional previsto
Configuración inicial
1.	Registrar conductores.
2.	Registrar rutas.
3.	Registrar paradas.
4.	Registrar cursos.
5.	Registrar usuarios.
6.	Asignar auxiliares a sus rutas.
Registro de estudiantes
Para cada estudiante:
•	registrar estudiante;
•	asignar curso;
•	asignar parada;
•	registrar acudiente principal;
•	registrar acudiente suplente.
Operación diaria
El usuario inicia sesión.
Si es auxiliar:
•	visualiza únicamente la información de su ruta;
•	registra las asistencias correspondientes.
Si es administrador:
•	puede realizar las mismas acciones;
•	además, administra el resto del sistema.
12. Reportes previstos
El sistema deberá permitir generar consultas como:
•	asistencias por estudiante;
•	asistencias por ruta;
•	estudiantes por parada;
•	estudiantes por curso;
•	acudientes asociados a un estudiante;
•	estudiantes representados por un acudiente.
13. Aspectos pendientes de validación con la institución
Estos requisitos permanecen abiertos hasta realizar reuniones con el equipo de trabajo y con la institución educativa.
Comunidad
Confirmar si:
•	una comunidad siempre corresponde a una única parada;
•	o varias paradas pueden pertenecer a una misma comunidad.
Orden del recorrido
Confirmar cómo se administra actualmente el recorrido para definir el uso de orden_parada.
Reportes requeridos
Definir exactamente qué reportes necesitarán los usuarios.
Operación del auxiliar
Confirmar si una ruta siempre tendrá un único auxiliar o si podrán existir reemplazos.
14. Estado actual del proyecto
El proyecto se encuentra en una fase avanzada de diseño conceptual.
Completado
•	Modelo E-R prácticamente definido.
•	Reglas de negocio principales documentadas.
•	Relaciones normalizadas.
•	Estrategia tecnológica definida.
•	Estructura general del sistema establecida.
Próximo paso
Transformar el modelo E-R en el modelo relacional definitivo de MySQL, definiendo:
•	tipos de datos;
•	claves primarias;
•	claves foráneas;
•	restricciones (NOT NULL, UNIQUE, CHECK donde aplique);
•	índices;
•	estructura lista para implementarse en MySQL Workbench o DBeaver.
