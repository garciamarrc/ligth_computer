<div class="col-sm-12 col-lg-4 mx-auto my-2">
    <a href="<?= APP_URL . 'product/show/' . $product->getId(); ?>" style="text-decoration: none;">
    <div class="card">
        <div class="card-body">
                <h3 class="card-title"><?= $product->getModel(); ?></h3>
                <p class="card-text text-muted"><?= substr($product->getSpecs(), 0, 59); ?>...</p>
                <p class="card-text"><strong>$<?= number_format($product->getPrice(), 2); ?></strong></p>
            </div>
        </div>
    </a>
</div>