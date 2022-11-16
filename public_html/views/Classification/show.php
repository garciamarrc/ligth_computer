<?php

use App\Helpers\View;

define('HEADER_TITLE', $classification->getName() . ' - ' . $classification->getSubClassification());
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1 class="display-2">Ligth Agency Computer</h1>

    <hr>

    <div class="row gap-3 my-4">
        <h2>Productos destacados - <?= $classification->getName() . '/' . $classification->getSubClassification(); ?></h2>
        <?php if (count($products) === 0) : ?>
            <h3 class="text-muted">No se encontraron productos</h3>
        <?php else : ?>
            <?php foreach ($products as $product) : ?>
                <div class="col-sm-12 col-md-4 col-lg-4 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><?= $product->getModel(); ?></h3>
                            <p class="card-text text-muted"><?= $product->getSpecs(); ?></p>
                            <p class="card-text"><strong>$<?= number_format($product->getPrice(), 2); ?></strong></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<?php
include View::layout('tail.layout');
?>