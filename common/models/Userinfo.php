<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userinfo".
 *
 * @property string $uid
 * @property string $truename
 * @property string $birthday
 * @property string $gender
 * @property integer $qq
 * @property string $weixin
 * @property string $phone
 * @property integer $provinceid
 * @property integer $cityid
 * @property integer $areaid
 * @property string $address
 * @property string $hobby
 * @property string $university
 * @property string $smallp
 * @property string $middlep
 * @property string $bigp
 */
class Userinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'qq', 'provinceid', 'cityid', 'areaid'], 'integer'],
            [['truename', 'birthday', 'weixin', 'address', 'university'], 'string', 'max' => 45],
            [['gender'], 'string', 'max' => 5],
            [['phone'], 'string', 'max' => 12],
            [['hobby'], 'string', 'max' => 225],
            [['smallp', 'middlep', 'bigp'], 'string', 'max' => 50],
            [['uid'], 'unique'],
            [['phone'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'truename' => 'Truename',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'qq' => 'Qq',
            'weixin' => 'Weixin',
            'phone' => 'Phone',
            'provinceid' => 'Provinceid',
            'cityid' => 'Cityid',
            'areaid' => 'Areaid',
            'address' => 'Address',
            'hobby' => 'Hobby',
            'university' => 'University',
            'smallp' => 'Smallp',
            'middlep' => 'Middlep',
            'bigp' => 'Bigp',
        ];
    }
}
