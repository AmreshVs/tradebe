<?php
namespace backend\controllers;

use Yii;
use common\components\CController;
use backend\models\Vendor;
use backend\models\VendorCity;
use backend\models\VendorSearch;
use backend\models\CategoryUploadForm;
use yii\web\UploadedFile;

/**
 * Home controller
 */
class VendorController extends CController
{
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VendorSearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Vendor();
        $modelCity = new VendorCity();
        $modelUploadFrom = new CategoryUploadForm();

        $request = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $modelCity->load(Yii::$app->request->post())) {
            //$model->parent_category = Category::PARENT_CATGORY;
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->save(false);

            $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                $this->checkFolder('vendor');
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/vendor/' .$fielname);
                $model->vendor_image_path = '/upload/vendor/'.$fielname;
                $model->save(false);
            }
   
            foreach ($request['VendorCity']['city_id'] as $key => $value) {
                $modelCity = new VendorCity();
                $modelCity->city_id = $value;
                $modelCity->vendor_id = $model->getPrimaryKey();
                $modelCity->save();
            }

            return $this->redirect(['index']);
        }
     
        return $this->render('form', ['model' => $model, 'modelCity' => $modelCity, 'modelUploadFrom' => $modelUploadFrom]);

    }
    public function actionUpdate($id)
    {
        $model = Vendor::findOne($id);
        $modelCity = new VendorCity();
        $modelCityArr = VendorCity::find()
            ->select('group_concat(city_id) as city_id')
            ->where(['vendor_id' => $model->getPrimaryKey()])
            ->asArray()
            ->one();
        $modelUploadFrom = new CategoryUploadForm();

        $request = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
             $modelUploadFrom->file = UploadedFile::getInstance($modelUploadFrom, 'file');
            if ($modelUploadFrom->file && $modelUploadFrom->validate()) {
                $this->checkFolder('vendor');
                $fielname = substr(md5(microtime()),rand(0,26),5).rand(1, 10000).'.' . $modelUploadFrom->file->extension;          
                $modelUploadFrom->file->saveAs(\Yii::getAlias('@upload').'/vendor/' .$fielname);
                $model->vendor_image_path = '/upload/vendor/'.$fielname;
                $model->save(false);
            }
   
            VendorCity::DeleteAll(['vendor_id' => $model->getPrimaryKey()]);
            foreach ($request['VendorCity']['city_id'] as $key => $value) {
                $modelCity = new VendorCity();
                $modelCity->city_id = $value;
                $modelCity->vendor_id = $model->getPrimaryKey();
                $modelCity->save();
            }
            return $this->redirect(['index']);
        }
       
        return $this->render('form', ['model' => $model, 'modelCity' => $modelCity, 'modelCityArr' => $modelCityArr, 'modelUploadFrom' => $modelUploadFrom]);

    }

    public function actionDelete($id)
    {
        Vendor::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionStatus()
    {
        $request = Yii::$app->request->get();
        $model = Vendor::findOne($request['id']);
        $model->vendor_status = $request['status'];
        $model->save(false);
       return $this->asJson(['status' => 200, 'msg' => ($model->vendor_status == 0 ? 'Deactive Successfull' :'Activate Successfull')]);
    }


   
}
