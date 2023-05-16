<?php

namespace app\controllers;

use app\models\Event;
use app\models\Registration;
use app\models\RegistrationSearch;
use app\models\TimeSlot;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistrationController implements the CRUD actions for Registration model.
 */
class RegistrationController extends Controller
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
     * Lists all Registration models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registration model.
     * @param int $eventAccountId Event Account ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($eventAccountId)
    {
        return $this->render('view', [
            'model' => $this->findModel($eventAccountId),
        ]);
    }

    /**
     * Creates a new Registration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Registration();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'eventAccountId' => $model->eventAccountId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Registration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $eventAccountId Event Account ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($eventAccountId)
    {
        $model = $this->findModel($eventAccountId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'eventAccountId' => $model->eventAccountId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Registration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $eventAccountId Event Account ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($eventAccountId)
    {
        $this->findModel($eventAccountId)->delete();

        return $this->redirect(['index']);
    }

    public function actionCalendar()
    {
        $timeSlots = TimeSlot::find()->all();
        $events = [];

        foreach ($timeSlots as $timeSlot){
            $fullCalendarEvent = new \yii2fullcalendar\models\Event();

            $event = Event::findOne(['id' => $timeSlot->eventId]);
            $fullCalendarEvent->id = $event->id;
            $fullCalendarEvent->title = $event->title;
            $fullCalendarEvent->start = str_replace("00:00:00", $timeSlot->startTime, $timeSlot->date);
            $fullCalendarEvent->end = str_replace("00:00:00", $timeSlot->endTime, $timeSlot->date);
            $events[] = $fullCalendarEvent;
        }


        return $this->render('calendar', [
            'events' => $events
        ]);
    }


    /**
     * Finds the Registration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $eventAccountId Event Account ID
     * @return Registration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($eventAccountId)
    {
        if (($model = Registration::findOne(['eventAccountId' => $eventAccountId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
