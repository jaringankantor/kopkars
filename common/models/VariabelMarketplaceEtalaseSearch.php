<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VariabelMarketplaceEtalase;

/**
 * VariabelMarketplaceEtalaseSearch represents the model behind the search form of `common\models\VariabelMarketplaceEtalase`.
 */
class VariabelMarketplaceEtalaseSearch extends VariabelMarketplaceEtalase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_variabel_marketplace', 'kode', 'marketplace_etalase'], 'safe'],
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
        $query = VariabelMarketplaceEtalase::findVariabelMarketplaceEtalase();

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
        $query->andFilterWhere(['ilike', 'kode_variabel_marketplace', $this->kode_variabel_marketplace])
            ->andFilterWhere(['ilike', 'kode', $this->kode])
            ->andFilterWhere(['ilike', 'marketplace_etalase', $this->marketplace_etalase]);

        return $dataProvider;
    }
}
