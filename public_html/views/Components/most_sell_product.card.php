<div class="col-sm-12 col-lg-4 my-4">
    <div class="card">
        <img src="<?= APP_URL ?>public_html/assets/img/ligth-logo.png" class="card-img-top" alt="..." />
        <div class="card-body">
            <h5 class="card-title"><?= $most_sell_products_by_sub_category->getModel(); ?></h5>
            <h5><?= $most_sell_product_title ?></h5>
            <p class="card-text text-muted"><?= substr($most_sell_products_by_sub_category->getSpecs(), 0, 59); ?>...</p>
            <p class="card-text"><strong>$<?= number_format($most_sell_products_by_sub_category->getPrice(), 2); ?></strong></p>
            <a href="<?= APP_URL . 'product/show/' . $most_sell_products_by_sub_category->getId(); ?>" class="btn btn-primary">Visitar producto</a>
        </div>
    </div>
</div>