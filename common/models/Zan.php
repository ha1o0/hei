<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zan".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $sid
 * @property string $time
 * @property string $zanip
 */
class Zan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'sid', 'time', 'zanip'], 'required'],
            [['uid', 'sid'], 'integer'],
            [['time'], 'safe'],
            [['zanip'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'sid' => 'Sid',
            'time' => 'Time',
            'zanip' => 'Zanip',
        ];
    }
}
