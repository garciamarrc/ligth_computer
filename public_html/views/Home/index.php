<?php

use App\Helpers\View;

define('HEADER_TITLE', 'Home');
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1>Bienvenido de nuevo!</h1>

    <hr>

    <div class="row gap-3 my-4">
        <h2>Categorías</h2>
        <?php foreach ($classifications as $classification) : ?>
            <div class="col-sm-12 col-md-6 col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?= $classification->getName(); ?></h3>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row gap-3 my-4">
        <h2>Productos destacados</h2>
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
    </div>
</div>
<?php
include View::layout('tail.layout');
?>