<?php

namespace common\components;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class TimestampBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
        ];
    }

    public function beforeInsert($event)
    {
        $this->owner->created_at = date('Y-m-d H:i:s');
        $this->owner->updated_at = date('Y-m-d H:i:s');
        $this->owner->in_rental = 0;
    }

    public function beforeUpdate($event)
    {
        $this->owner->updated_at = date('Y-m-d H:i:s');
    }
}
