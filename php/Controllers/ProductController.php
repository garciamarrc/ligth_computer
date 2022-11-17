<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Classification;
use App\Models\Comment;
use App\Models\Product;

class ProductController
{
    public function show(int $id)
    {
        $classifications = Classification::readQuery("SELECT * FROM clasificacion GROUP BY nombre");

        $sub_classifications = Classification::readQuery("SELECT * FROM clasificacion");

        $product = Product::readQuery("SELECT * FROM productos WHERE id = '$id'")[0];

        $comments = Comment::readQuery("SELECT * FROM comentarios WHERE id_producto = '$id' ORDER BY calificacion DESC");

        if (!$product) header("Location: " . APP_URL . "error/notFound");

        include View::view('Product/show');
    }
}
