<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "vendor".
 *
 * @property int $vendor_id
 * @property string|null $vendor_name
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $mobile
 * @property int|null $city_id
 * @property int|null $vendor_status
 */
class Vendor extends \yii\db\ActiveRecord
{
    public $password, $confirm_password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'vendor_status'], 'integer'],
            [['vendor_name', 'first_name', 'last_name', 'email'], 'string', 'max' => 256],
            ['mobile', 'integer'],
            [['mobile'], 'string', 'max' => 10],
            ['email', 'email'],
             [[
                'vendor_name',
                'vendor_desc',
                'vendor_address',
                //'city_id',
                'first_name',
                //'last_name',
                'email',
                'mobile',
                //'city_id',
            ], 'required'], 
            ['confirm_password', 'compare', 'compareAttribute'=>'password'],
            ['password', 'string', 'min' => 6],
            [['email', 'mobile'], 'unique'],
            ['vendor_image_path','safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'vendor_name' => Yii::t('app', 'Seller Name'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'city_name' => Yii::t('app', 'City Name'),
            'vendor_status' => Yii::t('app', 'Seller Status'),
            'vendor_address' => 'Seller Address',
            'vendor_desc' => 'Seller Desc',

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
                'C.vendor_id',
                'C.vendor_name'
                ])

            //->andWhere(['<>', 'C.parent_category' , self::PARENT_CATGORY ])
            ->orderBy([
                    'C.vendor_name' => SORT_ASC
            ]) 
            ->asArray()
            ->all();        

        if (!empty($categoryData)) {
            return ArrayHelper::map($categoryData,'vendor_id','vendor_name');
        } else {
            return [];
        }
    }
}
