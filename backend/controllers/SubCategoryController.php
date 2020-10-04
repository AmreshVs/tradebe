<?php
namespace backend\controllers;

use Yii;
use common\components\CController;
use backend\models\Category;
use backend\models\CategorySearch;
use backend\models\SubCategorySearch;
use backend\models\SubCategory;
use backend\models\CategoryUploadForm;
use yii\web\UploadedFile;


/**
 * Home controller
 */
class SubCategoryController extends CController
{
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SubCategorySearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }

    public function actionCreate()
    {
        $model = new SubCategory();
        $modelUploadFrom = new CategoryUploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //$model->parent_category = Category::PARENT_CATGORY;
            $model->save();
            $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                $this->checkFolder('sub-category');
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/sub-category/' .$fielname);
                $model->category_image_path = '/upload/sub-category/'.$fielname;
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
        $model = SubCategory::findOne($id);
        $modelUploadFrom = new CategoryUploadForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                $this->checkFolder('sub-category');
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/sub-category/' .$fielname);
                $model->category_image_path = '/upload/sub-category/'.$fielname;
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
       
        SubCategory::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionStatus()
    {
        $request = Yii::$app->request->get();
        $model = Category::findOne($request['id']);
        $model->category_status = $request['status'];
        $model->save(false);
       return $this->asJson(['status' => 200, 'msg' => ($model->category_status == 0 ? 'Deactive Successfull' :'Activate Successfull')]);
    }


   
}
