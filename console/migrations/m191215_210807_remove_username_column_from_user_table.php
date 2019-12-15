<?php

use yii\db\Migration;

/**
 * Class m191215_210807_remove_username_column_from_user_table
 */
class m191215_210807_remove_username_column_from_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%user}}','username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191215_210807_remove_username_column_from_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191215_210807_remove_username_column_from_user_table cannot be reverted.\n";

        return false;
    }
    */
}
