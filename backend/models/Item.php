<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $item_id
 * @property string|null $item_name
 * @property string|null $item_desc
 * @property int|null $vendor_id
 * @property string|null $unit_name
 * @property float|null $price
 * @property int|null $item_status
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_desc'], 'string'],
            [['vendor_id', 'item_status'], 'integer'],
            [['price'], 'number'],
            [['item_name', 'unit_name'], 'string', 'max' => 256],

            [[
                'item_name',
                'category_id',
                'sub_category_id',
                'price',
                'item_status',
                //'last_name',
                'vendor_id',
                'unit_name',
                'item_desc',
                'main_category_id'
            ], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('app', 'Item ID'),
            'item_name' => Yii::t('app', 'Item Name'),
            'item_desc' => Yii::t('app', 'Item Desc'),
            'category_id' => Yii::t('app', 'Category Name'),
            'main_category_id' => Yii::t('app', 'Main Category Name'),
            'sub_category_id' => Yii::t('app', 'Sub Category Name'),
            'vendor_id' => Yii::t('app', 'Vendor Name'),
            'unit_name' => Yii::t('app', 'Unit Name'),
            'price' => Yii::t('app', 'Price'),
            'item_status' => Yii::t('app', 'Item Status'),
        ];
    }
}
