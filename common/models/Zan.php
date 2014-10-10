<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kblog_zan".
 *
 * @property integer $aid
 * @property integer $id
 * @property integer $uid
 */
class Zan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kblog_zan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'uid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => Yii::t('app', 'Aid'),
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
        ];
    }
}
