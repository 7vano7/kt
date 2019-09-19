<?php

use yii\db\Migration;

/**
 * Class m190919_160132_add_city_and_street
 */
class m190919_160132_add_city_and_street extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'city' => $this->string()->null()->defaultValue(null),
            'ref' => $this->string()->unique()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createTable('{{%street}}', [
            'id' => $this->primaryKey(),
            'street' => $this->string()->null()->defaultValue(null),
            'city_ref' => $this->string()->null()->defaultValue(null),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
        $this->dropTable('{{%street}}');
    }
}
