<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m190919_150919_add_roles
 */
class m190919_150919_add_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole(User::ROLE_ADMIN);
        $admin->description = 'Administrator';
        $auth->add($admin);

        $manager = $auth->createRole(User::ROLE_MANAGER);
        $manager->description = 'Manager';
        $auth->add($manager);

        $user = $auth->createRole(User::ROLE_USER);
        $user->description = 'Manager';
        $auth->add($user);

        $auth->addChild($manager, $user);
        $auth->addChild($admin, $manager);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole(User::ROLE_ADMIN);
        $manager = $auth->getRole(User::ROLE_MANAGER);
        $user = $auth->getRole(User::ROLE_USER);
        $auth->remove($admin);
        $auth->remove($manager);
        $auth->remove($user);
    }
}
