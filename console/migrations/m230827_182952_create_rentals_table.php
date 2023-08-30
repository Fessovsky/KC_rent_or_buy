<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rentals}}`.
 */
class m230827_182952_create_rentals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rentals}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'rental_start' => $this->dateTime()->notNull(),
            'rental_end' => $this->dateTime()->notNull(),
            'unique_code' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk-rentals-user_id', '{{%rentals}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk-rentals-product_id', '{{%rentals}}', 'product_id', '{{%products}}', 'id');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-rentals-user_id', '{{%rentals}}');
        $this->dropForeignKey('fk-rentals-product_id', '{{%rentals}}');
        $this->dropTable('{{%rentals}}');
    }
}
