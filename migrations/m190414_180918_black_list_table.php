<?php

use yii\db\Migration;

/**
 * Class m190414_180918_black_list_table
 */
class m190414_180918_black_list_table extends Migration
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
        $this->createTable('{{%black_list}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'date_of_block' => $this->timestamp()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190414_180918_black_list_table cannot be reverted.\n";

        return false;
    }
}
