<?php
/**
 * Created by PhpStorm.
 * User: fzyminkowski
 * Date: 2017-06-10
 * Time: 00:31
 */
/**
 * @var $model Rooms
 */

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'roomForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
    )
);
?>
    <legend>Room</legend>

<?php echo $form->textFieldRow(
    $model,
    'name'
);
echo $form->numberFieldRow(
    $model,
    'capacity'
);
echo $form->dropDownListRow(
    $model,
    'multimedia',
    array(0 => 'No', 1 => 'Yes'),
    array('empty' => 'Yes or No')
); ?>
    <div class="form-actions">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Submit'
            )
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array('buttonType' => 'reset', 'label' => 'Reset')
        );
        $this->endWidget(); ?>
    </div>
    <legend>Equipment</legend>
<?php
$gridColumns = array(
    'name',
    'codename',
);

$this->widget(
    'bootstrap.widgets.TbGridView',
    array(
        'dataProvider' => Equipment::findAllProvider($model->id),
        'template' => "{items} {summary}",
        'columns' => $gridColumns,
    )
); ?>
    <h3>Add Equipment</h3>
<?php

if (!$model->isNewRecord) {
    $eq = new Equipment();
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'eqForm',
            'htmlOptions' => array('class' => 'well'), // for inset effect
        )
    ); ?>

    <?php echo $form->textFieldRow(
        $eq,
        'name'
    );
    echo $form->textFieldRow(
        $eq,
        'codename'
    );
    echo $form->hiddenField(
        $eq,
        'roomid',
        array(
            'value' => $model->id
        )
    ); ?>
    <div class="form-actions">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Add Equipment'
            )
        ); ?>
    </div>
    <?php
    $this->endWidget();
}