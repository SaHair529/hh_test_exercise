<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m230213_201625_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $colorQuerySql = 'select `color` from `colors` where id = (select floor(rand()*3)+1) limit 1';

        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(10)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'eaten_percent' => $this->integer()->defaultValue(0),
            'is_on_tree' => $this->integer()->defaultValue(1),
            'is_bad' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apples}}');
    }
}
