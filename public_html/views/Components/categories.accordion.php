<?php

use App\Models\Classification;
?>

<div class="accordion accordion-flush" id="categories-accordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="categories-flush-heading">
            <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#categories-flush-collapse" aria-expanded="true" aria-controls="categories-flush-collapse">
                Categorías
            </span>
        </h2>
        <div id="categories-flush-collapse" class="accordion-collapse collapse" aria-labelledby="categories-flush-heading" data-bs-parent="#categories-accordion">
            <div class="accordion-body">
                <ul>
                    <?php foreach ($classifications as $classification) : ?>
                        <?php $category_id = $classification->getId(); ?>
                        <div class="accordion accordion-flush" id="category-<?= $category_id ?>">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="category-flush-heading-<?= $category_id ?>">
                                    <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#category-flush-collapse-<?= $category_id ?>" aria-expanded="true" aria-controls="category-flush-collapse-<?= $category_id ?>">
                                        <?= $classification->getName() ?>
                                    </span>
                                </h2>
                                <div id="category-flush-collapse-<?= $category_id ?>" class="accordion-collapse collapse" aria-labelledby="category-flush-heading-<?= $category_id ?>" data-bs-parent="#category-<?= $category_id ?>">
                                    <div class="accordion-body">
                                        <ul>
                                            <?php foreach ($sub_classifications as $sub_classification) : ?>
                                                <?php $related_sub_classifications = Classification::subBelongsToClassification($sub_classification->getSubClassification(), $classification->getName()) ?>
                                                <?php foreach ($related_sub_classifications as $related_sub_classification) : ?>
                                                    <li>
                                                        <a href="<?= APP_URL . 'classification/show/' . $sub_classification->getId() ?>"><?= $sub_classification->getSubClassification() ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>