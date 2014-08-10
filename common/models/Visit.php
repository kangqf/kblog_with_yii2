<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kblog_visit".
 *
 * @property integer $vid
 * @property integer $uid
 * @property integer $visit_time
 * @property string $visitor_ip
 * @property string $visitor_host
 * @property string $visitor_browser_name
 * @property string $visitor_browser_platform
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kblog_visit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'visit_time'], 'integer'],
            [['visitor_ip'], 'string', 'max' => 32],
            [['visitor_host', 'visitor_browser_platform'], 'string', 'max' => 20],
            [['visitor_browser_name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vid' => 'Vid',
            'uid' => 'Uid',
            'visit_time' => 'Visit Time',
            'visitor_ip' => 'Visitor Ip',
            'visitor_host' => 'Visitor Host',
            'visitor_browser_name' => 'Visitor Browser Name',
            'visitor_browser_platform' => 'Visitor Browser Platform',
        ];
    }
}
