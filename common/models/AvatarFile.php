<?php
namespace common\models;

use yii\mongodb\file\ActiveRecord;
use yii\mongodb\file\Query;

/**
 * Class Asset
 * @package common\models
 * @property string $_id MongoId
 * @property array $filename
 * @property string $uploadDate
 * @property string $length
 * @property string $chunkSize
 * @property string $md5
 * @property array $file
 * @property string $newFileContent
 * Must be application/pdf, image/png, image/gif etc...
 * @property string $contentType
 * @property string $description
 */
class AvatarFile extends ActiveRecord
{

    public static function collectionName()
    {
        return 'avatar';
    }

    public function rules()
    {
        return[
            [['contentType'], 'required'],
        ];
    }

    public function attributes()
    {
          return array_merge(
              parent::attributes(),
              ['contentType']
          );
    }

    //size: 1->小图像  2->中等大小图像 3->原始图像
    public function getAvatar($fileName, $size = 1)
    {
        switch ($size) {
            case 1:
                $file = 'SMALL' . $fileName;
                break;
            case 2:
                $file = 'MIDDLE' . $fileName;
                break;
            case 3:
                $file = 'ORIGIN' . $fileName;
                break;
                defaut:
                $file = 'SMALL' . $fileName;
                break;
        }
         $val = $this->findOne(['filename' => $file]);
        if($val)
            return $val;
        else
            return false;
      //  dump($val);die();

//        $query = new Query();
//        $row = $query->from('avatar')->where(['filename' => $file])->one();
//        if ($row != null) {
//            return ['contentType' => $row['contentType'], 'byte' => $row['file']->getBytes()];
//        } else {
//            return false;
//        }


    }

}
?>
