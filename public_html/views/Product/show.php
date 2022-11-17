<?php

use App\Helpers\View;

define('HEADER_TITLE', $product->getModel());
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container mt-4">
    <h1 class="display-2">Ligth Agency Computer</h1>

    <hr>

    <?php include View::component('categories.accordion') ?>

    <h2 class="my-4 display-3"><?= $product->getModel() ?></h2>

    <div class="row">
        <div class="col-sm-6">
            <div class="row my-4">
                <h4>Especificaciones:</h4>
                <p><?= $product->getSpecs(); ?></p>
            </div>

            <div class="row my-4">
                <h4>Precio: $<?= number_format($product->getPrice(), 2); ?></h4>
            </div>

            <div class="my-4">
                <a href="#">
                    <button class="btn btn-primary">Comprar</button>
                </a>
            </div>
        </div>

        <div class="col-sm-6">
            <h4 class="mb-4">Comentarios</h4>
            <div style="height: 400px; overflow: scroll;">
                <?php
                foreach ($comments as $comment) {
                    $user_photo = file_get_contents(View::icon('user'));

                    $stars = [];

                    while (count($stars) < 5) {
                        array_push($stars, file_get_contents(View::icon('unstar')));
                    }

                    for ($i = 0; $i < $comment->getRate(); $i++) {
                        $stars[$i] = file_get_contents(View::icon('star'));
                    }

                    $stars = implode('', $stars);

                    include View::component('comment.card');
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include View::layout('tail.layout');
?>