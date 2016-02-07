<?php
/**
 * Created by PhpStorm.
 * User: vecherskyy
 * Date: 10.12.15
 * Time: 15:10
 */

namespace app\modules\main\controllers;

use common\models\Advert;
use common\models\LoginForm;
use Yii;
use frontend\models\ContactForm;
use frontend\models\Image;
use frontend\models\SignupForm;
use yii\base\DynamicModel;
use yii\data\Pagination;
use yii\web\Controller;
use frontend\components\Common;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;

class MainController extends Controller
{
    public $layout = "inner";

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        //if($model->load(\Yii::$app->request->post()) && $model->validate())
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('register', ['model' => $model]);

    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if($model->load(\Yii::$app->request->post()) && $model->login()){
            $this->goBack();
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            \Yii::$app->common->sendMail($model->subject, $model->body);
        }
        return $this->render('contact', ['model' => $model]);
    }

    public function actionViewAdvert($id)
    {
        $model = Advert::findOne($id);

        $data = ['name', 'email', 'text'];
        $model_feedback = new DynamicModel($data);
        $model_feedback->addRule('name', 'required');
        $model_feedback->addRule('email', 'required');
        $model_feedback->addRule('text', 'required');
        $model_feedback->addRule('email', 'email');

        if(Yii::$app->request->isPost){
            if($model_feedback->load(Yii::$app->request->post()) && $model_feedback->validate()){
                Yii::$app->common->sendMail('Subject Advert', $model_feedback->text);
            }
        }

        $user = $model->user;

        $images = Common::getImageAdvert($model, false);

        $current_user = ['email' => '', 'username' => ''];
        if(!Yii::$app->user->isGuest){
            $current_user['email'] = Yii::$app->user->identity->email;
            $current_user['username'] = Yii::$app->user->identity->username;
        }

        $coords = str_replace(['(',')'],'',$model->location);
        $coords = explode(',',$coords);

        $coord = new LatLng(['lat' => $coords[0], 'lng' => $coords[1]]);
        $map = new Map([
            'center' => $coord,
            'zoom' => 15,
        ]);

        $marker = new Marker([
            'position' => $coord,
            'title' => Common::getTitleAdvert($model),
        ]);

        $map->addOverlay($marker);

        return $this->render('view_advert', [
           'model' => $model,
            'model_feedback' =>$model_feedback,
            'user' => $user,
            'images' => $images,
            'current_user' => $current_user,
            'map' => $map,
        ]);
    }

    public function actionFind($search='', $price='', $apartment='')
    {
        $this->layout = 'sell';

        $query = Advert::find();
        $query->filterWhere(['like', 'address', $search])
            ->orFilterWhere(['like', 'description', $search])
            ->orFilterWhere(['type' => $apartment]);

        //$query->orFilterWhere(['type'=> $apartment]);

        if($price){
            $prices = explode("-", $price);

            if(isset($prices[0]) && isset($prices[1])){
                $query->andWhere(['between', 'price', $prices[0], $prices[1]]);
            }else{
                $query->andWhere(['>=', 'price', $prices[0]]);
            }

            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $pages->setPageSize(1);

            $model = $query->offset($pages->offset)->limit($pages->limit)->all();

            $request = Yii::$app->request;

            return $this->render('find', [
                'model' => $model,
                'pages' => $pages,
                'request' => $request,
                ]);
        }

    }

}