<?php
/**
 * @var $model Events
 */
echo '<h2>' . $model->name . '</h2>';
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'begin',
        'end',
        array(
            'name' => 'userid',
            'value' => User::getEmailSpecific($model->userid)
        ),
        array(
            'name' => 'roomid',
            'value' => Rooms::getNameSpecific($model->roomid)
        ),
    ),
));