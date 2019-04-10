<?php

use yii\db\Migration;

/**
 * Class m190407_111226_tabel_order
 */
class m190407_111226_tabel_order extends Migration
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
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'date' => $this->timestamp()->notNull(),
            'sum_of_order' => $this->integer()->notNull(),
            'confirm' => $this->boolean()->defaultValue(false),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190407_111226_tabel_order cannot be reverted.\n";

        return false;
    }
}
