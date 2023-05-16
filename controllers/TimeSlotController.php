<?php

namespace app\controllers;

use app\models\TimeSlot;
use app\models\TimeSlotSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimeSlotController implements the CRUD actions for TimeSlot model.
 */
class TimeSlotController extends Controller
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
     * Lists all TimeSlot models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TimeSlotSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TimeSlot model.
     * @param int $timeSlotId Time Slot ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($timeSlotId)
    {
        return $this->render('view', [
            'model' => $this->findModel($timeSlotId),
        ]);
    }

    /**
     * Creates a new TimeSlot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TimeSlot();

        if ($this->request->isPost) {
            $model->load($this->request->post());

            if ($model->save()) {
                \Yii::warning($model->errors);
                return $this->redirect(['view', 'timeSlotId' => $model->timeSlotId]);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TimeSlot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $timeSlotId Time Slot ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($timeSlotId)
    {
        $model = $this->findModel($timeSlotId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'timeSlotId' => $model->timeSlotId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TimeSlot model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $timeSlotId Time Slot ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($timeSlotId)
    {
        $this->findModel($timeSlotId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TimeSlot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $timeSlotId Time Slot ID
     * @return TimeSlot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($timeSlotId)
    {
        if (($model = TimeSlot::findOne(['timeSlotId' => $timeSlotId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
