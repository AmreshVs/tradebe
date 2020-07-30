<?php
namespace backend\models;


use backend\models\Order;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class OrderSearch extends \backend\models\Order
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [[
                'order_number',
                'vendor_name',
                'item_name',
                'city_name',
                'created_at',
                'order_status'
            ], 'safe'],            
        ];
    }
    
    /**
     * 
     * @param type $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find()->alias('O')
            ->select([
                'O.*',
                'I.item_name',
                'V.vendor_name',
                'C.city_name',
            ])
            ->leftJoin(['I' => Item::tableName()], 'I.item_id = O.item_id')
            ->leftJoin(['V' => Vendor::tableName()], 'V.vendor_id = O.vendor_id')
            ->leftJoin(['C' => City::tableName()], 'C.city_id = O.city_id')


        ->orderBy(['order_id' => SORT_DESC]);
     
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                     'order_number',
                    'vendor_name',
                    'item_name',
                    'city_name',
                    'created_at'
                ],
                'defaultOrder' => [
                    'order_number' => SORT_ASC,
                    'vendor_name' => SORT_ASC,
                    'item_name' => SORT_ASC,
                    'city_name' => SORT_ASC,

                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'order_number', $this->order_number])
              ->andFilterWhere(['like', 'vendor_name', $this->vendor_name])
              ->andFilterWhere(['like', 'item_name', $this->item_name])
              ->andFilterWhere(['like', 'city_name', $this->city_name])
              ->andFilterWhere(['like', 'order_status', $this->order_status]);
        
        return $dataProvider;   
    }  
}


