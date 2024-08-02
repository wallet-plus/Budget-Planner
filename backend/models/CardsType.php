<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_cards_type".
 *
 * @property int $id_cards_type
 * @property string|null $name
 */
class CardsType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_cards_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cards_type' => 'Id Cards Type',
            'name' => 'Name',
        ];
    }
}
