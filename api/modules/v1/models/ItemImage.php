<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "item_image".
 *
 * @property int $item_image_id
 * @property int|null $item_id
 * @property string|null $image_path
 */
class ItemImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['image_path'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_image_id' => Yii::t('app', 'Item Image ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'image_path' => Yii::t('app', 'Image Path'),
        ];
    }
}
