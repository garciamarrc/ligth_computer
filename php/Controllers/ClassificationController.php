<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Classification;
use App\Models\Product;

class ClassificationController
{
    public function show(int $id)
    {
        $products = Product::readQuery("SELECT * FROM productos WHERE id_clasificacion = '$id' ORDER BY RAND() LIMIT 10");

        $classification = Classification::readQuery("SELECT * FROM clasificacion WHERE id = '$id'")[0];

        include View::view('Classification/show');
    }
}