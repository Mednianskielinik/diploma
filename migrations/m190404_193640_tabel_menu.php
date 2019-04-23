<?php

use yii\db\Migration;

/**
 * Class m190404_193640_tabel_menu
 */
class m190404_193640_tabel_menu extends Migration
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
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'category' => $this->integer()->notNull(),
            'name' => $this->string()->notNull()->unique(),
            'components' => $this->text()->notNull(),
            'cost' => $this->string()->notNull(),
            'weight' => $this->string()->notNull(),
            'image' => $this->text()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190404_193640_tabel_menu cannot be reverted.\n";

        return false;
    }
}
