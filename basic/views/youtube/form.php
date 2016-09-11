<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Html;
$this->title = 'Singer';
?>

    <form class="navbar-form navbar-left" action="/youtube/load" role="search" method="post">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter singer name" name="name">
        </div>
        <button type="submit" class="btn btn-default" name="send">Load</button>
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    </form>
    <a href="/youtube/show" class="navbar-brand">Show TOP</a>

<?php if (isset($exist)):?>
    <div style="position: absolute; margin-top: 50px">
            <p><?=$exist;?></p>
    </div>
<?php endif;?>