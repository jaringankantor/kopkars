<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Anggota;

/**
 * AnggotaSearch represents the model behind the search form of `common\models\Anggota`.
 */
class AnggotaSearch extends Anggota
{
    /**
     * {@inheritdoc}
     */

    public $keyword;

    public function rules()
    {
        return [
            [['keyword', 'nomor_anggota', 'nomor_pegawai', 'email_last_lock', 'nomor_hp_last_lock', 'nomor_ktp', 'nama_lengkap', 'pendidikanterakhir', 'alamat_rumah', 'nomor_npwp', 'keterangan'], 'safe'],
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
        $query = Anggota::findAnggota()->where('nomor_anggota IS NOT NULL OR waktu_approve IS NOT NULL');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['nama_lengkap'=>SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['or',['ilike', 'nomor_anggota', $this->keyword],['ilike', 'email_last_lock', $this->keyword],['ilike', 'nomor_hp_last_lock', $this->keyword],['ilike', 'nama_lengkap', $this->keyword]]);

        return $dataProvider;
    }
}
