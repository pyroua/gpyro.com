<?php

namespace frontend\widgets;

use yii\bootstrap\Widget;

class ItemView extends Widget
{
    public $item;

    public function run()
    {
        return $this->render('item-view', ['item' => $this->item]);
    }

} 