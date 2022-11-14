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

/* INICIA INSERCCIÓN DE DATOS */
INSERT INTO
  clasificacion (nombre, clasificacion_hija)
VALUES
  ('Notebooks', 'Para oficina'),
  ('Notebooks', 'Para estudiantes'),
  ('Notebooks', 'Para diseñadores'),
  ('Notebooks', 'Para gamers'),
  ('Notebooks', 'Para programadores'),
  ('Almacenamiento', 'Memoria USB'),
  ('Almacenamiento', 'Disco duro HDD'),
  ('Almacenamiento', 'Disco solido SSD'),
  ('Impresoras', 'Con escaner'),
  ('Impresoras', 'Sin escaner');

INSERT INTO
  productos (
    modelo,
    especificaciones,
    precio,
    id_clasificacion
  )
VALUES
  (
    'Lenovo 15ITL5',
    'Procesador Intel Core i5.',
    15299,
    1
  ),
  (
    'HP 240',
    'Procesador Intel Celeron.',
    6399,
    2
  ),
  (
    'Lenovo 17FS',
    'Procesador Intel Core i9.',
    20599,
    4
  ),
  (
    'Dell 15E',
    'Procesador Intel Core i3.',
    4999,
    2
  ),
  (
    'Kingston',
    'Disco solido SSD con 256GB de almacenamiento',
    3000,
    8
  ),
  (
    'Kingston',
    'Disco duro HDD con 1TB de almacenamiento.',
    2500,
    7
  ),
  (
    'HP JK1',
    'Impresora con escaner',
    7999,
    9
  ),
  (
    'HP LK1',
    'Impresora',
    4999,
    10
  ),
  (
    'Lenovo I32E',
    'Procesador Intel Core i9.',
    25599,
    5
  ),
  (
    'Huawei',
    'Procesador Intel Core i7.',
    13299,
    3
  );

INSERT INTO
  comentarios (texto, nombre, calificacion, id_producto)
VALUES
  (
    'Cumple con su función',
    'Antonio García',
    7.5,
    2
  ),
  (
    'Buena relación calidad-precio',
    'Juan Barragán',
    9,
    2
  ),
  ('Encantado!', 'Luis Morales', 10, 1),
  (
    'Un equipo muy rápido',
    'Rafael Velazques',
    10,
    1
  ),
  (
    'Lo recibí en mal estado. Al final tuve que solicitar un reemplazo',
    'Nora Cortes',
    5,
    8
  ),
  (
    'Imprime con muy buen color',
    'Araceli Herrera',
    9,
    8
  ),
  (
    'El escaner es impresionante por un costo tan bajo',
    'Axel Araiza',
    10,
    7
  ),
  (
    'Me ayuda mucho en mis estudios',
    'Abraham Cortes',
    10,
    2
  ),
  (
    'Justo lo que necesitaba para mis diseños',
    'Daniela Villanueva',
    10,
    10
  ),
  (
    'Un buen equipo para desarrollar',
    'Roberto Chavez',
    9,
    9
  );

/* FINALIZA INSERCCIÓN DE DATOS */
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