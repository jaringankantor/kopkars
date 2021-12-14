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
    public function rules()
    {
        return [
            [['sku', 'nama_produk', 'deskripsi', 'foto_1', 'foto_2', 'foto_3', 'foto_4', 'foto_5', 'foto_6', 'foto_7', 'video_url_1', 'video_url_2', 'video_url_3', 'video_url_4', 'video_url_5', 'rekomendasi_1', 'rekomendasi_2', 'rekomendasi_3', 'rekomendasi_4', 'rekomendasi_5'], 'safe'],
            [['status_aktif'], 'boolean'],
            [['harga_async', 'stok_async', 'berat'], 'integer'],
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
