<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m230727_193451_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'caption' => $this->string()->notNull(),
            'pic_link_address' => $this->string()->notNull(),
            'no_of_likes' => $this->integer(),
            'no_of_replies' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'no_of_likes_on_replies' => $this->integer(),
            'hide_like_count' => $this->integer(),
            'who_can_reply' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}
