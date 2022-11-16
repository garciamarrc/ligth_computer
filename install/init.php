<?php

require(__DIR__ . '/../vendor/autoload.php');

use App\Models\Classification;
use App\Models\Comment;
use App\Models\Product;

use App\Core\Log;

$product_data = json_decode(file_get_contents(__DIR__ . '/test_data/data.json'), true);
$specs_data = $product_data['specs'];
$brand_data = $product_data['brand'];
$models_data = $product_data['models'];
$names_data = $product_data['names'];
$classifications_data = $product_data['classifications'];
$sub_classifications_data = $product_data['sub_classifications'];

$lorem_data = file_get_contents(__DIR__ . '/test_data/lorem.txt');

$log = new Log();

$products_iteration = $products_inserctions = 0;
$comments_iteration = $comments_inserctions = 0;
$classification_iteration = $classification_inserctions = 0;

while ($classification_iteration < 10) {
  $classification = new Classification($classifications_data[rand(0, 2)], $sub_classifications_data[$classification_iteration]);

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
  $model = "{$brand_data[rand(0, 10)]} - {$models_data[rand(0, 10)]}";
  $specs = "{$specs_data[rand(0, 8)]}<br />{$specs_data[rand(0, 8)]}<br /{$specs_data[rand(0, 8)]}";
  $price = rand(10000, 60000);
  $classification_id = Classification::getRandom()->getId();

  $product = new Product($model, $specs, $price, $classification_id);

  try {
    $product->save();
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
  $product_id = Product::getRandom()->getId();
  $name = $names_data[rand(0, 10)];

  $comment = new Comment($text, $name, $rate, $product_id);

  try {
    $comment->save();
    $comments_inserctions++;
  } catch (\Throwable $th) {
    $log->writeLog($th);
  }
  $comments_iteration++;
}
$log->writeLog("Comentarios insertados: $comments_inserctions");
