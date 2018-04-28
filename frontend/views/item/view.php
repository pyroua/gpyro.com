<?php

use frontend\widgets\CategoriesList;
use dvizh\cart\widgets\BuyButton;
use dvizh\cart\widgets\ChangeCount;

/** @var \common\models\Item $item */

$this->params['breadcrumbs'][] = [
    'label' => $item->title,
];

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?= CategoriesList::widget() ?>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="<?= $item->logoWebPath; ?>" alt=""/>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <h2><?= $item->title; ?></h2>
                            <p><?= $item->article; ?></p>
                            <img src="images/product-details/rating.png" alt=""/>
                            <span>
									<span>$<?= $item->price ?></span>
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <label>Quantity:</label>

                                    <?= ChangeCount::widget(['model' => $item, 'showArrows' => false]); ?>

                                    <?= BuyButton::widget([
                                        'model' => $item,
                                        'text' => '<i class="fa fa-shopping-cart"></i>Add to cart',
                                        'htmlTag' => 'button',
                                        'cssClass' => 'btn btn-fefault cart'
                                    ]) ?>
                                <?php endif; ?>
								</span>
                            <?php
                            foreach ($item->itemOptionValues as $optionValue): ?>
                                <p>
                                    <b><?= $optionValue->itemOption->title; ?>: </b>
                                    <?= $optionValue->value ?>
                                </p>
                            <?php endforeach; ?>

                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <?php if ($item->youtubeEmbedUrl) {?>
                    <iframe width="640" height="480" src="<?=$item->youtubeEmbedUrl?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <?php }?>

            </div>
        </div>
    </div>
</section>