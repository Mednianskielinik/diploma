<?php

use yii\db\Migration;

/**
 * Class m190414_180939_black_list_settings_table
 */
class m190414_180939_black_list_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%black_list_settings}}', [
            'id' => $this->primaryKey(),
            'count_of_day' => $this->integer()->notNull(),
            'fine' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('black_list_settings', [
            'count_of_day' => '30',
            'fine' => '5',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190414_180939_black_list_settings_table cannot be reverted.\n";

        return false;
    }
}
