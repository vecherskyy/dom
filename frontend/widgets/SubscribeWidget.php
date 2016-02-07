<?
namespace frontend\widgets;

use yii\bootstrap\Widget;
use common\models\Subscribe;
use frontend\components\Common;

class SubscribeWidget extends Widget
{
    public function run()
    {

        $model = new Subscribe();

        if($model->load(\Yii::$app->request->post()) && $model->save()){

            \Yii::$app->session->setFlash('message','Success subscribe');
            \Yii::$app->controller->redirect("/");
        }

        return $this->render("subscribe", ['model' => $model]);
    }

}