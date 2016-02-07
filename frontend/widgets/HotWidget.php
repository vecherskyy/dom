<?php
/**
 * Created by PhpStorm.
 * User: vecherskyy
 * Date: 17.12.15
 * Time: 15:49
 */

namespace app\widgets;


use yii\base\Widget;
//use yii\bootstrap\Widget;
use yii\db\Query;

class HotWidget extends Widget
{
    public function run()
    {
        $query = new Query();
        $model = $query->from('advert')->where('hot=1')->limit(5)->all();
       return $this->render('hotwidget', ['model' => $model]);
    }

}