<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_location_prices".
 *
 * @property int $id_zakat_location_amount
 * @property int|null $id_location
 * @property int $id_category
 * @property float|null $price
 * @property string|null $created_at
 * @property string $updated_at
 */
class LocationPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_location_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_location', 'id_category'], 'integer'],
            [['id_category'], 'required'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_zakat_location_amount' => 'Id Zakat Location Amount',
            'id_location' => 'Id Location',
            'id_category' => 'Id Category',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
