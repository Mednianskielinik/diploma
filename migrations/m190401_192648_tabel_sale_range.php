<?php

use yii\db\Migration;

/**
 * Class m190401_192648_tabel_sale_range
 */
class m190401_192648_tabel_sale_range extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%sale_range}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'sale' => $this->integer()->notNull(),
            'count_of_purchase' => $this->integer()->notNull(),
            'color' => $this->string()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
    }
}
