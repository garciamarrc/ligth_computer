<?php

use App\Helpers\View;

define('HEADER_TITLE', $classification_selected->getName() . ' - ' . $classification_selected->getSubClassification());
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1 class="display-2"><?= $classification_selected->getName() . ' - ' . $classification_selected->getSubClassification(); ?></h1>

    <hr>

    <?php include View::component('categories.accordion') ?>

    <div class="row">
        <div class="col-sm-12 gap-3 my-4 card p-4">
            <h2>Productos destacados - Página <?= $page_products ?></h2>
            <div class="d-flex justify-content-between">
                <?php if ($page_products > 1) : ?>
                    <a class="btn btn-primary" class="align-self-start" href="<?= APP_URL . 'classification/show/' . $id . '/' . ($page_products - 1) ?>">Anterior</a>
                <?php else : ?>
                    <span class="btn btn-secondary">Anterior</span>
                <?php endif; ?>
                <?php if (!$products) : ?>
                    <span class="btn btn-secondary">Siguiente</span>
                <?php else : ?>
                    <a class="btn btn-primary" href="<?= APP_URL . 'classification/show/' . $id . '/' . ($page_products + 1) ?>">Siguiente</a>
                <?php endif; ?>
            </div>
            <div class="row">
                <?php if (!$products) : ?>
                    <h3 class="text-muted my-4">No se encontraron productos</h3>
                <?php else : ?>
                    <?php foreach ($products as $product) : ?>
                        <?php include View::component('product.card') ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 gap-3 my-4 card p-4">
            <h2>Top 10 productos más vendidos de esta categoría</h2>
            <div class="row">
                <?php if (count($most_sell_products) === 0) : ?>
                    <h3 class="text-muted">No se encontraron productos</h3>
                <?php else : ?>
                    <?php foreach ($most_sell_products as $product) : ?>
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