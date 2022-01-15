<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AnggotaSimpanan;

/**
 * AnggotaSimpananSearch represents the model behind the search form of `common\models\AnggotaSimpanan`.
 */
class AnggotaSimpananSearch extends AnggotaSimpanan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'anggota_id', 'rupiah'], 'integer'],
            [['kode_toko', 'simpanan', 'debitkredit', 'keterangan', 'waktu', 'last_waktu_update', 'insert_by', 'last_update_by', 'deleted_at', 'last_softdelete_by'], 'safe'],
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
        $query = AnggotaSimpanan::findAnggotaSimpanan();

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
            'simpanan' => $this->simpanan,
            'debitkredit' => $this->debitkredit,
            //'waktu' => $this->waktu,
        ]);
        
        return $dataProvider;
    }
}
