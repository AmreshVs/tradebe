<?php
namespace backend\models;


use backend\models\Vendor;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class VendorSearch extends \backend\models\Vendor
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [[
                'vendor_name',
                'first_name',
                'last_name',
                'email',
                'mobile',
                'vendor_status'
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
        $query = Vendor::find();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'vendor_name',
                    'first_name',
                    'last_name',
                    'email',
                    'mobile',
                ],
                'defaultOrder' => [

                    'vendor_name' => SORT_ASC,
                    'first_name' => SORT_ASC,
                    'last_name' => SORT_ASC,
                    'email' => SORT_ASC,
                    'mobile' => SORT_ASC,

                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'vendor_name', $this->vendor_name])
              ->andFilterWhere(['like', 'first_name', $this->first_name])
              ->andFilterWhere(['like', 'last_name', $this->last_name])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'mobile', $this->mobile])
              ->andFilterWhere(['like', 'vendor_status', $this->vendor_status]);
        
        return $dataProvider;   
    }  
}


