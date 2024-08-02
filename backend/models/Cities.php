<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_cities".
 *
 * @property int $id_city
 * @property string $name
 * @property int $id_state
 * @property string $state_code
 * @property int $id_country
 * @property string $country_code
 * @property float $latitude
 * @property float $longitude
 * @property string $created_at
 * @property string $updated_at
 * @property int $flag
 * @property string|null $wikiDataId Rapid API GeoDB Cities
 *
 * @property Countries $country
 * @property States $state
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'id_state', 'state_code', 'id_country', 'country_code', 'latitude', 'longitude'], 'required'],
            [['id_state', 'id_country', 'flag'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'state_code', 'wikiDataId'], 'string', 'max' => 255],
            [['country_code'], 'string', 'max' => 2],
            [['id_state'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['id_state' => 'id_state']],
            [['id_country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['id_country' => 'id_country']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_city' => 'Id City',
            'name' => 'Name',
            'id_state' => 'Id State',
            'state_code' => 'State Code',
            'id_country' => 'Id Country',
            'country_code' => 'Country Code',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flag' => 'Flag',
            'wikiDataId' => 'Wiki Data ID',
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id_country' => 'id_country']);
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(States::className(), ['id_state' => 'id_state']);
    }
}
