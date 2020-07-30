<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\components\CController;


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
        return $this->render('index');
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
