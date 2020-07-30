<?php
namespace backend\controllers;

use Yii;
use common\components\CController;
use backend\models\Banner;
use backend\models\BannerSearch;
use backend\models\CategoryUploadForm;
use yii\web\UploadedFile;


/**
 * Home controller
 */
class CategoryGroupController extends CController
{
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Banner();
        $modelUploadFrom = new CategoryUploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                $this->checkFolder('banner');
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/banner/' .$fielname);
                $model->banner_image_path = '/upload/banner/'.$fielname;
                $model->save(false);
            }
           
            return $this->redirect(['index']);
        }
        return $this->render('form', [
            'model' => $model,
            'modelFrom'=> $modelUploadFrom
        ]);

    }
    public function actionUpdate($id)
    {
        $model = Banner::findOne($id);
        $modelUploadFrom = new CategoryUploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                $this->checkFolder('banner');
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/banner/' .$fielname);
                $model->banner_image_path = '/upload/banner/'.$fielname;
                $model->save(false);
            }
            return $this->redirect(['index']);
        }
        return $this->render('form', [
            'model' => $model,
            'modelFrom'=> $modelUploadFrom

        ]);

    }

    public function actionDelete($id)
    {
        Banner::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionStatus()
    {
        $request = Yii::$app->request->get();
        $model = Banner::findOne($request['id']);
        $model->banner_status = $request['status'];
        $model->save(false);
       return $this->asJson(['status' => 200, 'msg' => ($model->category_status == 0 ? 'Deactive Successfull' :'Activate Successfull')]);
    }


   
}
