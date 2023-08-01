<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%followers}}`.
 */
class m230728_182440_create_followers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%followers}}', [
            'id' => $this->primaryKey(),
            'follower_id' => $this->integer()->notNull(),
            'following_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Add foreign key constraints
        $this->addForeignKey('fk-followers-follower', '{{%followers}}', 'follower_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-followers-following', '{{%followers}}', 'following_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-followers-following', '{{%followers}}');
        $this->dropForeignKey('fk-followers-follower', '{{%followers}}');
        $this->dropTable('{{%followers}}');
    }
}
