<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%colors}}`.
 */
class m230213_194626_create_colors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('colors', [
            'id' => $this->primaryKey(),
            'color' => $this->string(10)
        ]);
        $this->insert('colors', ['color' => 'green']);
        $this->insert('colors', ['color' => 'red']);
        $this->insert('colors', ['color' => 'yellow']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%colors}}');
    }
}
