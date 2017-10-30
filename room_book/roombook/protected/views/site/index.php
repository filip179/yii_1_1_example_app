<?php
echo CHtml::linkButton('Create Event', array(
    'class' => 'btn btn-success btn-lg',
    'href' => Yii::app()->createAbsoluteUrl('/events/create')
)); ?>
    <br/>
    <br/>
    <br/>
<?php
/**
 * @var $events array of events
 */
$this->widget('ext.EFullCalendar.EFullCalendar', array(
    'htmlOptions' => array(
        'style' => 'width:100%'
    ),
    'options' => array(
        'header' => array(
            'left' => 'prev,next',
            'center' => 'title',
            'right' => 'today'
        ),
        'lazyFetching' => true,
        'events' => $events,
    )
));