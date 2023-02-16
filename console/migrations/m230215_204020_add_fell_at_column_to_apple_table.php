<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%apple}}`.
 */
class m230215_204020_add_fell_at_column_to_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%apple}}', 'fell_at', $this->timestamp()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%apple}}', 'fell_at');
    }
}
