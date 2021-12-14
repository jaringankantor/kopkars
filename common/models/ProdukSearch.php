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
        $query = Produk::findProduk();

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
            ->andFilterWhere(['ilike', 'nama_produk_pendek', $this->nama_produk])
            ->andFilterWhere(['ilike', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['ilike', 'foto_1', $this->foto_1])
            ->andFilterWhere(['ilike', 'foto_2', $this->foto_2])
            ->andFilterWhere(['ilike', 'foto_3', $this->foto_3])
            ->andFilterWhere(['ilike', 'foto_4', $this->foto_4])
            ->andFilterWhere(['ilike', 'foto_5', $this->foto_5])
            ->andFilterWhere(['ilike', 'foto_6', $this->foto_6])
            ->andFilterWhere(['ilike', 'foto_7', $this->foto_7])
            ->andFilterWhere(['ilike', 'video_url_1', $this->video_url_1])
            ->andFilterWhere(['ilike', 'video_url_2', $this->video_url_2])
            ->andFilterWhere(['ilike', 'video_url_3', $this->video_url_3])
            ->andFilterWhere(['ilike', 'video_url_4', $this->video_url_4])
            ->andFilterWhere(['ilike', 'video_url_5', $this->video_url_5])
            ->andFilterWhere(['ilike', 'rekomendasi_1', $this->rekomendasi_1])
            ->andFilterWhere(['ilike', 'rekomendasi_2', $this->rekomendasi_2])
            ->andFilterWhere(['ilike', 'rekomendasi_3', $this->rekomendasi_3])
            ->andFilterWhere(['ilike', 'rekomendasi_4', $this->rekomendasi_4])
            ->andFilterWhere(['ilike', 'rekomendasi_5', $this->rekomendasi_5]);

        return $dataProvider;
    }
}
