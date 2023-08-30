<?php

namespace backend\models;

use common\models\User;
use yii\db\ActiveRecord;

class Purchase extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%purchases}}';
    }

    public function generateAttributeLabel($name)
    {
        return parent::generateAttributeLabel($name);
    }
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'purchase_date', 'unique_code'], 'required'],
            [['user_id', 'product_id'], 'integer'],
            [['purchase_date'], 'safe'],
            [['unique_code'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

}