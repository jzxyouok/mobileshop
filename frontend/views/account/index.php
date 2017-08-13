<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
?>
				<div class="col-lg-9">
					<div class="widget wid-categories">
						<div class="heading"><h4>My Account</h4></div>
						<div class="content">
							<ul>
								<li>First Name : <?= $model->first_name?></li>
								<li>Last Name : <?= $model->last_name?></li>
								<li>Email : <?= $model->email?></li>
								<li>Phone : <?= $model->mobile?></li>
								<li>Gender : <?= $model->gender == 1 ? 'Male' : 'Female'?></li>
							</ul>
						</div>
					</div>
				</div>
