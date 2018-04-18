<?php

use frontend\widgets\CategoriesList;
use frontend\widgets\ItemView;

?>
<?php
$this->params['breadcrumbs'][] = [
    'label' => $current->title,
];

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?= CategoriesList::widget() ?>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <?php foreach ($items as $item) : ?>
                        <?= ItemView::widget(['item' => $item]) ?>
                    <?php endforeach; ?>

                    <?php if (empty($items)) { ?>
                        <div>No items here</div>
                    <?php } ?>
                </div>
            </div>
        </div>
</section>