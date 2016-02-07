<?
use frontend\components\Common;
use yii\helpers\Url;
?>
        <div class="hot-properties hidden-xs">
            <h4>Hot Properties</h4>
            <? foreach($model as $row): ?>
            <div class="row">
                <div class="col-lg-4 col-sm-5"><img src="<?=Common::getImageAdvert($row)[0] ?>"  class="img-responsive img-circle" alt="properties"/></div>
                <div class="col-lg-8 col-sm-7">
                    <h5><a href="<?=Url::to(['/main/main/view-advert', 'id' => $row['idadvert']]) ?>" ><?=Common::getTitleAdvert($row); ?></a></h5>
                    <p class="price">$<?=$row['price'] ?></p> </div>
            </div>
            <? endforeach; ?>

        </div>