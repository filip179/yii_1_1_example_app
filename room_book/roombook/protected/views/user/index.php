<h2>Users</h2>
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
    array('name' => 'email'),
    array('name' => 'type', 'value' => '($data->type===1)?\'Administrator\':\'User\''),
    array(
        'htmlOptions' => array('nowrap' => 'nowrap'),
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'viewButtonUrl' => '\'/user/view/\'.$data->id',
        'updateButtonUrl' => '\'/user/update/\'.$data->id',
        'deleteButtonUrl' => '\'/user/delete/\'.$data->id',
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
if (User::getType() == 1)
    echo CHtml::linkButton('Create User', array(
        'class' => 'btn btn-success',
        'href' => Yii::app()->createAbsoluteUrl('/user/create')
    ));