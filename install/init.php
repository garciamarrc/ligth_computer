<?php

require(__DIR__ . '/../vendor/autoload.php');

use Install\Models\Classification;
use Install\Models\Comment;
use Install\Models\Product;

use Install\Classes\Log;

$product_data = json_decode(file_get_contents(__DIR__ . '/test_data/data.json'), true);
$specs = $product_data['specs'];
$brand = $product_data['brand'];
$models = $product_data['models'];

$lorem_data = file_get_contents(__DIR__ . '/test_data/lorem.txt');

$log = new Log();

$products_iteration = $products_inserctions = 0;
$comments_iteration = $comments_inserctions = 0;
$classification_iteration = $classification_inserctions = 0;

while ($classification_iteration < 10) {
  $classification = new Classification('Some', 'Sub');

  try {
    $classification->save();
    $classification_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }
  $classification_iteration++;
}
$log->writeLog("Clasificaciones insertadas: $classification_inserctions");

while ($products_iteration < 200) {
  $model = "{$brand[rand(0, 10)]} - {$models[rand(0, 10)]}";
  $specs = "{$specs[rand(0, 8)]}<br />{$specs[rand(0, 8)]}<br /{$specs[rand(0, 8)]}";
  $price = rand(10000, 60000);

  try {
    $product = new Product($model, $specs, $price, 1);
    $products_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }
  $products_iteration++;
}
$log->writeLog("Productos insertados: $products_inserctions");

while ($comments_iteration < 1000) {
  $text = substr($lorem_data, rand(0, 500), rand(500, 1000));
  $rate = rand(0, 10);

  $comment = new Comment($text, 'Marco', $rate, 1);

  try {
    $comment->save();
    $comments_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }
  $comments_iteration++;
}
$log->writeLog("Comentarios insertados: $comments_inserctions");
