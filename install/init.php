<?php

require('Database.php');
require('Log.php');

$config_file = __DIR__ . '/config.ini';
$config = parse_ini_file($config_file, true);

$config_db = $config['DB'];

$product_data = json_decode(file_get_contents('test_data/data.json'), true);
$specs = $product_data['specs'];
$brand = $product_data['brand'];
$models = $product_data['models'];

$lorem_data = file_get_contents('test_data/lorem.txt');

$db = new Database($config_db['HOST'], $config_db['DATABASE'], $config_db['USER'], $config_db['PASSWORD'], $config_db['CHARSET']);
$log = new Log();

$products_iteration = $products_inserctions = 0;
$comments_iteration = $comments_inserctions = 0;
$clasification_iteration = $clasification_inserctions = 0;

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

while ($products_iteration < 200) {
  $specs_of_product = "{$specs[rand(0, 8)]}<br />{$specs[rand(0, 8)]}<br /{$specs[rand(0, 8)]}";
  $model_of_product = "{$brand[rand(0, 10)]} - {$models[rand(0, 10)]}";
  $price_of_product = rand(10000, 60000);

  try {
    $statement = "INSERT INTO productos (modelo, especificaciones, precio, id_clasificacion) VALUES (:model, :specs, :price, :id_clasification)";
    $query = $db->connect()->prepare($statement);
    $query->execute([
      'model' => $model_of_product,
      'specs' => $specs_of_product,
      'price' => $price_of_product,
      'id_clasification' => 1,
    ]);

    $products_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }

  $products_iteration++;
}
$log->writeLog("Productos insertados: $products_inserctions");

while ($comments_iteration < 1000) {
  $text_of_comment = substr($lorem_data, rand(0, 500), rand(500, 1000));
  $rate_of_comment = rand(0, 10);

  try {
    $statement = "INSERT INTO comentarios (texto, nombre, calificacion, id_producto) VALUES (:text, :name, :rate, :id_product)";
    $query = $db->connect()->prepare($statement);
    $query->execute([
      'text' => $text_of_comment,
      'name' => 'Nombre de usuario',
      'rate' => $rate_of_comment,
      'id_product' => rand(1, 200),
    ]);

    $comments_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }

  $comments_iteration++;
}
$log->writeLog("Comentarios insertados: $comments_inserctions");
