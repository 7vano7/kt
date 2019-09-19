<?php

namespace app\modules\city\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * Class Street
 * @package app\modules\city\models
 *
 * @var integer $id
 * @var string $street
 * @var integer $city_id
 */
class Street extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%street}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['street', 'trim'],
            ['street', 'required'],
            ['city_ref', 'required'],
            ['city_ref', 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin','ID'),
            'street' => Yii::t('admin','Street'),
            'city_ref' => Yii::t('admin','City'),
        ];
    }

    public function getParent() {

        return City::find()->where(['ref'=>$this->city_ref])->one();
    }
}
