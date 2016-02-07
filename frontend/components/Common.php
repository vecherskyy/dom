<?
namespace frontend\components;

use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

class Common extends Component
{
    public static function sendMail($subject, $text, $emailFrom='dom@mail.ru',  $nameFrom = 'Advert')
    {
        \Yii::$app->mailer->compose()
     ->setFrom(['vecherskyy@mail.ru' => \Yii::$app->name])
     ->setTo([$email => $name])
     ->setSubject($subject)
     ->setTextBody($body)
     ->send();
    }

    public static function getTitleAdvert($data)
    {
        return $data['bedroom'] . ' Bed Rooms and ' . $data['kitchen'] . ' Kitchen Room Apartment on Sale';
    }

    public static function getImageAdvert($data, $general = true, $original = false)
    {
        $image = [];
        $base = '/';
        if($general){
            $image[] = $base . 'uploads/adverts/' . $data['idadvert'] . '/general/small_' . $data['general_image'];
        }else{
            $path = \Yii::getAlias('@frontend/web/uploads/adverts/' . $data['idadvert']);
            $files = BaseFileHelper::findFiles($path);

            foreach($files as $file){
                if(strstr($file, 'small_') && !strstr($file, 'general')){
                    $image[] = $base . 'uploads/adverts/' . $data['idadvert'] . '/' . basename($file);
                }
            }
        }

        return $image;
     }

    public static function substr($text)
    {
        return substr($text, 0, 50);
    }

    public static function getType($row)
    {
        return ($row['sold']) ? 'Sold' : 'New';
    }
}
?>