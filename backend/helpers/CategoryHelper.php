<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 31.07.17
 * Time: 11:12
 */

namespace backend\helpers;

use common\models\Category;
use  yii\helpers\Url;
use Yii;

class CategoryHelper
{

    /**
     * @param Category[] $categories
     * @return array
     */
    public static function buildCatTree(array $categories, $showButtons = true)
    {
        $result = [];

        // build 0 level
        foreach ($categories as $k => $cat) {
            if ($cat->parent == 0) {
                $result[] = [
                    'id' => $cat->id,
                    'text' => '<span class="cat-title">' . $cat->title . '</span>' . ($showButtons ? self::getCatTreeButtons($cat->id) : ''),
                    'nodes' => []
                ];

                unset($categories[$k]);
            }
        }

        // build other levels
        foreach ($result as $k => $val) {
            self::processCatLevel($result[$k], $categories, $showButtons);
        }

        return $result;
    }

    /**
     * @param $cat
     * @param $data
     */
    private static function processCatLevel(&$cat, &$data, &$showButtons = true)
    {
        foreach ($data as $k => $val) {
            if ($val->parent == $cat['id']) {
                $cat['nodes'][] = [
                    'id' => $val->id,
                    'text' => '<span class="cat-title">' . $val->title . '</span>' . ($showButtons ? self::getCatTreeButtons($val->id) : ''),
                    'nodes' => []
                ];

                unset($data[$k]);
            }
        }

        foreach ($cat['nodes'] as $k => $val) {
            self::processCatLevel($cat['nodes'][$k], $data, $showButtons);
        }
    }

    /**
     * @param int $id
     * @return string
     */
    private static function getCatTreeButtons($id)
    {
        return Yii::$app->view->render('/categories/_tree_buttons', [
            'id' => $id,
            'editUrl' => Url::to(["categories/update/" . $id]),
            'deleteUrl' => Url::to(["categories/delete/" . $id])
        ]);
    }
}