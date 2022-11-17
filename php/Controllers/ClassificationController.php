<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Classification;
use App\Models\Product;

class ClassificationController
{
    public function show(int $id)
    {
        $classifications = Classification::readQuery("SELECT * FROM clasificacion GROUP BY nombre");

        $sub_classifications = Classification::readQuery("SELECT * FROM clasificacion");

        $products = Product::readQuery("SELECT * FROM productos WHERE id_clasificacion = '$id' ORDER BY RAND() LIMIT 10");

        $classification_selected = Classification::readQuery("SELECT * FROM clasificacion WHERE id = '$id'")[0];

        if (!$classification_selected) header("Location: " . APP_URL . "error/notFound");

        include View::view('Classification/show');
    }
}