<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "city".
 *
 * @property int $city_id
 * @property string|null $city_name
 * @property int|null $city_status
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_status'], 'integer'],
            [['city_name'], 'string', 'max' => 256],
            [['city_name'], 'required'],
            ['city_name', 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_id' => Yii::t('app', 'City ID'),
            'city_name' => Yii::t('app', 'City Name'),
            'city_status' => Yii::t('app', 'City Status'),
        ];
    }

       /**
    * 
    * @param type $index
    * @return array
    */
    public function get()
    {
        $categoryData = self::find()
            ->alias('C')
            ->select([
                'C.city_id',
                'C.city_name'
                ])

            //->andWhere(['=', 'C.parent_category' , self::PARENT_CATGORY ])
            ->orderBy([
                    'C.city_name' => SORT_ASC
            ]) 
            ->asArray()
            ->all();        

        if (!empty($categoryData)) {
            return ArrayHelper::map($categoryData,'city_id','city_name');
        } else {
            return [];
        }
    }
}
