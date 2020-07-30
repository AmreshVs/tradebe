<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $order_id
 * @property int|null $vendor_id
 * @property int|null $item_id
 * @property string|null $mobile_number
 * @property int|null $user_id
 * @property int|null $qty
 * @property string|null $unit
 * @property string|null $price_range
 * @property int|null $city_id
 * @property string|null $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    public $vendor_name, $item_name, $city_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_id', 'item_id', 'user_id', 'qty', 'city_id'], 'integer'],
            [['created_at'], 'safe'],
            [['mobile_number'], 'string', 'max' => 30],
            [['unit', 'price_range'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'mobile_number' => Yii::t('app', 'Mobile Number'),
            'user_id' => Yii::t('app', 'User ID'),
            'qty' => Yii::t('app', 'Qty'),
            'unit' => Yii::t('app', 'Unit'),
            'price_range' => Yii::t('app', 'Price Range'),
            'city_id' => Yii::t('app', 'City ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
