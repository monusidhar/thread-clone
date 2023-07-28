<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%likes}}`.
 */
class m230728_182050_drop_likes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%likes}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "This migration is irreversible. It cannot be reverted.\n";
        return false;
    }
}
