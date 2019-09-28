<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ServiceSearch extends Service{

    public function rules()
    {
        return [
            [['type'], 'safe']
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();   
    }
    public function search($params)
    {
        $query = Service::find();

        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'type', $this->type]);
        return $dataProvider;
    }
}