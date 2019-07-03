<?php

class EventsController extends Controller
{
    public $layout = 'column1';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * View
     *
     * @param $id
     */
    public function actionView($id)
    {
        $model = Events::model()->findByPk($id);
        $this->render('view', array('model' => $model));
    }


    /**
     * Create action
     */
    public function actionCreate()
    {
        $model = new Events('create');
        $this->performAjaxValidation($model);
        if (isset($_POST['Events'])) {
            $model->attributes = $_POST['Events'];
            $this->performAjaxValidation($model);
            if ($model->save())
                $this->redirect('/events/view/' . $model->id);
        }
        $this->render('_form', array('model' => $model));

    }

    /**
     * Update action
     *
     * @param $id
     */
    public function actionUpdate($id)
    {
        $model = Events::model()->findByPk($id);
        if ($model->isOwner() || User::getType() == 1) {
            if (isset($_POST['Events'])) {
                $model->attributes = $_POST['Events'];
                $this->performAjaxValidation($model);
                if ($model->save())
                    $this->redirect('/events/view/' . $model->id);
            }
            $this->render('_form', array('model' => $model));
        } else
            $this->redirect('/events/index');
    }

    /**
     * Deletes specific model
     *
     * @param $id
     * @throws CDbException
     */
    public function actionDelete($id)
    {
        $model = Events::model()->findByPk($id);

        if ($model->isOwner() || User::getType() == 1) {
            $model->delete();
            $this->redirect('/events/index');
        } else {
            $this->redirect('/events/index');
        }
    }

    /**
     * Renders site/index with calendar view
     */
    public function actionIndex()
    {
        $this->render('index', array('provider' => Events::findAllProvider()));
    }


    /**
     * Performs the AJAX validation.
     *
     * @param Events $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'eventForm') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
