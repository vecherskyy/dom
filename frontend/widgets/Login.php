<?php


namespace app\widgets;

use common\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Widget;
use yii\web\Response;

class Login extends Widget
{
    public function run()
    {
        $model = new LoginForm();

        if($model->load(\Yii::$app->request->post()) && $model->login()){
            \Yii::$app->controller->redirect(\Yii::$app->controller->goBack());
        }

        return $this->render('login', ['model' => $model]);
    }
}