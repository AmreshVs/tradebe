<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $category_id
 * @property string|null $category_name
 * @property int|null $category_status
 * @property int|null $parent_category
 */
class CategoryUploadForm extends \yii\db\ActiveRecord
{
     /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
            ['file', 'safe'],
        ];
    }

      /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file' => Yii::t('app', 'Image'),

        ];
    }

}
