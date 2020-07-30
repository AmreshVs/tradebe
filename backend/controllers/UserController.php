<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\components\CController;
use common\models\User;
use backend\models\UserSearch;


/**
 * Home controller
 */
class UserController extends CController
{
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }

    public function actionCreate()
    {
        $model = new User();
        return $this->render('form');

    }

     public function actionStatus()
    {
        $request = Yii::$app->request->get();
        $model = User::findOne($request['id']);
        $model->status = $request['status'];
        $model->save(false);
       return $this->asJson(['status' => 200, 'msg' => ($model->status == 0 ? 'Deactive Successfull' :'Activate Successfull')]);
    }

    

   
}
