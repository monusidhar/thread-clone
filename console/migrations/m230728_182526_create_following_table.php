<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%following}}`.
 */
class m230728_182526_create_following_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%following}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'following_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Add foreign key constraints
        $this->addForeignKey('fk-following-user', '{{%following}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-following-following', '{{%following}}', 'following_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-following-following', '{{%following}}');
        $this->dropForeignKey('fk-following-user', '{{%following}}');
        $this->dropTable('{{%following}}');
    }
}
