<?php
use dvizh\cart\widgets\DeleteButton;
use dvizh\cart\widgets\TruncateButton;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\CartInformer;
use dvizh\cart\widgets\ChangeOptions;
use dvizh\cart\widgets\ElementCost;

use dvizh\order\widgets\OrderForm;

$this->title = yii::t('cart', 'Cart');

$this->params['breadcrumbs'][] = [
    'label' => 'Shopping cart',
];

?>

<section id="cart_items">
    <div class="container">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <?php foreach($elements as $element): ?>
                <tr class="row">
                    <td class="cart_product">
                        <a href=""><img src="<?=$element->getModel()->getCartImage();?>" width="100px" alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href=""><?=$element->getModel()->getCartName();?></a></h4>
                    </td>
                    <td class="cart_price">
                        <p>$<?=$element->getModel()->getCartPrice();?></p>
                    </td>
                    <td class="cart_quantity">
                        <?=ChangeCount::widget(['model' => $element]);?>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">$<?=ElementCost::widget(['model' => $element]);?></p>
                    </td>
                    <td>
                        <div class="col-lg-2 col-xs-2">
                            <?=DeleteButton::widget(['model' => $element, 'lineSelector' => '.row']);?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?=OrderForm::widget(['view' => '@frontend/views/order/orderFormFull']);?>
    </div>
</section> <!--/#cart_items-->