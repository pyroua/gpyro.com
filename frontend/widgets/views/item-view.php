<?php

use dvizh\cart\widgets\BuyButton;

/** @var Item $item */

?>

<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <img src="<?=
                $item->logoWebPath ?>" alt=""/>
                <h2>$<?= $item->price ?></h2>
                <p><a href="/item/view/<?= $item->id ?>"><?= $item->title ?></a></p>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?= BuyButton::widget([
                        'model' => $item,
                        'text' => '<i class="fa fa-shopping-cart"></i>Add to cart',
                        'htmlTag' => 'a',
                        'cssClass' => 'btn btn-default add-to-cart'
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
        <!--div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
            </ul>
        </div-->
    </div>
</div>