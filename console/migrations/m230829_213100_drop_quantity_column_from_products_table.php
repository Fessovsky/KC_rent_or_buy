<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%products}}`.
 */
class m230829_213100_drop_quantity_column_from_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%products}}', 'quantity');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%products}}', 'quantity', $this->integer()->notNull());
    }
}
