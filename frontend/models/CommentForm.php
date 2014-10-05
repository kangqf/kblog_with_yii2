<?php
/**
 * Created by PhpStorm.
 * User: kqf
 * Date: 14-10-5
 * Time: 下午1:19
 */
namespace frontend\models;

use common\models\Article;
use common\models\Comment;
use yii\base\Model;
use Yii;
use kartik\markdown\Markdown;

/**
 * Password reset form
 */
class CommentForm extends Model
{
    public $message;
    public $aid;

    public function rules()
    {
        return [
            // username and password are both required
            [['aid', 'message'], 'required'],
            [['aid',], 'integer'],
        ];
    }

    public function comment()
    {
        if ($this->validate()) {

            $comment = new Comment();
            $comment->article_id = $this->aid;
            $comment->user_id = Yii::$app->getUser()->getId();
            $comment->message = Markdown::convert($this->message);
            $comment->ip = Yii::$app->request->userIP;
            if ($comment->save())
            {
                if(Article::plusCommentCountByArticleId( $this->aid))
                    return true;
                else
                    return false;
            }

            else
                return false;

        }
        else {
            return false;
        }
    }
    public function attributeLabels()
    {
       return ['message' => '评论',];
    }

}
