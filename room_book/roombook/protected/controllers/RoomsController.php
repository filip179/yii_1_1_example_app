<?php

class RoomsController extends Controller
{
    public $layout = 'column1';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * Renders site/index with calendar view
     */
    public function actionIndex()
    {
        $this->render('index', array('provider' => Rooms::findAllProvider()));
    }

    /**
     * View
     *
     * @param $id
     */
    public function actionView($id)
    {
        $model = Rooms::model()->findByPk($id);
        $provider = Equipment::findAllProvider($id);

        $this->render('view', array('model' => $model, 'provider' => $provider));
    }


    /**
     * Create action
     */
    public function actionCreate()
    {
        if (User::getType() === 1) {
            $model = new Rooms();

            if (isset($_POST['Rooms'])) {
                $model->attributes = $_POST['Rooms'];

                if ($model->save())
                    $this->redirect('/rooms/view/' . $model->id);
            }
            $this->render('_form', array('model' => $model));
        } else {
            throw new CHttpException(403);
        }
    }

    /**
     * Update action
     *
     * @param $id
     */
    public function actionUpdate($id)
    {
        if (User::getType() === 1) {
            $model = Rooms::model()->findByPk($id);
            if (isset($_POST['Equipment'])) {
                $submodel = new Equipment();
                $submodel->attributes = $_POST['Equipment'];

                if ($submodel->save())
                    $this->redirect('/rooms/update/' . $model->id);
            }

            if (isset($_POST['Rooms'])) {
                $model->attributes = $_POST['Rooms'];

                if ($model->save())
                    $this->redirect('/rooms/view/' . $model->id);
            }

            $this->render('_form', array('model' => $model));
        } else {
            throw new CHttpException(403);
        }
    }

    /**
     * Deletes specific model
     *
     * @param $id
     */
    public function actionDelete($id)
    {
        if (User::getType() === 1) {
            $model = Rooms::model()->findByPk($id);
            $model->delete();

            $this->redirect('/rooms/index');
        } else {
            throw new CHttpException(403);
        }
    }
}
