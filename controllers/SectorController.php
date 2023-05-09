<?php

namespace app\controllers;

use app\models\Sector;
use app\models\SectorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * SectorController implements the CRUD actions for Sector model.
 */
class SectorController extends Controller
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
     * Lists all Sector models.
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

        $searchModel = new SectorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sector model.
     * @param int $sectorId Sector ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sectorId)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        return $this->render('view', [
            'model' => $this->findModel($sectorId),
        ]);
    }

    /**
     * Creates a new Sector model.
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

        $model = new Sector();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sectorId' => $model->sectorId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sector model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $sectorId Sector ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sectorId)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $model = $this->findModel($sectorId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sectorId' => $model->sectorId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sector model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $sectorId Sector ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sectorId)
    {
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }

        $this->findModel($sectorId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $sectorId Sector ID
     * @return Sector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sectorId)
    {
        if (($model = Sector::findOne(['sectorId' => $sectorId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
