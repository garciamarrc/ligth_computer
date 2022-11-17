<div class="col-sm-12 col-lg-4 mx-auto my-2">
    <div class="card">
        <img src="<?= APP_URL ?>public_html/assets/img/ligth-logo.png" class="card-img-top" alt="..." />
        <div class="card-body">
            <h5 class="card-title"><?= $product->getModel(); ?></h5>
            <p class="card-text text-muted"><?= substr($product->getSpecs(), 0, 59); ?>...</p>
            <p class="card-text"><strong>$<?= number_format($product->getPrice(), 2); ?></strong></p>
            <a href="<?= APP_URL . 'product/show/' . $product->getId(); ?>" class="btn btn-primary">Visitar producto</a>
        </div>
    </div>
</div>