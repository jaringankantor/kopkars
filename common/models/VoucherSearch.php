<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Voucher;

/**
 * VoucherSearch represents the model behind the search form of `common\models\Voucher`.
 */
class VoucherSearch extends Voucher
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_voucher', 'nama_voucher', 'kode_toko', 'berlaku_mulai', 'berakhir_sampai', 'keterangan', 'waktu', 'last_waktu_update', 'insert_by', 'last_update_by', 'deleted_at', 'last_softdelete_by'], 'safe'],
            [['anggota_id', 'rupiah', 'rupiah_terpakai'], 'integer'],
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
        $query = Voucher::find();

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
            'anggota_id' => $this->anggota_id,
        ]);

        $query->andFilterWhere(['ilike', 'kode_voucher', $this->kode_voucher])
            ->andFilterWhere(['ilike', 'nama_voucher', $this->nama_voucher]);

        return $dataProvider;
    }
}
