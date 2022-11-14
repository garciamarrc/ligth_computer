<?php

require('Database.php');
require('Log.php');

$config_file = __DIR__ . '/config.ini';
$config = parse_ini_file($config_file, true);

$config_db = $config['DB'];

$db = new Database($config_db['HOST'], $config_db['DATABASE'], $config_db['USER'], $config_db['PASSWORD'], $config_db['CHARSET']);
$log = new Log();

$products_iteration = $products_inserctions = 0;
$comments_iteration = $comments_inserctions = 0;
$clasification_iteration = $clasification_inserctions = 0;

while ($products_iteration < 10) {
  try {
    $statement = "INSERT INTO productos (modelo, especificaciones, precio, id_clasificacion) VALUES (:model, :specs, :price, :id_clasification)";
    $query = $db->connect()->prepare($statement);
    $query->execute([
      'model' => 'Test',
      'specs' => 'Test specs',
      'price' => 2000,
      'id_clasification' => 1,
    ]);

    $products_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }

  $products_iteration++;
}
$log->writeLog("Productos insertados: $products_inserctions");

while ($comments_iteration < 10) {
  try {
    $statement = "INSERT INTO comentarios (texto, nombre, calificacion, id_producto) VALUES (:text, :name, :rate, :id_product)";
    $query = $db->connect()->prepare($statement);
    $query->execute([
      'text' => 'Test of text',
      'name' => 'Some name',
      'rate' => rand(1, 10),
      'id_product' => 1,
    ]);

    $comments_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }

  $comments_iteration++;
}
$log->writeLog("Comentarios insertados: $comments_inserctions");


while ($clasification_iteration < 10) {
  try {
    $statement = "INSERT INTO clasificacion (nombre, clasificacion_hija) VALUES (:name, :sub_clasification)";
    $query = $db->connect()->prepare($statement);
    $query->execute([
      'name' => 'Some class',
      'sub_clasification' => 'Some subClass'
    ]);

    $clasification_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }

  $clasification_iteration++;
}
$log->writeLog("Clasificaciones insertadas: $clasification_inserctions");
