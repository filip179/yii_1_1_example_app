<h2>Events</h2>
<?php
/**
 * Created by PhpStorm.
 * User: fzyminkowski
 * Date: 2017-06-10
 * Time: 00:31
 */
/**
 * @var $provider CActiveDataProvider
 */

$gridColumns = array(
    array('name' => 'name'),
    array('name' => 'begin'),
    array('name' => 'end'),
    array('name' => 'userid', 'value' => 'User::getEmailSpecific($data->userid)'),
    array('name' => 'roomid', 'value' => 'Rooms::getNameSpecific($data->roomid)'),
    array(
        'htmlOptions' => array('nowrap' => 'nowrap'),
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'viewButtonUrl' => '\'/events/view/\'.$data->id',
        'updateButtonUrl' => '\'/events/update/\'.$data->id',
        'deleteButtonUrl' => '\'/events/delete/\'.$data->id',
    )
);

$this->widget(
    'bootstrap.widgets.TbGridView',
    array(
        'dataProvider' => $provider,
        'template' => "{items} {summary}",
        'columns' => $gridColumns,
    )
);


    echo CHtml::linkButton('Create Event', array(
        'class' => 'btn btn-success',
        'href' => Yii::app()->createAbsoluteUrl('/events/create')
    ));
