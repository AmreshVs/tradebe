<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\components\CController;
use backend\models\Order;
use backend\models\Vendor;
use common\models\User;
use backend\models\City;






/**
 * Home controller
 */
class HomeController extends CController
{
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //die();
        $orderCount = Order::Find()->count();
        $sellerCount = Vendor::find()->count();
        $userCount = User::find()->count();
        $cityCount = City::find()->count();
        $todayOrders = Order::find()->where(['date(created_at)' => date('Y-m-d')])->all();

        return $this->render('index',[
            'orderCount' => $orderCount,
            'sellerCount' => $sellerCount,
            'userCount' => $userCount,
            'cityCount' => $cityCount,
            'todayOrders' => $todayOrders,


        ]);
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        return $this->render('login');
    }

    public function actionCreate()
    {
        return $this->render('form');
    }

   
}
