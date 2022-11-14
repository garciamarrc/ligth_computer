/* CREACIÓN DE TABLAS */
CREATE TABLE productos (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  modelo VARCHAR(255) NOT NULL,
  especificaciones TEXT NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  id_clasificacion BIGINT NOT NULL
);

CREATE TABLE comentarios (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  texto TEXT NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  calificacion DECIMAL(10, 1) NOT NULL,
  id_producto BIGINT NOT NULL,
  CONSTRAINT fk_producto FOREIGN KEY (id_producto) REFERENCES productos(id)
);

CREATE TABLE clasificacion (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  clasificacion_hija VARCHAR (255) NOT NULL
);

/* SE AGREGA EL FOREIGN KEY DESPUÉS DE QUE LA REFERENCIA ES CREADA */
ALTER TABLE
  productos
ADD
  CONSTRAINT FOREIGN KEY (id_clasificacion) REFERENCES clasificacion(id);

/* SE CREA LA VISTA DE PRODUCTOS CON LOS REQUERIMIENTOS SOLICITADOS */
CREATE VIEW vista_productos AS
SELECT
  p.modelo,
  c.texto,
  (SUM(c.calificacion) / COUNT(c.id)) AS promedio
FROM
  productos p
  INNER JOIN comentarios c ON c.id_producto = p.id
GROUP BY
  (p.id)
ORDER BY
  promedio DESC;

/* SE CREA LA TABLA DE ACCESORIOS ASOCIADA A LA TABLA CLASIFICACION */
CREATE TABLE accesorios (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  especificaciones TEXT NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  id_clasificacion BIGINT NOT NULL,
  CONSTRAINT fk_clasificacion FOREIGN KEY (id_clasificacion) REFERENCES clasificacion(id)
);

/* SE AGREGA LA COLUMNA VISITAS A LA TABLA PRODUCTOS */
ALTER TABLE
  productos
ADD
  COLUMN visitas INT NOT NULL DEFAULT 0;