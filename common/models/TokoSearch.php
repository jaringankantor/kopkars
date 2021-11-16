<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Toko;

/**
 * TokoSearch represents the model behind the search form of `common\models\Toko`.
 */
class TokoSearch extends Toko
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama_toko', 'skuprefix1', 'skuprefix2', 'skuprefix3', 'skuprefix4', 'skuprefix5', 'skuprefix6', 'skuprefix7', 'skuprefix8', 'skuprefix9', 'skuprefix10'], 'safe'],
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
        $query = Toko::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['ilike', 'kode', $this->kode])
            ->andFilterWhere(['ilike', 'nama_toko', $this->nama_toko])
            ->andFilterWhere(['ilike', 'skuprefix1', $this->skuprefix1])
            ->andFilterWhere(['ilike', 'skuprefix2', $this->skuprefix2])
            ->andFilterWhere(['ilike', 'skuprefix3', $this->skuprefix3])
            ->andFilterWhere(['ilike', 'skuprefix4', $this->skuprefix4])
            ->andFilterWhere(['ilike', 'skuprefix5', $this->skuprefix5])
            ->andFilterWhere(['ilike', 'skuprefix6', $this->skuprefix6])
            ->andFilterWhere(['ilike', 'skuprefix7', $this->skuprefix7])
            ->andFilterWhere(['ilike', 'skuprefix8', $this->skuprefix8])
            ->andFilterWhere(['ilike', 'skuprefix9', $this->skuprefix9])
            ->andFilterWhere(['ilike', 'skuprefix10', $this->skuprefix10]);

        return $dataProvider;
    }
}
