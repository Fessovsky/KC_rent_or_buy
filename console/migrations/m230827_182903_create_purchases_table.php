<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purchases}}`.
 */
class m230827_182903_create_purchases_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purchases}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'purchase_date' => $this->dateTime()->notNull(),
            'unique_code' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk-purchases-user_id', '{{%purchases}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk-purchases-product_id', '{{%purchases}}', 'product_id', '{{%products}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-purchases-user_id', '{{%purchases}}');
        $this->dropForeignKey('fk-purchases-product_id', '{{%purchases}}');
        $this->dropTable('{{%purchases}}');
    }
}
