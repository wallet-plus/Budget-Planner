<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_countries".
 *
 * @property int $id_country
 * @property string|null $name
 * @property string|null $iso3
 * @property string|null $numeric_code
 * @property string|null $iso2
 * @property string|null $phonecode
 * @property string|null $capital
 * @property string|null $currency
 * @property string|null $currency_name
 * @property string|null $currency_symbol
 * @property string|null $tld
 * @property string|null $native
 * @property string|null $region
 * @property int|null $region_id
 * @property string|null $subregion
 * @property int|null $subregion_id
 * @property string|null $nationality
 * @property string|null $timezones
 * @property string|null $translations
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $emoji
 * @property string|null $emojiU
 * @property string|null $created_at
 * @property string $updated_at
 * @property int|null $flag
 * @property string|null $wikiDataId
 *
 * @property Cities[] $cities
 * @property States[] $states
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'subregion_id', 'flag'], 'integer'],
            [['timezones', 'translations'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['iso3', 'numeric_code'], 'string', 'max' => 3],
            [['iso2'], 'string', 'max' => 2],
            [['phonecode', 'capital', 'currency', 'currency_name', 'currency_symbol', 'tld', 'native', 'region', 'subregion', 'nationality', 'wikiDataId'], 'string', 'max' => 255],
            [['emoji', 'emojiU'], 'string', 'max' => 191],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_country' => 'Id Country',
            'name' => 'Name',
            'iso3' => 'Iso 3',
            'numeric_code' => 'Numeric Code',
            'iso2' => 'Iso 2',
            'phonecode' => 'Phonecode',
            'capital' => 'Capital',
            'currency' => 'Currency',
            'currency_name' => 'Currency Name',
            'currency_symbol' => 'Currency Symbol',
            'tld' => 'Tld',
            'native' => 'Native',
            'region' => 'Region',
            'region_id' => 'Region ID',
            'subregion' => 'Subregion',
            'subregion_id' => 'Subregion ID',
            'nationality' => 'Nationality',
            'timezones' => 'Timezones',
            'translations' => 'Translations',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'emoji' => 'Emoji',
            'emojiU' => 'Emoji U',
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
        return $this->hasMany(Cities::className(), ['id_country' => 'id_country']);
    }

    /**
     * Gets query for [[States]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(States::className(), ['id_country' => 'id_country']);
    }
}
