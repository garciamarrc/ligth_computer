<?php

use App\Helpers\View;

session_start();

define('HEADER_TITLE', $product->getModel());
include View::layout('header.layout');
include View::component('navbar');

?>

<div class="container mt-4">
    <h1 class="display-2"><?= APP_NAME ?></h1>

    <hr>

    <?php include View::component('categories.accordion') ?>

    <h2 class="my-4 display-3"><?= $product->getModel() ?></h2>

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
    const fireBuyAlert = () => {
        Swal.fire({
            title: 'Gran decisión!',
            text: 'Ahora aquí es donde se usaría algún proveedor como Stripe o algo por el estilo para procesar los pagos :)',
            icon: 'info'
        })
    }

    const onStarClick = (id) => {

        const starIcons = document.querySelectorAll('.star-icon-svg')

        starIcons.forEach((starIcon) => {
            starIcon.setAttribute('fill', 'currentColor');
        })

        let i = id;

        while (i > 0) {
            document.getElementById(`star-${i}`).setAttribute('fill', 'yellow');
            i--;
        }

        document.getElementById('rate').value = id;
    }

    const starIcon = (id) => `<svg class='star-icon-svg' onclick="onStarClick('${id}')" id="star-${id}" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>`;

    const starsContainer = document.getElementById('stars-container');

    let i = 0;
    while (i < 5) {
        starsContainer.innerHTML += starIcon(i + 1);
        i++;
    }

    document.getElementById('star-1').setAttribute('fill', 'yellow');
</script>

<?php
include View::layout('tail.layout');
?>
