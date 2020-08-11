<?php

namespace api\modules\v1\models;

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
class ItemList extends \yii\db\ActiveRecord
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
                'item_status',
                'item_desc',
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
            'sub_category_id' => Yii::t('app', 'Sub Category Name'),
            'vendor_id' => Yii::t('app', 'Vendor Name'),
            'unit_name' => Yii::t('app', 'Unit Name'),
            'price' => Yii::t('app', 'Price'),
            'item_status' => Yii::t('app', 'Item Status'),
        ];
    }

    public function fields()
    {
        return [
            'item_id',
            'item_name'  => function ($model) {
                return ucfirst($model->item_name);
            },
            'unit_name'  => function ($model) {
                return ucfirst($model->unit_name);
            },
            'price',
            'item_image' => function (self $model) {
                return ItemImage::find()->select([
                    'item_image_id',
                    'image_path',
                ])->where(['item_id' => $model->item_id])
                ->one();
            },
            'item_spec' => function (self $model) {
                return ItemSpecification::find()
                    ->select([
                        'item_specification_name',
                        'item_specification_value'
                    ])->where(['item_id' => $model->item_id])
                    ->limit(4)
                    ->all();
            },

            'seller_details' => function (self $model) {
                return Vendor::find()
                ->select([
                    'vendor_name',
                    'mobile',
                    'vendor_address',
                   
                ])
                ->where(['vendor_id'=> $model->vendor_id])
                ->asArray()->one();
            }
        ];
    }
}
