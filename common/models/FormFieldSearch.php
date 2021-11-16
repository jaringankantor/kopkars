<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FormField;

/**
 * FormFieldSearch represents the model behind the search form of `common\models\FormField`.
 */
class FormFieldSearch extends FormField
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['kode_form', 'kode_field', 'nama_field_excel', 'deskripsi'], 'safe'],
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
        $query = FormField::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'kode_form', $this->kode_form])
            ->andFilterWhere(['ilike', 'kode_field', $this->kode_field])
            ->andFilterWhere(['ilike', 'nama_field_excel', $this->nama_field_excel])
            ->andFilterWhere(['ilike', 'deskripsi', $this->deskripsi]);

        return $dataProvider;
    }
}
