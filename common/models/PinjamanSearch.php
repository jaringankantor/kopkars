<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pinjaman;

/**
 * PinjamanSearch represents the model behind the search form of `common\models\Pinjaman`.
 */
class PinjamanSearch extends Pinjaman
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'anggota_id', 'saldo_pokok', 'saldo_jasa', 'total_pembayaran'], 'integer'],
            [['kode_toko', 'mulai_tanggal_pembayaran', 'rencana_tanggal_pelunasan', 'aktual_tanggal_pelunasan', 'peruntukan', 'keterangan', 'waktu', 'last_waktu_update', 'insert_by', 'last_update_by', 'deleted_at', 'last_softdelete_by', 'nomor_referensi'], 'safe'],
            [['is_deleted'], 'boolean'],
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
        $query = Pinjaman::findPinjaman();

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
            'last_waktu_update' => $this->last_waktu_update,
            'is_deleted' => $this->is_deleted,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['ilike', 'kode_toko', $this->kode_toko])
            ->andFilterWhere(['ilike', 'peruntukan', $this->peruntukan])
            ->andFilterWhere(['ilike', 'keterangan', $this->keterangan])
            ->andFilterWhere(['ilike', 'insert_by', $this->insert_by])
            ->andFilterWhere(['ilike', 'last_update_by', $this->last_update_by])
            ->andFilterWhere(['ilike', 'last_softdelete_by', $this->last_softdelete_by])
            ->andFilterWhere(['ilike', 'nomor_referensi', $this->nomor_referensi]);

        return $dataProvider;
    }
}
