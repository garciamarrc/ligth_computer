<?php

use App\Helpers\View;

define('HEADER_TITLE', 'Home');
include View::layout('header.layout');
include View::component('navbar');
?>

<div class="container">
    <h1>Bienvenido de nuevo!</h1>

    <hr>

    <div class="row gap-3">
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
</div>
<?php
include View::layout('tail.layout');
?>