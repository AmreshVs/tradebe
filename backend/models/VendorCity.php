<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vendor_city".
 *
 * @property int|null $vendor_city_id
 * @property int|null $vendor_id
 * @property int|null $city_id
 */
class VendorCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_city_id', 'vendor_id', 'city_id'], 'integer'],
           // ['vendor_city_id', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vendor_city_id' => Yii::t('app', 'Vendor City ID'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'city_id' => Yii::t('app', 'City Name'),
        ];
    }
}