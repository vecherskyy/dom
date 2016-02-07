<?
use yii\bootstrap\Html;
use app\widgets\HotWidget;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use frontend\components\Common;
?>
<div class="properties-listing spacer">

    <div class="row">
        <div class="col-lg-3 col-sm-4 ">
            <?= Html::beginForm(Url::to('main/main/find'), 'get'); ?>

            <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
                <!--<input type="text" class="form-control" placeholder="Search of Properties">-->
                <?= Html::textInput('search', '', ['class' => 'form-control', 'placeholder' => 'Search of Properties']) ?>
                <div class="row">
                    <div class="col-lg-5">
                        <select class="form-control">
                            <option>Buy</option>
                            <option>Rent</option>
                            <option>Sale</option>
                        </select>
                    </div>
                    <div class="col-lg-7">
                        <?= Html::dropDownList('price', '', [
                            '150000-200000' => '$150,000 - $200,000',
                            '200000-250000' => '$200,000 - $250,000',
                            '250000-300000' => '$250,000 - $300,000',
                            '300000' => '$300,000 - above',
                        ], ['class' => 'form-control', 'prompt' => 'Price']
                        ); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?= Html::dropDownList('apartment', '', [
                            'Apartment' => 'Apartment',
                            'Building' => 'Building',
                            'Office Space' => 'Office Space',
                        ], ['class' => 'form-control', 'prompt' => 'Property']
                        ); ?>
                    </div>
                </div>
                <?= Html::submitButton('Find Now', ['class' => 'btn btn-primary']); ?>
                <?=Html::endForm(); ?>

            </div>


            <?=HotWidget::widget();  ?>


        </div>

        <div class="col-lg-9 col-sm-8">
            <div class="sortby clearfix">
                <div class="pull-left result">Showing: 12 of 100 </div>
                <div class="pull-right">
                    <select class="form-control">
                        <option>Sort by</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select></div>

            </div>
            <div class="row">

                <? foreach($model as $row): ?>
                <!-- properties -->
                <div class="col-lg-4 col-sm-6">
                    <div class="properties">
                        <div class="image-holder"><img src="<?=Common::getImageAdvert($row)[0] ?>"  class="img-responsive" alt="properties">
                            <div class="status sold"><?=($row['sold']) ? 'sold' : 'new' ?></div>
                        </div>
                        <h4><a href="<?=Url::to(['/main/main/view-advert', 'id' => $row['idadvert']]) ?>" ><?=Common::getTitleAdvert($row); ?></a></h4>
                        <p class="price">Price: $<?=$row['price'] ?></p>
                        <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?=$row['bedroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?=$row['livingroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?=$row['parking'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?=$row['kitchen'] ?></span> </div>
                        <a class="btn btn-primary" href="<?=Url::to(['/main/main/view-advert', 'id' => $row['idadvert']]) ?>" >View Details</a>
                    </div>
                </div>
                <!-- properties -->
                <? endforeach; ?>

                <div class="clearfix"></div>
                <div class="center">
                    <?=LinkPager::widget([
                        'pagination' => $pages,
                    ]) ?>
                </div>

            </div>
        </div>
    </div>
</div>
