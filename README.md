# practica2-UD3-AD
---
## Descripción del problema
Una escuela de formación profesional, requiere de un sistema para la gestión para llevar el seguimiento de los diferentes proyectos académicos finales de los alumnos. Este sistema debe organizar y administrar la información relacionada con los proyectos , los alumnos que lo realizan, el profesor o profesores que supervisan el proyecto y las miembros evaluadores que lo califican. El sistema permitira llevar un control detallado de los trabajos que realice un determinado alumno durante sus estudios, además de facilitar la consulta y generación de reportes. El sistema debe cumplir las siguentes funcionalidades:

- Gestión de proyectos: cada proyecto cuenta con un título, una descripción, autor o auto, una fecha de inicio y una de límite de entrega, ademas de tener una calificación final que es el promedio calculado en base a las notas asignadas por los profesores evaluadores. En un mismo proyecto pueden participar uno o más alumnos, quienes estarán asociados al proyecto como sus autores. También la comisión evaluadora puede ser de uno o más profesores.
- Gestión de alumnos: los alumnos estan registrados por su nombre, apellido, email, curso, especialidad y el DNI. Un Alumno puede participar en multiples proyectos, como ser supervisado por uno o más profesores.
- Gestión de profesores:los profesores estan registrados por su nombre, apellido, email, año de incorporación y la especialidad. Un profesor puede supervisar multiples proyecto como Tutor principal o Co-tutor.
- Supervision: el sistema de gestión permitirá llevar seguimiento de los proyectos, enlazando que profesor o profesores supervisan un proyecto que pertenece a uno o más alumnos. El profesor puede ser un tutor principal o cotutor, tambien es importante registrar la fecha de asignación.
- Evaluación: Cada proyecto es evaluado por uno o más profesores que no necesariamente seran los tutores. Donde se registra la calificación numérica del 0 al 10, fecha de evaluación y comentarios si fuese necesarior.
- Tipo de proyecto: los proyectos estarán categorizados en tipos predefinidos como tesis, informes técnicos, proyectos finales de curso (PFC), seminarios, entre otros. Todo proyecto se categoriza en un tipo de proyecto.
- Especialidades: cada alumno debe pertenecer a una especialidad, sera posible consultar que o cuantos proyectos hay por especialidad. Se almacena el nombre y descripcion.

## Diagrama ER

![Diagrama ER](practica.png)

  
