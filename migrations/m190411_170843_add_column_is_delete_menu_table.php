<?php

use yii\db\Migration;

/**
 * Class m190411_170843_add_column_is_delete_menu_table
 */
class m190411_170843_add_column_is_delete_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('menu', 'is_deleted', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190411_170843_add_column_is_delete_menu_table cannot be reverted.\n";

        return false;
    }
}
