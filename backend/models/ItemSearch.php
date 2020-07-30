<?php
namespace backend\models;


use backend\models\Item;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class ItemSearch extends \backend\models\Item
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [[
                'item_name',
                'category_id',
                'sub_category_id',
                'price',
                'item_status'
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
        $query = Item::find();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'item_name',
                    'vendor_id',
                    'price',
                    'item_status',
                ],
                'defaultOrder' => [
                    'item_name' => SORT_ASC,
                    'vendor_id' => SORT_ASC,
                    'price' => SORT_ASC,
                    'item_status' => SORT_ASC,

                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'item_name', $this->item_name])
              ->andFilterWhere(['like', 'price', $this->price])
              ->andFilterWhere(['like', 'item_status', $this->item_status]);
        
        return $dataProvider;   
    }  
}


