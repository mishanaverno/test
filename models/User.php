<?php
namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    public function rules()
    {
        return [['first_name','last_name'], 'required'];
    }
    public static function tableName()
    {
        return 'users';
    }
    public function getFullName(){
        return $this->first_name.' '.$this->last_name;
    }
}