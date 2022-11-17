<?php

use App\Helpers\View;

define('HEADER_TITLE', 'Home');
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1 class="display-2"><?= APP_NAME ?></h1>

    <hr>

    <?php include View::component('categories.accordion') ?>

    <div class="row">
        <div class="col-sm-12 gap-3 my-4">
            <h2>Productos destacados</h2>
            <div class="row">
                <?php foreach ($products as $product) : ?>
                    <?php include View::component('product.card') ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 gap-3 my-4">
            <h2>Productos más vendidos de cada clasificación</h2>
            <div class="row align-items-start">
                <?php
                foreach ($most_sell_products_by_sub_category as $most_sell_products_by_sub_category) {
                    $most_sell_product_title;

                    foreach ($sub_classifications as $sub_classification) {
                        if ($sub_classification->getId() === $most_sell_products_by_sub_category->getIdClassification()) {
                            $most_sell_product_title = $sub_classification->getName() . ' - ' . $sub_classification->getSubClassification();
                        }
                    }
                    include View::component('most_sell_product.card');
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include View::layout('tail.layout');
?>