<?php

use App\Helpers\View;

session_start();

define('HEADER_TITLE', $product->getModel());
include View::layout('header.layout');
include View::component('navbar');

$heart_icon = file_get_contents(View::icon('heart'));

?>

<div class="container mt-4">
    <h1 class="display-2"><?= APP_NAME ?></h1>

    <hr>

    <?php include View::component('categories.accordion') ?>

    <?php
    if ($_SESSION && $_SESSION['message']) {
        $message = $_SESSION['message'];
        echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        <strong>$message</strong>
        </div>";
        $_SESSION['message'] = false;
    }
    ?>

    <h2 class="my-4 display-3"><?= $product->getModel() ?></h2>

    <div>
        <button class="btn" onclick="onLike('<?= $product->getId(); ?>')">
            <p id="total-likes"><?= $product->getLikes() ?></p>
            <?= $heart_icon ?>
        </button>
    </div>


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
                    <button class="btn btn-primary" onclick="fireBuyAlert()">Comprar</button>
                </a>
            </div>
        </div>

        <div class="col-sm-6">
            <h4 class="mb-4">Comentarios</h4>
            <div class="mb-4">
                <form action="<?= APP_URL . 'comment/store/' . $product->getId(); ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Comentario</label>
                        <textarea class="form-control" name="text" id="text" rows="3" required></textarea>
                    </div>

                    <label class="form-label">Calificación</label>
                    <div class="mb-3" id="stars-container">
                    </div>

                    <input type="hidden" name="rate" id="rate" value="1">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Comentar</button>
                    </div>
                </form>
            </div>
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


<script>
    const APP_URL = '<?= APP_URL ?>';
    let totalLikes = <?= $product->getLikes() ?>;
</script>
<script src="<?= APP_URL . '/public_html/assets/js/buy_alert.js' ?>"></script>
<script src="<?= APP_URL . '/public_html/assets/js/comment_stars.js' ?>"></script>
<script src="<?= APP_URL . '/public_html/assets/js/like_product.js' ?>"></script>

<?php
include View::layout('tail.layout');
?>