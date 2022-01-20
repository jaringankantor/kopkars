<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cicilan;

/**
 * CicilanSearch represents the model behind the search form of `common\models\Cicilan`.
 */
class CicilanSearch extends Cicilan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'anggota_id', 'cicilan'], 'integer'],
            [['kode_toko', 'kanal_cicilan', 'nomor_referensi', 'keterangan', 'waktu', 'last_waktu_update', 'insert_by', 'last_update_by', 'deleted_at', 'last_softdelete_by'], 'safe'],
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
        $query = Cicilan::findCicilan();

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
            'kanal_cicilan' => $this->kanal_cicilan,
        ]);

        return $dataProvider;
    }
}
