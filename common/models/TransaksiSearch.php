<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transaksi;

/**
 * TransaksiSearch represents the model behind the search form of `common\models\Transaksi`.
 */
class TransaksiSearch extends Transaksi
{
    public $keyword;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keyword'], 'safe'],
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
        $query = Transaksi::findTransaksi();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['waktu'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['or',['ilike', 'nomor_referensi', $this->keyword],['ilike', 'nomor_pesanan', $this->keyword],['ilike', 'anggota_nomor_zahir', $this->keyword],['ilike', 'nama_pelangganS', $this->keyword]]);

        return $dataProvider;
    }
}
