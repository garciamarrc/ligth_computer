<?php

require(__DIR__ . '/../vendor/autoload.php');

use App\Models\Classification;
use App\Models\Comment;
use App\Models\Product;

use App\Core\Log;
use Install\Helpers\JSONGetter;

$lorem_data = file_get_contents(__DIR__ . '/test_data/lorem.txt');

$log = new Log();
$jsonGetter = new JSONGetter();

$products_iteration = $products_inserctions = 0;
$comments_iteration = $comments_inserctions = 0;
$classification_iteration = $classification_inserctions = 0;

while ($classification_iteration < 10) {
  $classification_data = $jsonGetter->getClassifications(rand(0, 2));
  $sub_classification_data = $jsonGetter->getSubClassifications($classification_iteration);

  $classification = new Classification($classification_data, $sub_classification_data);

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
  $model = $jsonGetter->getModel(rand(0, 10), rand(0, 10));
  $specs = $jsonGetter->getSpecs();
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
  $rate = rand(0, 5);
  $product_id = Product::getRandom()->getId();
  $name = $jsonGetter->getNames(rand(0, 10));

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
