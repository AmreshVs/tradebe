<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;
use api\modules\v1\models\ItemList;
use api\modules\v1\models\ItemView;
use api\modules\v1\controllers\ItemDetail;
use api\modules\v1\models\Category;

use yii\db\Expression;

/**
 * Country Controller API
 *
 * 
 */
class ProductController extends HelpController
{
    public function actionIndex($sub_category_id)
    {
         $model = Category::find()
            ->select(['category_name', 'category_id'])
            ->where(['category_id' => $sub_category_id])
            ->asArray()
            ->one();

        if($model == ''){
            return $this->asJson(['status' => 422, 'data' => [], 'msg'=> 'Invalid Category']);
        }

        $result['sub_category'] = Category::find()
            ->select(['category_name', 'category_id'])
            ->where(['category_id' => $sub_category_id])
            ->asArray()
            ->one();

        $result['products']  = ItemList::find()
            ->alias('I')
            ->where([
                'I.sub_category_id' => $sub_category_id,
                'item_status' => 1,
            ])

            ->all();
    	
    
        return $this->asJson(['status' => 200, 'data' => $result, 'msg' => 'Products list Successfully']);
    	
    }

    public function actionView($item_id)
    {
        $model = ItemList::find()->where([
                'item_id' => $item_id,
                'item_status' => 1
            ])->one();
        if($model == ''){
            return $this->asJson(['status' => 422, 'data' => [], 'msg'=> 'Invalid Products']);
        }

        $result['products']  = ItemView::find()
            ->alias('I')
            ->where([
                'I.item_id' => $item_id,
                'item_status' => 1,
            ])
            ->all();

        $result['related_products'] = ItemList::find()
            ->alias('I')
            ->where([
                'item_status' => 1
            ])
            ->limit(10)
            ->all();

        $result['recomened_products']  = ItemList::find()
            ->alias('I')
            ->where([
                'I.sub_category_id' => $model->sub_category_id,
                'I.item_status' => 1,
            ])

            ->all();
        
    

        return $this->asJson(['status' => 200, 'data' => $result, 'msg' => 'Products View Successfully']);
    } 
}


