<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expense */

$this->title = Yii::t('app', 'Add Income Details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?><div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?= Html::a('Home', ['/site/dashboard']) ?> /</span>
  <span class="text-muted fw-light"><?= Html::a('Income', ['/income/index']) ?> /</span>

  <?= Html::encode($this->title) ?></h4>

<?= $this->render('_form', [
  'model' => $model,
  'catagories' => $catagories
]) ?>
</div>
<!-- / Content -->