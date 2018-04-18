<?php
use frontend\widgets\CategoriesList;

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
                            <img src="<?=$item->logoWebPath;?>" alt="" />
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <h2><?=$item->title;?></h2>
                            <p><?=$item->article;?></p>
                            <img src="images/product-details/rating.png" alt="" />
                            <span>
									<span>$<?=$item->price?></span>
									<label>Quantity:</label>
									<input type="text" value="1" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
                            <?php foreach ($itemOptions as $option): ?>
                            <p><b><?php echo \common\models\ItemOption::getById($option->option_id)->title;?>: </b> <?=$option->string?></p>
                            <?php endforeach; ?>
                            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>