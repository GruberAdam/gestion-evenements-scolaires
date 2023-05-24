<?php

namespace app\controllers;

use app\models\Apprentice;
use app\models\Event;
use app\models\Location;
use app\models\EventSearch;
use app\models\Registration;
use app\models\TimeSlot;
use app\models\TimeSlotSearch;
use Codeception\Lib\Connector\Yii2\ConnectionWatcher;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

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
        if (!Yii::$app->session->get('isAdmin')) {
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }
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
        if (Yii::$app->user->isGuest){
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }
        $model = new TimeSlot();

        if ($this->request->isPost) {
            $model->load($this->request->post());

            if ($model->save()) {
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
    public function actionUpdate($timeSlotId, $personal = 0)
    {
        if (Yii::$app->user->isGuest){
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }
        $model = $this->findModel($timeSlotId);

        if (Yii::$app->session->get('isAdmin')) {
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'timeSlotId' => $model->timeSlotId]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        if ($this->request->isPost) {
            $model->load($this->request->post());
            $location = Location::findOne(['locationId' => $model->titleLocationInput]);
            $event = Event::findOne(['id' => $model->eventId]);

            $event->locationId = $location->locationId;

            $event->update();

            Yii::warning($model->getErrors());


            if ($model->save()){
                return $this->redirect(['view', 'timeSlotId' => $model->timeSlotId]);
            }
        }
        return $this->render('myEventsUpdate', [
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
        if (Yii::$app->user->isGuest){
            $name = "Permissions";
            $message = "Vous n'êtes pas authorisé sur cette page";
            return $this->render('error', ['name' => $name, 'message' => $message]);
        }
        $this->findModel($timeSlotId)->delete();

        return $this->redirect(['index']);
    }

    public function actionMyEvents($id)
    {
        $searchModel = new TimeSlotSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $events = Event::findAll(['accountId' => $id]);

        $eventIds = [];
        foreach ($events as $event){
            array_push($eventIds, $event->id);
        }

        $dataProvider->query->where(['in', 'eventId', $eventIds]);

        return $this->render('myEvents', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddApprentice($id){
        $model = $this->findModel($id);

        if ($this->request->isPost){
            $model->load($this->request->post());

            # Delete all record from that slotId

            Registration::deleteAll(['timeSlotId' => $id]);

            if ($model->apprenticeSelected != null){
                foreach ($model->apprenticeSelected as $apprentice){
                    $registration = new Registration();
                    $registration->timeSlotId = $id;
                    $registration->apprenticeId = $apprentice;
                    $registration->save();
                }
            }
        }

        return $this->render('addApprentice', [
            'model' => $model
        ]);
    }

    public function actionCalendar()
    {
        $model = new TimeSlot();
        $timeSlots = TimeSlot::find()->all();
        $events = [];
        $apprentice = null;

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $apprentice = $model->displayCalendarAccount;

            $registrations = Registration::findAll(['apprenticeId' => $model->displayCalendarAccount]);

            foreach ($registrations as $registration) {
                $timeSlot = TimeSlot::findOne(['timeSlotId' => $registration->timeSlotId]);

                $fullCalendarEvent = new \yii2fullcalendar\models\Event();
                $event = Event::findOne(['id' => $timeSlot->eventId]);

                if (isset($event->id)){
                    $fullCalendarEvent->id = $event->id;
                    $fullCalendarEvent->title = $event->title;
                    $fullCalendarEvent->start = str_replace("00:00:00", $timeSlot->startTime, $timeSlot->date);
                    $fullCalendarEvent->end = str_replace("00:00:00", $timeSlot->endTime, $timeSlot->date);
                    $events[] = $fullCalendarEvent;
                }
            }

        }else{
            foreach ($timeSlots as $timeSlot){
                $fullCalendarEvent = new \yii2fullcalendar\models\Event();

                $event = Event::findOne(['id' => $timeSlot->eventId]);
                if (isset($event->id)){
                    $fullCalendarEvent->id = $event->id;
                    $fullCalendarEvent->title = $event->title;
                    $fullCalendarEvent->start = str_replace("00:00:00", $timeSlot->startTime, $timeSlot->date);
                    $fullCalendarEvent->end = str_replace("00:00:00", $timeSlot->endTime, $timeSlot->date);
                    $events[] = $fullCalendarEvent;
                }
            }
        }


        return $this->render('calendar', [
            'model' => $model,
            'events' => $events,
            'apprentice' => $apprentice
        ]);
    }

    public function actionGenerateIcs($id = null){
        if ($id == null){
            $timeSlots = TimeSlot::find()->all();
            $this->generateIcs($timeSlots);
        }else{
            $timeSlots = [];
            $registrations = Registration::findAll(['apprenticeId' => $id]);
            foreach ($registrations as $registration){
                array_push($timeSlots, TimeSlot::findOne(['timeSlotId' => $registration->timeSlotId]));
            }
            $this->generateIcs($timeSlots);
            }

        }

        protected function generateIcs($timeSlots){
            $eol = "\r\n";
            $search = array ('/"/',
                '/,/',
                '/\n/',
                '/\r/',
                '/;/',
                '/\\//');
            $replace = array ('\"',
                '\\,',
                '\\n',
                '',
                '\\;',
                '\\\\');

            $data = "BEGIN:VCALENDAR".$eol.
                "VERSION:2.0".$eol.
                "PRODID:-//project/author//NONSGML v1.0//EN".$eol.
                "CALSCALE:GREGORIAN".$eol.
                "METHOD:PUBLISH".$eol;

            foreach($timeSlots as $timeSlot){
                $data .= "BEGIN:VEVENT".$eol;
                $data .= "DTSTART;VALUE=DATE-TIME:".date("Ymd\THis\Z",strtotime(str_replace("00:00:00", "",$timeSlot->date)." ".  $timeSlot->startTime)).$eol;
                $data .= "DTEND;VALUE=DATE-TIME:".date("Ymd\THis\Z",strtotime(str_replace("00:00:00", "",$timeSlot->date)." ".  $timeSlot->endTime)).$eol;

                $data .= "UID:" . Yii::$app->security->generateRandomString() .$eol;
                $data .= "SEQUENCE:1.0".$eol;
                $data .= "LOCATION:".$timeSlot->event->location->title.$eol;
                $data .= "DTSTAMP:".date("Ymd\THis\Z").$eol;
                $data .= "SUMMARY:".preg_replace($search, $replace, $timeSlot->event->title).$eol;
                $data .= "DESCRIPTION:".preg_replace($search, $replace, $timeSlot->event->title).$eol;
                $data .= "X-ALT-DESC;FMTTYPE=text/html:<!DOCTYPE HTML><HTML><BODY>"."test"."</BODY></HTML>".$eol;
                if(!empty($event["with"])) foreach($event["with"] as $with){
                    $data .= "ATTENDEE:MAILTO:".$with.$eol;
                }
                //$data .= "URL:".$event["url"].$eol;
                $data .= "TRANSP:OPAQUE".$eol;
                $data .= "END:VEVENT".$eol;
            }
            $data .= "END:VCALENDAR";

            file_put_contents('calendrier.ics', $data);
            Yii::$app->response->sendFile('calendrier.ics');
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
