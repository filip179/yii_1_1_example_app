<?php

class UserController extends Controller
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
        $this->render('index', array('provider' => User::findAllProvider()));
    }

    /**
     * View
     *
     * @param $id
     */
    public function actionView($id)
    {
        $model = User::model()->findByPk($id);

        $this->render('view', array('model' => $model));
    }


    /**
     * Create action
     */
    public function actionCreate()
    {
        if (User::getType() === 1) {
            $model = new User();

            if (isset($_POST['User'])) {
                $model->attributes = $_POST['User'];

                if ($model->save()) {
                    $this->redirect('/user/view/' . $model->id);
                }
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
            $model = User::model()->findByPk($id);

            if (isset($_POST['User'])) {
                $model->attributes = $_POST['User'];

                if ($model->save()) {
                    $this->redirect('/user/view/' . $model->id);
                }
            }

            $this->render('_form', array('model' => $model));
        } else {
            throw new CHttpException('403');
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
            $model = User::model()->findByPk($id);
            $model->delete();

            $this->redirect('/rooms/index');
        } else {
            throw new CHttpException('403');
        }
    }
}
