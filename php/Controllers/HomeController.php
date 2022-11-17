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

    include View::view('Home/index');
  }

  public function show()
  {
  }
}
