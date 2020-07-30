<?php
namespace backend\controllers;

use Yii;
use common\components\CController;
use backend\models\Item;
use backend\models\ItemSpecification;
use backend\models\OrderSearch;
use backend\models\Category;

use common\models\LoginForm;


/**
 * Home controller
 */
class OrderController extends CController
{

   
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }


    public function actionStatus()
    {
        $request = Yii::$app->request->get();
        $model = Item::findOne($request['id']);
        $model->item_status = $request['status'];
        $model->save(false);
       return $this->asJson(['status' => 200, 'msg' => ($model->item_status == 0 ? 'Deactive Successfull' :'Activate Successfull')]);
    }

    


   
}
