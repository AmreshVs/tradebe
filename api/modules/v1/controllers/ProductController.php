<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;
use api\modules\v1\models\ItemList;
use api\modules\v1\models\ItemView;
use api\modules\v1\controllers\ItemDetail;
use api\modules\v1\models\Category;
use api\modules\v1\models\Order;
use api\modules\v1\models\Vendor;
use api\modules\v1\models\ItemSpecification;


use yii\db\Expression;
use Yii;

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

    public function actionBooking()
    {
        $request = Yii::$app->request->post();
        $headers = Yii::$app->request->headers;
        $city_id = $headers->get('city');
        if($city_id == null){
            return $this->asJson(['status' => 422, 'data' => [], 'msg'=> 'Require City']);

        }
         $modelItem = ItemList::find()->where([
                'item_id' => $request['item_id'],
                'item_status' => 1
            ])->one();
        if($modelItem == ''){
            return $this->asJson(['status' => 422, 'data' => [], 'msg'=> 'Invalid Products']);
        }


        $model = new Order();
        $model->order_number = str_pad(Order::find()->count()+1, 6, "0", STR_PAD_LEFT);
        $model->item_id = $request['item_id'];
        $model->customer_name = $request['customer_name'];
        $model->mobile_number = $request['mobile_number'];
        $model->unit = $modelItem->unit_name;
        $model->price_range = $request['price_range'];
        $model->qty = $request['qty'];
        $model->vendor_id = $modelItem->vendor_id;
        $model->city_id = $city_id;
        $model->order_status = 1;
        $model->created_at = date('Y-m-d H:i:s');
        $model->save(false);
        $spec = ItemSpecification::find()
                    ->select([
                        'item_specification_name',
                        'item_specification_value'
                    ])->where(['item_id' => $model->item_id])
                    ->asArray()
                    ->all();
        \Yii::$app->mail->compose('order',[
            'item' => $modelItem, 
            'order' => $model,
            'spec' => $spec
        ])
        ->setFrom([\Yii::$app->params['supportEmail'] => 'India Mart'])
        ->setTo($request['email'])
        ->setSubject('Thanks for Booking' )
        ->send();
        return $this->asJson(['status' => 200, 'data' => [], 'msg' => 'Booking Successfully']);

    }

    public function actionGetPriceRange()
    {
        $price = [
            1 => 'less then 100',
            2 => '100 to 500',
            3 => '500 to 1000',
            4 => '1000 to 5000',
            5 => '5000 to 10000',
            6 => '10000 to 50000',
            7 => '50000 and above',
        ];

        return $this->asJson(['status' => 200, 'data' => $price, 'msg' => 'Price Range Successfully']);

    }
}


