<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "state".
 *
 * @property string $id
 * @property string $uid
 * @property string $content
 * @property string $time
 * @property integer $solved
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'content', 'time'], 'required'],
            [['uid', 'solved'], 'integer'],
            [['time'], 'safe'],
            [['content'], 'string', 'max' => 250, 'message' => '字数不能超过250哦'],
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
            'content' => 'Content',
            'time' => 'Time',
            'solved' => 'Solved',
        ];
    }
}
