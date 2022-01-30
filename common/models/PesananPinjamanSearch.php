<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PesananPinjaman;

/**
 * PesananPinjamanSearch represents the model behind the search form of `common\models\PesananPinjaman`.
 */
class PesananPinjamanSearch extends PesananPinjaman
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'anggota_id', 'saldo_pokok', 'saldo_jasa', 'total_pembayaran'], 'integer'],
            [['kode_toko', 'nomor_referensi', 'mulai_tanggal_pembayaran', 'rencana_tanggal_pelunasan', 'aktual_tanggal_pelunasan', 'peruntukan', 'lampiran', 'keterangan', 'waktu', 'last_update_by'], 'safe'],
            [['is_approved_level1', 'is_approved_level2', 'is_processed'], 'boolean'],
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
        $query = PesananPinjaman::find();

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
            'id' => $this->id,
            'anggota_id' => $this->anggota_id,
            'saldo_pokok' => $this->saldo_pokok,
            'saldo_jasa' => $this->saldo_jasa,
            'total_pembayaran' => $this->total_pembayaran,
            'mulai_tanggal_pembayaran' => $this->mulai_tanggal_pembayaran,
            'rencana_tanggal_pelunasan' => $this->rencana_tanggal_pelunasan,
            'aktual_tanggal_pelunasan' => $this->aktual_tanggal_pelunasan,
            'waktu' => $this->waktu,
            'is_approved_level1' => $this->is_approved_level1,
            'is_approved_level2' => $this->is_approved_level2,
            'is_processed' => $this->is_processed,
        ]);

        $query->andFilterWhere(['ilike', 'kode_toko', $this->kode_toko])
            ->andFilterWhere(['ilike', 'nomor_referensi', $this->nomor_referensi])
            ->andFilterWhere(['ilike', 'peruntukan', $this->peruntukan])
            ->andFilterWhere(['ilike', 'lampiran', $this->lampiran])
            ->andFilterWhere(['ilike', 'keterangan', $this->keterangan])
            ->andFilterWhere(['ilike', 'last_update_by', $this->last_update_by]);

        return $dataProvider;
    }
}
