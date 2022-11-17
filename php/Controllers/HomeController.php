<?php

namespace App\Controllers;

use App\Models\Classification;
use App\Helpers\View;
use App\Models\Product;

class HomeController
{
  public function index()
  {
    $classifications = Classification::readQuery("SELECT * FROM clasificacion GROUP BY nombre");

    $sub_classifications = Classification::readQuery("SELECT * FROM clasificacion");

    $products = Product::readQuery("SELECT * FROM productos ORDER BY RAND() LIMIT 10");

    $most_sell_products_by_sub_category = [];

    foreach($sub_classifications as $sub_classification) {
      $product = Product::readQuery("SELECT * FROM productos WHERE id_clasificacion = '{$sub_classification->getId()}' ORDER BY ventas DESC LIMIT 1")[0];
      array_push($most_sell_products_by_sub_category, $product);
    }

    include View::view('Home/index');
  }

  public function show()
  {
  }
}
