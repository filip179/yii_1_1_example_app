<h2>Rooms</h2>
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
    'name',
    'capacity',
    array('name' => 'multimedia', 'value' => '($data->multimedia===1)?\'Yes\':\'No\''),
    array(
        'htmlOptions' => array('nowrap' => 'nowrap'),
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'viewButtonUrl' => '\'/rooms/view/\'.$data->id',
        'updateButtonUrl' => '\'/rooms/update/\'.$data->id',
        'deleteButtonUrl' => '\'/rooms/delete/\'.$data->id',
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
    echo CHtml::linkButton('Create Room', array(
        'class' => 'btn btn-success',
        'href' => Yii::app()->createAbsoluteUrl('/rooms/create')
    ));