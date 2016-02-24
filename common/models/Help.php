<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "help".
 *
 * @property integer $id
 * @property integer $helperuid
 * @property string $helptime
 * @property string $sid
 * @property string $helpip
 */
class Help extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'help';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['helperuid', 'helptime', 'sid', 'helpip'], 'required'],
            [['helperuid', 'sid'], 'integer'],
            [['helptime'], 'safe'],
            [['helpip'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'helperuid' => 'Helperuid',
            'helptime' => 'Helptime',
            'sid' => 'Sid',
            'helpip' => 'Helpip',
        ];
    }
}
