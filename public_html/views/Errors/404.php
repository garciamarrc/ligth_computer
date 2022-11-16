<?php

use App\Helpers\View;

define('HEADER_TITLE', '404');
include View::layout('header.layout');
?>
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="display-1 fw-bold">404</h1>
        <p class="fs-3"> <span class="text-danger">Opps!</span> Página no encontrada.</p>
        <p class="lead">
            La página que buscas no existe.
        </p>
        <a href="<?= APP_URL ?>" class="btn btn-primary">Volver a Home</a>
    </div>
</div>
<?php
include View::layout('tail.layout');
?>