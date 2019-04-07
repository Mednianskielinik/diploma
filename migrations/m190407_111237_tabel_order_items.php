<?php

use yii\db\Migration;

/**
 * Class m190407_111237_tabel_order_items
 */
class m190407_111237_tabel_order_items extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(),
            'order' => $this->integer()->notNull(),
            'item' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190407_111237_tabel_order_items cannot be reverted.\n";

        return false;
    }
}
