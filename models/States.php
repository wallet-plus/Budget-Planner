<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_states".
 *
 * @property int $id_state
 * @property string $name
 * @property int $id_country
 * @property string $country_code
 * @property string|null $fips_code
 * @property string|null $iso2
 * @property string|null $type
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $created_at
 * @property string $updated_at
 * @property int $flag
 * @property string|null $wikiDataId Rapid API GeoDB Cities
 *
 * @property Cities[] $cities
 * @property Countries $country
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_states';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'id_country', 'country_code'], 'required'],
            [['id_country', 'flag'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'fips_code', 'iso2', 'wikiDataId'], 'string', 'max' => 255],
            [['country_code'], 'string', 'max' => 2],
            [['type'], 'string', 'max' => 191],
            [['id_country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['id_country' => 'id_country']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_state' => 'Id State',
            'name' => 'Name',
            'id_country' => 'Id Country',
            'country_code' => 'Country Code',
            'fips_code' => 'Fips Code',
            'iso2' => 'Iso 2',
            'type' => 'Type',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flag' => 'Flag',
            'wikiDataId' => 'Wiki Data ID',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['id_state' => 'id_state']);
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
}
