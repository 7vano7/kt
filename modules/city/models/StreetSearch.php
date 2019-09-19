<?php

namespace app\modules\city\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * StreetSearch represents the model behind the search form of `frontend\modules\city\models\Street`.
 */
class StreetSearch extends Street
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['street', 'city_ref'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->load($params);
        $query = Street::find()->orderBy(['id'=>SORT_DESC]);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => 'id DESC'],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'street',
                'city_ref',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'city_ref'=>$this->city_ref,
        ]);

        $query->andFilterWhere(['like', 'street', $this->street]);
        return $dataProvider;
    }

}
