<?php
/**
 * Created by PhpStorm.
 * User: fzyminkowski
 * Date: 2017-06-10
 * Time: 00:31
 */
/**
 * @var $model Events
 * @var $provider CActiveDataProvider
 */
echo '<h2>' . $model->name . '</h2>';
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'capacity',
        array(
            'name' => 'multimedia',
            'value' => ($model->multimedia === 1) ? 'Yes' : 'No'
        )
    ),
)); ?>
    <h3><br/>Room equipment</h3>
<?php
$gridColumns = array(
    'name',
    'codename',
);

$this->widget(
    'bootstrap.widgets.TbGridView',
    array(
        'dataProvider' => $provider,
        'template' => "{items} {summary}",
        'columns' => $gridColumns,
    )
);
if (User::getType() === 1)
    echo CHtml::linkButton('Create Room', array(
        'class' => 'btn btn-success',
        'href' => Yii::app()->createAbsoluteUrl('/rooms/create')
    ));