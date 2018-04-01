<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-user-extended
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-user-extended
 * @version 0.5.2
 */

use yii\helpers\Html;

$this->title = \Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

	<?= $this->render(Yii::$app->getModule('userextended')->templateRegister, [
		'model' => $model,
		'module' => $module
	]) ?>

</div>
