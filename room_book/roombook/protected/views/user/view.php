<?php
/**
 * Created by PhpStorm.
 * User: fzyminkowski
 * Date: 2017-06-10
 * Time: 00:31
 */
/**
 * @var $model Events
 */
echo '<h2>' . $model->email . '</h2>';
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'type',
            'value' => ($model->type === 1) ? 'Administrator' : 'User'
        )
    ),
));