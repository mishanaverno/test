<?php
namespace app\models;

use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function getUserName(){
        return $this->hasOne(ServiceUser::className(),['id' => 'user']);
    }
    public function rules()
    {
        return [
            [['type','user','ip','domain'], 'required'],
        ];
    }
    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return 'services';
    }
}