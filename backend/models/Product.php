<?php

namespace backend\models;

use common\components\TimestampBehavior;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%products}}';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
    public function rules()
    {
        return [
            [['name', 'price', 'description', 'image'], 'required'],
            [['price'], 'number'],
            [['description'], 'string'],
            [[ 'in_rental'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'image' => 'Image',
            'in_rental' => 'In Rental',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}