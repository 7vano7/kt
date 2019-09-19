<?php

namespace app\modules\users;

use Yii;

/**
 * users module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\users\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        // custom initialization code goes here
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['*'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
//            'sourceLanguage' => 'fr',
            'basePath'       => '@app/modules/users/messages',
            'fileMap'        => [
            ],
        ];
    }
}
