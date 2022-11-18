<?php

namespace App\Controllers;

use App\Models\Classification;
use App\Helpers\View;
use App\Models\Product;

class HomeController
{
  public function index(int $page_products = 1)
  {
    $offset_products = ($page_products * 10) - 10;

    $classifications = Classification::readQuery("SELECT * FROM clasificacion GROUP BY nombre");

    $sub_classifications = Classification::readQuery("SELECT * FROM clasificacion");

    $products = Product::readQuery("SELECT * FROM productos ORDER BY likes DESC LIMIT 10 OFFSET $offset_products");

    include View::view('Home/index');
  }
}
