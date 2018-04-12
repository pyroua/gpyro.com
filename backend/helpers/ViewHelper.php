<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 31.07.17
 * Time: 11:12
 */

namespace backend\helpers;


class ViewHelper
{

    /**
     * @param $context
     * @param string $controller
     * @param array $actions
     * @return bool
     */
    function isActive($context, string $controller, array $actions)
    {
        if ($context->id == $controller && in_array($context->action->id, $actions)) {
            return true;
        }
    }
}