<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    // This will be used in "joinWith" part of $query
    public function getBook()
    {
        return $this->hasMany(Book::className(), ['author_id' => 'id']);
    }

    // This will be in $dataProvider->sort step
    public function getCountbook()
    {
        return $this->hasMany(Book::className(), ['author_id' => 'id'])->count();
    }
}
