<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Classification;
use App\Models\Product;

class ClassificationController
{
    public function show(int $id, int $page_products = 1)
    {
        $offset_products = ($page_products * 10) - 10;

        $classifications = Classification::readQuery("SELECT * FROM clasificacion GROUP BY nombre");

        $sub_classifications = Classification::readQuery("SELECT * FROM clasificacion");

        $products = Product::readQuery("SELECT * FROM productos WHERE id_clasificacion = '$id' LIMIT 10 OFFSET $offset_products");

        $most_sell_products = Product::readQuery("SELECT * FROM productos WHERE id_clasificacion = '$id' ORDER BY ventas DESC LIMIT 10");

        $classification_selected = Classification::find($id);

        if (!$classification_selected) header("Location: " . APP_URL . "error/notFound");

        include View::view('Classification/show');
    }
}