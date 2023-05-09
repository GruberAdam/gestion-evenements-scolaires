<?php

namespace app\controllers;

use app\models\Account;
use app\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use app\models\ResetPasswordForm;
use yii\db\Exception;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
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
     * Lists all Account models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $personal = 0)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            if ($id == Yii::$app->user->id){
                return $this->render('personalView', [
                    'model' => $this->findModel($id),
                ]);

            }else{
                $name = "Permissions";
                $message = "Vous n'êtes pas authorisé sur cette page";
                return $this->render('error', ['name' => $name, 'message' => $message]);
            }
        }
        if ($personal == 1){
            return $this->render('personalView', [
                'model' => $this->findModel($id),
            ]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $model = new Account();

        if ($this->request->isPost) {
            $model->load($this->request->post());

            $model->isAdmin = 0;
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $model->authKey = Yii::$app->security->generateRandomString();

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $personal = 0)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            if ($id == Yii::$app->user->id){
                $model = $this->findModel($id);
                if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('personalUpdate', [
                    'model' => $model,
                ]);
            }else{
                $name = "Permissions";
                $message = "Vous n'êtes pas authorisé sur cette page";
                return $this->render('error', ['name' => $name, 'message' => $message]);
            }
        }
        $model = $this->findModel($id);

        // This part is for admins
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($personal == 1){
            return $this->render('personalUpdate', [
                'model' => $model,
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionResetPassword()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new ResetPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->resetPasswords(Yii::$app->user->id)) {
            $account = new Account();

            $account = $this->findModel(Yii::$app->user->id);
            Yii::warning($account->password);
            $account->password = Yii::$app->getSecurity()->generatePasswordHash($model->newPassword);
            Yii::warning($account->password);
            if ($account->save()) {
                return $this->goBack();
            }
        }
        return $this->render('resetPassword', ['model' => $model]);
    }


    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
