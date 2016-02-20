<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "statement".
 *
 * @property integer $id
 * @property string $scomment
 * @property integer $scid
 * @property string $sctime
 * @property string $sid
 * @property string $sip
 */
class Statement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scid', 'sctime', 'sid', 'sip'], 'required'],
            [['scid', 'sid'], 'integer'],
            [['sctime'], 'safe'],
            [['scomment'], 'string', 'max' => 255],
            [['sip'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scomment' => 'Scomment',
            'scid' => 'Scid',
            'sctime' => 'Sctime',
            'sid' => 'Sid',
            'sip' => 'Sip',
        ];
    }
}
