<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Produk;

/**
 * ProdukSearch represents the model behind the search form of `common\models\Produk`.
 */
class ProdukSearch extends Produk
{
    /**
     * {@inheritdoc}
     */
    public $keyword;

    public function rules()
    {
        return [
            [['keyword','nama_produk'], 'safe'],
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
        $query = Produk::findProduk()->orderBy(['sku'=>SORT_DESC]);

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
        $query->andFilterWhere([
            'status_aktif' => $this->status_aktif,
            'harga_async' => $this->harga_async,
            'stok_async' => $this->stok_async,
            'berat' => $this->berat,
        ]);

        $query->andFilterWhere(['ilike', 'sku', $this->sku])
            ->andFilterWhere(['ilike', 'nama_produk', $this->nama_produk])
            ->andFilterWhere(['ilike', 'nama_produk_pendek', $this->nama_produk_pendek])
            ->andFilterWhere(['ilike', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}
