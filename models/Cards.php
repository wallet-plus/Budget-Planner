<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bt_cards".
 *
 * @property int $id_card
 * @property int|null $id_cards_type
 * @property int|null $id_customer
 * @property string $name
 * @property string|null $image
 */
class Cards extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bt_cards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cards_type', 'id_customer'], 'integer'],
            [['name'], 'required'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_card' => 'Id Card',
            'id_cards_type' => 'Id Cards Type',
            'id_customer' => 'Id User',
            'name' => 'Name',
            'image' => 'Image',
        ];
    }
}
