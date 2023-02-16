<?php

use yii\db\Migration;

/**
 * Class m230215_232246_change_fell_at_column_on_apple_table
 */
class m230215_232246_change_fell_at_column_on_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%apple}}', 'size');
        $this->addColumn('{{%apple}}', 'size', $this->integer()->defaultValue(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230215_232246_change_fell_at_column_on_apple_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230215_232246_change_fell_at_column_on_apple_table cannot be reverted.\n";

        return false;
    }
    */
}
