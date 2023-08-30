<?php

use yii\db\Migration;

/**
 * Class m230830_003204_add_column_balance_to_user_table
 */
class m230830_003204_add_column_balance_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'balance', $this->decimal(10, 2)->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'balance');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230830_003204_add_column_balance_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
