<?php
/**
 * @link http://kangqingfei.cn/
 * @copyright Copyright (c) 2015 kangqingfei
 * @license MIT
 */

namespace frontend\controllers;

use common\models\LoginForm;
use Yii;
use frontend\models\RegisterForm;

/**
 * 前台默认控制器
 * @author kangqingfei <kangqingfei@gmail.com>
 * @since 1.0
 */
class FrontendController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string 默认方法
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * @return string|\yii\web\Response 登录方法
     */
    public function actionLogin()
    {
        $loginModel = new LoginForm();
        if ($loginModel->load(Yii::$app->request->post()) && $loginModel->login()) {
            Yii::$app->session->setFlash('alert', '登录成功');
            Yii::$app->session->setFlash('alert-type', 'alert-info');
            return $this->goBack();
        }
        else {
            return $this->render('login', ['loginModel' => $loginModel]);
        }
    }

    /**
     * @return array|string|\yii\web\Response 注册方法
     */
    public function actionRegister()
    {
        $registerModel = new RegisterForm();
        if (Yii::$app->request->isAjax && $registerModel->load($_POST)) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($registerModel);
        }
        if ($registerModel->load(Yii::$app->request->post())) {
            if ($user = $registerModel->register()) {
                Yii::$app->session->setFlash('alert', '注册成功');
                Yii::$app->session->setFlash('alert-type', 'alert-info');
                if (Yii::$app->getUser()->login($user, 3600 * 24)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('register', ['model' => $registerModel,]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }







    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person;

        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false) {
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->id]);
            } else {
                // error in saving model
            }
        }
        return $this->render('create', [
            'model'=>$model,
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFile = $model->getImageFile();
        $oldAvatar = $model->avatar;
        $oldFileName = $model->filename;

        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();

            // revert back if no valid file instance uploaded
            if ($image === false) {
                $model->avatar = $oldAvatar;
                $model->filename = $oldFileName;
            }

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false && unlink($oldFile)) { // delete old and overwrite
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->_id]);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // validate deletion and on failure process any exception
        // e.g. display an error message
        if ($model->delete()) {
            if (!$model->deleteImage()) {
                Yii::$app->session->setFlash('error', 'Error deleting image');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
