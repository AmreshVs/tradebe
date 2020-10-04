<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $banner_id
 * @property string|null $banner_name
 * @property string|null $banner_image_path
 * @property int|null $banner_status
 */
class Banner extends \yii\db\ActiveRecord
{
		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
				return 'banner';
		}

		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
				return [
						[['banner_status'], 'integer'],
						[['banner_name', 'banner_image_path'], 'string', 'max' => 256],
						[['banner_name'], 'required'],
						['banner_status', 'safe']

				];
		}

		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels()
		{
				return [
						'banner_id' => Yii::t('app', 'Banner ID'),
						'banner_name' => Yii::t('app', 'Banner Name'),
						'banner_image_path' => Yii::t('app', 'Banner Image Path'),
						'banner_status' => Yii::t('app', 'Banner Status'),
				];
		}
}
