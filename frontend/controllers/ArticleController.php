<?php

    namespace frontend\controllers;

    use common\models\Article;
    use common\models\ArticleSearch;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;
    use yii\behaviors\TimestampBehavior;
    use yii\db\Expression;

    /**
     * ArticleController implements the CRUD actions for article model.
     */
    class ArticleController extends Controller
    {
        /**
         * @inheritDoc
         */
        public function behaviors()
        {
            return [
                'access'=> [
                    'class' => \yii\filters\AccessControl::class,
                    'only' => ['view'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ];
        }


        /**
         * Lists all article models.
         *
         * @return string
         */
        public function actionIndex()
        {
            if (\Yii::$app->user->can('listArticle')) {
                $searchModel = new ArticleSearch();
                $dataProvider = $searchModel->search($this->request->queryParams);
        
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else{
                \Yii::$app->session->setFlash('error', 'Unauthorized action.');
                return $this->redirect(['site/index']);
            }
        }

        /**
         * Displays a single article model.
         * @param int $id ID
         * @return string
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionView($id)
        {
            if (\Yii::$app->user->can('viewArticle')) {
                try{
                    $model = $this->findModel($id);
                    return $this->render('view', [
                        'model' => $model,
                    ]);
                }catch(NotFoundHttpException $e){
                    \Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }else{
                \Yii::$app->session->setFlash('error', 'Unauthorized action.');
                return $this->redirect(['site/index']);
            }
            
        }

        /**
         * Creates a new article model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return string|\yii\web\Response
         */
        public function actionCreate()
        {
            if (\Yii::$app->user->can('createArticle')) {
                $model = new Article();
                if ($this->request->isPost) {
                    if ($model->load($this->request->post()) && $model->save()) {
                        return $this->redirect('index');
                    }
                }

                return $this->render('create', [
                    'model' => $model,
                ]);
            } else {
                \Yii::$app->session->setFlash('error', 'Unauthorized action.');
                return $this->redirect(['site/index']);
            }
        }

        /**
         * Updates an existing article model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param int $id ID
         * @return string|\yii\web\Response
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionUpdate($id)
        {
            if (\Yii::$app->user->can('updateArticle')) {
                $model = $this->findModel($id);

                if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
        
                return $this->render('update', [
                    'model' => $model,
                ]);
            }else{
                \Yii::$app->session->setFlash('error', 'Unauthorized action.');
                return $this->redirect(['site/index']);
            }
            
        }

        /**
         * Deletes an existing article model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param int $id ID
         * @return \yii\web\Response
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionDelete($id)
        {
            if (\Yii::$app->user->can('deleteArticle')) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            }else{
                \Yii::$app->session->setFlash('error', 'Unauthorized action.');
                return $this->redirect(['site/index']);
            }
            
        }

        /**
         * Finds the article model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param int $id ID
         * @return article the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id)
        {
            if (($model = article::findOne(['id' => $id])) !== null) {
                return $model;
            }

            throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
        }
    }
