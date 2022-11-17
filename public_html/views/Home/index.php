<?php

use App\Helpers\View;
use App\Models\Product;

define('HEADER_TITLE', 'Home');
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1 class="display-2"><?= APP_NAME ?></h1>

    <hr>

    <?php include View::component('categories.accordion') ?>

    <div class="row">
        <div class="col-sm-12 gap-3 my-4 card p-4">
            <h2>Productos destacados - Página <?= $page_products ?></h2>
            <div class="d-flex justify-content-between">
                <?php if ($page_products > 1) : ?>
                    <a class="btn btn-primary" class="align-self-start" href="<?= APP_URL . 'home/index/' . ($page_products - 1) ?>">Anterior</a>
                <?php else : ?>
                    <span class="btn btn-secondary">Anterior</span>
                <?php endif; ?>
                <?php if (!$products) : ?>
                    <span class="btn btn-secondary">Siguiente</span>
                <?php else : ?>
                    <a class="btn btn-primary" href="<?= APP_URL . 'home/index/' . ($page_products + 1) ?>">Siguiente</a>
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
        <div class="col-sm-12 gap-3 my-4">
            <h2>Top 10 productos más vendidos de cada categoría</h2>
            <div class="row align-items-start">
                <?php
                foreach ($sub_classifications as $sub_classification) {
                    $products = Product::readQuery("SELECT * FROM productos WHERE id_clasificacion = '{$sub_classification->getId()}' ORDER BY ventas DESC LIMIT 10");

                    $classification_title = $sub_classification->getName() . ' - ' . $sub_classification->getSubClassification();

                    $classification_id_html = str_replace(' ', '', $classification_title);

                    echo "<div class='accordion accordion-flush' id='accordion-flush-{$classification_id_html}'>
                    <div class='accordion-item'>
                      <h2 class='accordion-header' id='flush-heading-{$classification_id_html}'>
                        <span class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse-{$classification_id_html}' aria-expanded='true' aria-controls='flush-collapse-{$classification_id_html}'>
                          {$classification_title}
                        </span>
                      </h2>
                      <div id='flush-collapse-{$classification_id_html}' class='accordion-collapse collapse' aria-labelledby='flush-heading-{$classification_id_html}' data-bs-parent='#accordion-flush-{$classification_id_html}'>
                        <div class='accordion-body row'>";

                    foreach ($products as $product) {
                        include View::component('product.card');
                    }

                    echo "</div>
                        </div>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include View::layout('tail.layout');
?>