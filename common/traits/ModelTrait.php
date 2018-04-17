<?php

namespace common\traits;

trait ModelTrait {

    public function getClassShortName()
    {
        $reflect = new \ReflectionClass($this);
        return $reflect->getShortName();
    }

}