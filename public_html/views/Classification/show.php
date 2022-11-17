<?php

use App\Helpers\View;

define('HEADER_TITLE', $classification_selected->getName() . ' - ' . $classification_selected->getSubClassification());
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1 class="display-2">Ligth Agency Computer</h1>

    <hr>

    <?php include View::component('categories.accordion') ?>

    <div class="row">
        <div class="col-sm-12 gap-3 my-4">
            <h2>Productos destacados - <?= $classification_selected->getName() . '/' . $classification_selected->getSubClassification(); ?></h2>
            <div class="row">
                <?php if (count($products) === 0) : ?>
                    <h3 class="text-muted">No se encontraron productos</h3>
                <?php else : ?>
                    <?php foreach ($products as $product) : ?>
                        <?php include View::component('product.card') ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php
include View::layout('tail.layout');
?>