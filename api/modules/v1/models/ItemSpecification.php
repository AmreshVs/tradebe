<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "item_specification".
 *
 * @property int $item_specification_id
 * @property string|null $item_specification_name
 * @property string|null $item_specification_value
 * @property int|null $item_id
 */
class ItemSpecification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_specification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['item_specification_name', 'item_specification_value'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_specification_id' => Yii::t('app', 'Item Specification ID'),
            'item_specification_name' => Yii::t('app', 'Item Specification Name'),
            'item_specification_value' => Yii::t('app', 'Item Specification Value'),
            'item_id' => Yii::t('app', 'Item ID'),
        ];
    }

     public function fields()
    {
        return [
            'item_specification_name' => function ($model) {
                return ucfirst($model->item_specification_name);
            },  
            'item_specification_value' => function ($model) {
                return ucfirst($model->item_specification_value);
            },
        ];
    }
}
