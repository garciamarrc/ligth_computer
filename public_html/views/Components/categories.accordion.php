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
                                            <?php
                                            $loadedSubClassifications = [];

                                            foreach ($sub_classifications as $sub_classification) {
                                                $related_sub_classification = Classification::subBelongsToClassification($sub_classification->getSubClassification(), $classification->getName());

                                                if (!$related_sub_classification) continue;

                                                if (in_array($related_sub_classification->getId(), $loadedSubClassifications)) continue;

                                                array_push($loaded, $related_sub_classification->getId());

                                                $url = APP_URL . 'classification/show/' . $related_sub_classification->getId();

                                                echo "<li>
                                                        <a href='{$url}'>{$sub_classification->getSubClassification()}</a>
                                                    </li>";
                                            }
                                            ?>
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