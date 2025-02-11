<?php
namespace backend\controllers;

use Yii;
use common\components\CController;
use backend\models\MainCategory;
use backend\models\MainCategorySearch;
use backend\models\CategoryUploadForm;
use yii\web\UploadedFile;


/**
 * Home controller
 */
class MainCategoryController extends CController
{
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MainCategorySearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }

    public function actionCreate()
    {
        $model = new MainCategory();
        $modelUploadFrom = new CategoryUploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           // print_r($_FILES); die;
            $model->save();

            $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                $this->checkFolder('main-category');
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/main-category/' .$fielname);
                $model->main_category_image_path = '/upload/main-category/'.$fielname;
                $model->save(false);
            }
           
            return $this->redirect(['index']);
        }
     return $this->render('form', [
            'model' => $model,
            'modelFrom'=> $modelUploadFrom
        ]);
        
       // return $this->asJson($file);

    }
    public function actionUpdate($id)
    {
        $model = MainCategory::findOne($id);
        $modelUploadFrom = new CategoryUploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                $this->checkFolder('main-category');
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/main-category/' .$fielname);
                $model->main_category_image_path = '/upload/main-category/'.$fielname;
                $model->save(false);
            }
            return $this->redirect(['index']);
        }
       // print_r($model); die;
        return $this->render('form', [
            'model' => $model,
            'modelFrom'=> $modelUploadFrom

        ]);

    }

    public function actionDelete($id)
    {
        MainCategory::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionStatus()
    {
        $request = Yii::$app->request->get();
        $model = MainCategory::findOne($request['id']);
        $model->main_category_status = $request['status'];
        $model->save(false);
       return $this->asJson(['status' => 200, 'msg' => ($model->main_category_status == 0 ? 'Deactive Successfull' :'Activate Successfull')]);
    }


   
}
