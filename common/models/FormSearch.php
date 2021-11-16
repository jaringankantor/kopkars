<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Form;

/**
 * FormSearch represents the model behind the search form of `common\models\Form`.
 */
class FormSearch extends Form
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'sheet_name', 'deskripsi', 'file_excel', 'file_extension', 'file_name', 'file_type'], 'safe'],
            [['baris_header', 'baris_isi', 'file_size'], 'integer'],
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
        $query = Form::find();

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
            'baris_header' => $this->baris_header,
            'baris_isi' => $this->baris_isi,
            'file_size' => $this->file_size,
        ]);

        $query->andFilterWhere(['ilike', 'kode', $this->kode])
            ->andFilterWhere(['ilike', 'sheet_name', $this->sheet_name])
            ->andFilterWhere(['ilike', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['ilike', 'file_excel', $this->file_excel])
            ->andFilterWhere(['ilike', 'file_extension', $this->file_extension])
            ->andFilterWhere(['ilike', 'file_name', $this->file_name])
            ->andFilterWhere(['ilike', 'file_type', $this->file_type]);

        return $dataProvider;
    }
}
