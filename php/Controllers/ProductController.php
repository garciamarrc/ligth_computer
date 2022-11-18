<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Classification;
use App\Models\Comment;
use App\Models\Product;

class ProductController
{
    public function search()
    {
        if (!$_POST['param']) header("Location: " . APP_URL . "error/notFound");

        $param = $_POST['param'];

        $products = Product::readQuery("SELECT * FROM productos WHERE modelo LIKE '%$param%'");

        include View::view('Product/search');
    }

    public function show(int $id)
    {
        $classifications = Classification::readQuery("SELECT * FROM clasificacion GROUP BY nombre");

        $sub_classifications = Classification::readQuery("SELECT * FROM clasificacion");

        $product = Product::find($id);

        if (!$product) header("Location: " . APP_URL . "error/notFound");

        $product->setViews($product->getViews() + 1);
        $product->update();

        $comments = Comment::readQuery("SELECT * FROM comentarios WHERE id_producto = '$id' ORDER BY calificacion DESC");

        include View::view('Product/show');
    }
}
