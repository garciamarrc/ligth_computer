<?php

use App\Helpers\View;

define('HEADER_TITLE', 'Home');
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1>Bienvenido de nuevo!</h1>

    <hr>

    <div class="accordion accordion-flush" id="categories-accordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="categories-flush-heading">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#categories-flush-collapse" aria-expanded="true" aria-controls="categories-flush-collapse">
                    Categorías
                </button>
            </h2>
            <div id="categories-flush-collapse" class="accordion-collapse collapse" aria-labelledby="categories-flush-heading" data-bs-parent="#categories-accordion">
                <div class="accordion-body">
                    <ul>
                        <?php foreach ($classifications as $classification) : ?>
                            <li>
                                <span class="btn"><u><?= $classification->getName(); ?></u></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
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