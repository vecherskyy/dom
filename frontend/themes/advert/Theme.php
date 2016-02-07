<?php
/**
 * Created by PhpStorm.
 * User: vecherskyy
 * Date: 21.12.15
 * Time: 11:19
 */

namespace frontend\themes\advert;
use Yii;


class Theme extends \yii\base\Theme
{
    public $pathMap = [
        '@frontend/views' => '@frontend/themes/advert/views',
        '@frontend/modules' => '@frontend/themes/advert/modules'
    ];

    public function init()
    {
        parent::init();
    }

}