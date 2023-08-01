<?php
namespace frontend\behaviors;
use yii\base\Behavior;
use yii\db\ActiveRecord;
// use yii\behaviors\TimestampBehavior as BaseTimestampBehavior;

class TimestampBehavior extends Behavior{
    public function events(){
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'SetCreatedAt',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'SetUpdatedAt',
        ];
    }

    public function setCreatedAt(){
        $this->owner->created_at = time();
    }

    public function setUpdatedAt(){
        $this->owner->updated_at = time();
    }


}
