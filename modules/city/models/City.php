<?php

namespace app\modules\city\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * Class City
 * @package app\modules\city\models
 *
 * @var int $id
 * @var string $name
 * @var string $ref
 */
class City extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['city', 'trim'],
            ['city', 'required'],
            ['ref', 'trim'],
            ['ref', 'required'],
            ['ref', 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin','ID'),
            'name' => Yii::t('admin','City'),
            'ref' => Yii::t('admin','Ref'),
        ];
    }

    public static function listItems()
    {
        $items = City::find()->asArray()->all();
        $list = [];
        if(!empty($items)) {
            foreach ($items as $item) {
                $list[$item['ref']] = $item['city'];
            }
        }
        return $list;
    }
}
