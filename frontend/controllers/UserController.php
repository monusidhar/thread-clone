<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\SignupForm;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('listUser')) {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            // echo "<pre>";
            // print_r($dataProvider->getModels());
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            \Yii::$app->session->setFlash('error', 'Unauthorized action.');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewUser')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            \Yii::$app->session->setFlash('error', 'Unauthorized action.');
            return $this->redirect(['site/index']);
        }
       
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $signupForm = new SignupForm();
        $signupForm->populateUserForm($id);

        if (\Yii::$app->user->can('updateUser')) {
            if($this->request->isPost){
                if ($signupForm->load(\Yii::$app->request->post(), 'SignupForm')) {
                    if ($signupForm->updateLoadedUser($id)) {
                        return $this->redirect(['view', 'id' => $id]);
                    }
                }
            }
            return $this->render('update', [
                'model' => $signupForm,
            ]);
        } else {
            \Yii::$app->session->setFlash('error', 'Unauthorized action.');
            return $this->redirect(['site/index']);
        }
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteUser')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            \Yii::$app->session->setFlash('error', 'Unauthorized action.');
            return $this->redirect(['site/index']);
        }
      
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
