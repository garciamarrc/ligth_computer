/* CREACIÓN DE TABLAS */
CREATE TABLE productos (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  modelo VARCHAR(255) NOT NULL,
  especificaciones TEXT NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  id_clasificacion BIGINT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE comentarios (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  texto TEXT NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  calificacion DECIMAL(10, 1) NOT NULL,
  id_producto BIGINT NOT NULL,
  CONSTRAINT fk_producto FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE CASCADE,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE clasificacion (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  clasificacion_hija VARCHAR (255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

/* SE AGREGA EL FOREIGN KEY DESPUÉS DE QUE LA REFERENCIA ES CREADA */
ALTER TABLE
  productos
ADD
  CONSTRAINT FOREIGN KEY (id_clasificacion) REFERENCES clasificacion(id) ON DELETE CASCADE;

/* INICIA INSERCCIÓN DE DATOS */
INSERT INTO
  clasificacion (nombre, clasificacion_hija)
VALUES
  ('Notebooks', 'Para economistas'),
  ('Notebooks', 'Para financieros'),
  ('Notebooks', 'Para artistas'),
  ('Notebooks', 'Para profesores'),
  ('Notebooks', 'Para médicos'),
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
    4,
    2
  ),
  (
    'Buena relación calidad-precio',
    'Juan Barragán',
    5,
    2
  ),
  ('Encantado!', 'Luis Morales', 5, 1),
  (
    'Un equipo muy rápido',
    'Rafael Velazques',
    5,
    1
  ),
  (
    'Lo recibí en mal estado. Al final tuve que solicitar un reemplazo',
    'Nora Cortes',
    1,
    8
  ),
  (
    'Imprime con muy buen color',
    'Araceli Herrera',
    4,
    8
  ),
  (
    'El escaner es impresionante por un costo tan bajo',
    'Axel Araiza',
    5,
    7
  ),
  (
    'Me ayuda mucho en mis estudios',
    'Abraham Cortes',
    5,
    2
  ),
  (
    'Justo lo que necesitaba para mis diseños',
    'Daniela Villanueva',
    5,
    10
  ),
  (
    'Un buen equipo para desarrollar',
    'Roberto Chavez',
    4,
    9
  );

/* FINALIZA INSERCCIÓN DE DATOS */
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
  CONSTRAINT fk_clasificacion FOREIGN KEY (id_clasificacion) REFERENCES clasificacion(id),
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

/* SE AGREGA LA COLUMNA VISITAS A LA TABLA PRODUCTOS */
ALTER TABLE
  productos
ADD
  COLUMN visitas INT NOT NULL DEFAULT 0;

/* SE AGREGA LA COLUMNA VENTAS A LA TABLA PRODUCTOS */
ALTER TABLE
  productos
ADD
  COLUMN ventas INT NOT NULL DEFAULT 0;

/* SE AGREGA LA COLUMNA LIKES A LA TABLA PRODUCTOS */
ALTER TABLE
  productos
ADD
  COLUMN likes INT NOT NULL DEFAULT 0;

/* SE CREA PROCEDIMIENTO QUE CALCULA MENSUALIDADES CON INTERES DEL 10% ANUAL.
  RECIBE EL ID DEL PRODUCTO Y LA CANTIDAD DE MESES COMO PARAMETROS*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `calculaPrecioConIntereses`(IN `_producto_id` INT, IN `_meses` INT)
BEGIN
  DECLARE _precio DECIMAL(10, 2);
  DECLARE _interes_por_mes DECIMAL(10, 2);
  DECLARE _interes_por_meses DECIMAL(10, 2);
  DECLARE _precio_total DECIMAL(10, 2);
  
  SELECT precio INTO _precio FROM productos WHERE id = _producto_id;
  SELECT (((_precio / 100) * 10) / 12) INTO _interes_por_mes;
  SELECT (_interes_por_mes * _meses) INTO _interes_por_meses;
  SELECT (_precio + _interes_por_meses) INTO _precio_total;
  SELECT _meses, _precio, _interes_por_mes, _interes_por_meses, _precio_total;
END$$
DELIMITER ;

/* EJEMPLO DE LLAMADA DE PROCEDIMIENTO

  CALL `calculaPrecioConIntereses`(1, 6);

  En este caso calcularía con el precio del producto con ID 1 a un total de 6 meses,

*/