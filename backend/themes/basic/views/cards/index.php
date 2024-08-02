<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cards');
$this->params['breadcrumbs'][] = $this->title;
?>
  
<div class="content-wrapper">
  <div class="row">
    <?php foreach ($cards as $card) {?>
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?= Html::encode($card->name) ?></h4>
            <img src="https://walletplus.in/cards/<?= Html::encode($card->image) ?>" width="100%">
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
  
    
 
  