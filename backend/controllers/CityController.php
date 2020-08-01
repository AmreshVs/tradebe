<?php
namespace backend\controllers;

use Yii;
use common\components\CController;
use backend\models\City;
use backend\models\CitySearch;



/**
 * Home controller
 */
class CityController extends CController
{
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CitySearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }

    public function actionCreate()
    {
        $model = new City();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->asJson(['status' => 200, 'msg' => 'Saved!']);
        }
        return $this->render('form', ['model' => $model]);

    }
    public function actionUpdate($id)
    {
        $model = City::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('form', ['model' => $model]);

    }

    
    public function actionDelete($id)
    {
        City::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionStatus()
    {
        $request = Yii::$app->request->get();
        $model = City::findOne($request['id']);
        $model->city_status = $request['status'];
        $model->save(false);
       return $this->asJson(['status' => 200, 'msg' => ($model->city_status == 0 ? 'Deactive Successfull' :'Activate Successfull')]);
    }


   
}
