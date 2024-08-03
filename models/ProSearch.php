<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProSearch represents the model behind the search form of `app\models\Products`.
 */
class ProSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'stock_quantity'], 'integer'],
            [['productName', 'category', 'date_added', 'image'], 'safe'],
            [['price'], 'number'],
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
        $query = Products::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'date_added' => $this->date_added,
        ]);

        $query->andFilterWhere(['like', 'productName', $this->productName])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
