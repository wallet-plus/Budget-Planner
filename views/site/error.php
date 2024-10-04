<!-- error.php -->
<?php
/* @var $this yii\web\View */
/* @var $exception Exception */

use yii\helpers\Html;

?>
<div class="site-error">
    <h1><?= Html::encode($this->context->action->id) ?></h1>
    <p>
        An error occurred while handling your request.
    </p>
    <p>
        <?= Html::encode($exception->getMessage()) ?>
    </p>
</div>
