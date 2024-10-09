<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Expense;

/**
 * ExpenseSearch represents the model behind the search form of `app\models\Expense`.
 */
class ExpenseSearch extends Expense
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_expense', 'id_type', 'id_customer', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['expense_name', 'image', 'amount', 'date_created', 'date_updated'], 'safe'],
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
        $query = Expense::find();

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
            'id_expense' => $this->id_expense,
            'id_type' => $this->id_type,
            'id_customer' => $this->id_customer,
            'deleted' => $this->deleted,
            'created_by' => $this->created_by,
            'date_created' => $this->date_created,
            'updated_by' => $this->updated_by,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'expense_name', $this->expense_name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'amount', $this->amount]);

        return $dataProvider;
    }
}
