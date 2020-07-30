<?php
namespace backend\models;


use backend\models\Banner;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class BannerSearch extends \backend\models\Banner
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [['banner_name', 'banner_status'], 'safe'],            
        ];
    }
    
    /**
     * 
     * @param type $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Banner::find();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'banner_name',
                    'banner_status',
                ],
                'defaultOrder' => [

                    'banner_name' => SORT_ASC,
                    'banner_status' => SORT_ASC,

                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'banner_name', $this->banner_name])
              ->andFilterWhere(['like', 'banner_status', $this->banner_status]);
        
        return $dataProvider;   
    }  
}


