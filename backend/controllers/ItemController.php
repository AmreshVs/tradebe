<?php
namespace backend\controllers;

use Yii;
use common\components\CController;
use backend\models\Item;
use backend\models\ItemSpecification;
use backend\models\ItemSearch;
use backend\models\Category;

use common\models\LoginForm;
use yii\db\Expression;



/**
 * Home controller
 */
class ItemController extends CController
{

    public function beforeAction($action)
{            
    if ($action->id == 'image-upload') {
        $this->enableCsrfValidation = false;
    }

    return parent::beforeAction($action);
}
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Item();
        $modeSpec = new ItemSpecification();
        $request = Yii::$app->request->post();
       // print_r($_POST); die;
        if ($model->load($request)) {
            //$model->parent_category = Category::PARENT_CATGORY;
            $model->save();
            foreach ($request['Specification'] as $key => $value) {
                if ($key % 2 == 0) {
                    $modelSpec = new ItemSpecification();
                    $modelSpec->item_specification_name = $value['name'];
                } else {
                    $modelSpec->item_specification_value = $value['value'];
                    $modelSpec->item_id = $model->getPrimaryKey();
                    $modelSpec->save(false);
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('form', ['model' => $model]);

    }
    public function actionUpdate($id)
    {
        $model = Item::findOne($id);
        $modeSpecArr = ItemSpecification::find()->where(['item_id' => $model->getPrimaryKey()])->asArray()->all();
        $request = Yii::$app->request->post();
     
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            ItemSpecification::deleteAll(['item_id' => $model->getPrimaryKey()]);
             foreach ($request['Specification'] as $key => $value) {
                if ($key % 2 == 0) {
                    $modelSpec = new ItemSpecification();
                    $modelSpec->item_specification_name = $value['name'];
                } else {
                    $modelSpec->item_specification_value = $value['value'];
                    $modelSpec->item_id = $model->getPrimaryKey();
                    $modelSpec->save(false);
                }
            }
            return $this->redirect(['index']);
        }
       
        return $this->render('form', [
            'model' => $model,
            'modeSpecArr' => $modeSpecArr
        ]);

    }

    public function actionImageUpload()
    {
        //die('hi');
        return $this->asJson(['uploadURL' => 'Created',
        'code' => 201]);
       // die('wrk');
    }

    public function actionDelete($id)
    {
        Item::findOne($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionStatus()
    {
        $request = Yii::$app->request->get();
        $model = Item::findOne($request['id']);
        $model->item_status = $request['status'];
        $model->save(false);
       return $this->asJson(['status' => 200, 'msg' => ($model->item_status == 0 ? 'Deactive Successfull' :'Activate Successfull')]);
    }

    public function actionGetSubCategory()
    {
        $request = Yii::$app->request->post();
       
        $model = Category::getSub($request['id']);
        
        return $this->asJson(['status'=> 200, 'data' => $model]);
    }
    public function actionGetMainCategory()
    {
        $request = Yii::$app->request->post();
       
        $model = Category::getShopCategoryData($request['id']);
        
        return $this->asJson(['status'=> 200, 'data' => $model]);
    }

    public function actionTest()
    {
        $models = Item::find()->all();
        foreach ($models as $key => $model) {
       
            $Category = Category::find()->where(['main_category_id' => $model->main_category_id])->orderBy(new Expression('rand()'))->one();
            $sub_category = Category::find()->where(['parent_category' => $model->category_id])->orderBy(new Expression('rand()'))->one();
            if($Category != null && $sub_category != null){
                $model->category_id = $Category->category_id;
                $model->sub_category_id = $sub_category->category_id;
                $model->save();
                //die('wrk');
            }
        }
    }


   
}
