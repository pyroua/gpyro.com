<?php
use frontend\widgets\CategoriesList;
use dvizh\cart\widgets\BuyButton;
use dvizh\cart\widgets\ChangeCount;

$this->params['breadcrumbs'][] = [
    'label' => 'Thank you',
];

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?= CategoriesList::widget() ?>
            </div>

            <div class="col-sm-9 padding-right">
                <h1>Thank you for order. We will process it as soon as possible</h1>
            </div>
        </div>
    </div>
</section>