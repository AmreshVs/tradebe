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
class CategoryController extends CController
{
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Category();
        $modelUploadFrom = new CategoryUploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->parent_category = Category::PARENT_CATGORY;
            $model->save();

            $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/category/' .$fielname);
                $model->category_image_path = '/upload/category/'.$fielname;
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
        $model = Category::findOne($id);
        $modelUploadFrom = new CategoryUploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('form', [
            'model' => $model,
            'modelFrom'=> $modelUploadFrom

        ]);

    }

    public function actionDelete($id)
    {
        Category::findOne($id)->delete();
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

    public function actionTest()
    {
        $categoryArr = Category::find()->where(['<>', 'parent_category', 0])->asArray()->all();
        foreach($categoryArr as $key => $category) {
            $model = new Category();
            $model->load($category, "");
            $model->parent_category = rand(1, 100);
            $model->main_category_id = rand(1, 10);
            $model->save(false);
        
        } 
    }


   
}
