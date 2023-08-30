<?php

use yii\db\Migration;

/**
 * Class m230830_022920_create_table_products_uids
 */
class m230830_022920_create_table_products_uids extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_uids}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'uid' => $this->string()->notNull()
        ]);
        $this->addForeignKey(
            'fk-products_uids-product_id',
            '{{%products_uids}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-products_uids-unique_code',
            '{{%products_uids}}',
            'uid',
            '{{%products}}',
            'unique_code',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-products_uids-product_id',
            '{{%products_uids}}'
        );
        $this->dropForeignKey(
            'fk-products_uids-unique_code',
            '{{%products_uids}}'
        );
        $this->dropTable('{{%products_uids}}');
    }
}
