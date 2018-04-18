<?php

use yii\helpers\Html;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?php /*?>
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= Yii::$app->urlManagerFrontend->baseUrl?>/storage/img/users/<?=Yii::$app->user->identity->profile->avatar?>" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p><?= Html::encode(Yii::$app->user->identity->profile->firstname)." ".Html::encode(Yii::$app->user->identity->profile->lastname) ?></p>

                    <!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
                </div>
            </div>
        <?php */ ?>

        <!-- search form -->
        <!--form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form-->
        <!-- /.search form -->

        <?= $this->render('menu.php') ?>

    </section>

</aside>
