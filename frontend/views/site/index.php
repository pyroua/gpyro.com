<?php

use frontend\widgets\CategoriesList;
use frontend\widgets\ItemView;

?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?= CategoriesList::widget() ?>
            </div>

            <div class="col-sm-9 padding-right">
                <h1>Welcome to gpyro</h1>

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
    </div>
</section>