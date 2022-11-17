<?php

use App\Helpers\View;

define('HEADER_TITLE', "Resultados de: $param");
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1 class="display-2">Tu búsqueda</h1>

    <hr>

    <h2 class="my-4">Resultados de: <?= $param . ' (' . count($products) . ')' ?></h2>

    <div class="row">
        <?php if (count($products) < 1) : ?>
            <h4>No se encontraron resultados.</h4>
        <?php else : ?>
            <?php foreach ($products as $product) : ?>
                <?php include View::component('product.card') ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php
include View::layout('tail.layout');
?>