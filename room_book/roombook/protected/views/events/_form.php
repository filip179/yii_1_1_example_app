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

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'eventForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
        'enableAjaxValidation' => TRUE,
        'clientOptions' => array(
            'afterValidateAttribute' => 'js:function(form, attribute, data, hasError){if(isEmptyData(data) && !hasError){ $(\'#eventSubmit\').attr(\'class\',\'btn btn-primary\'); $(\'#eventSubmit\').attr(\'disabled\',false); } else { $(\'#eventSubmit\').attr(\'disabled\',true); } }',
            'validateOnChange' => TRUE,
        ),
    )
);
?>
<script type="application/javascript">
    function isEmptyData(data){
        for(var i in data){
            if(data.hasOwnProperty(i))
                return false;
        }
        return true;
    }
</script>
    <legend>Event</legend>
<?php
echo $form->dropDownListRow(
    $model,
    'roomid',
    CHtml::listData(Rooms::model()->findAll(), 'id', 'name'),
    array('empty' => 'Pick room..')
);

echo $form->textFieldRow(
    $model,
    'name'
);
echo $form->dateTimePickerRow(
    $model,
    'begin'
);
echo $form->dateTimePickerRow(
    $model,
    'end'
);
 ?>
    <div class="form-actions">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Submit',
                'id' => 'eventSubmit'
            )
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array('buttonType' => 'reset', 'label' => 'Reset' )
        ); ?>
    </div>
<?php
$this->endWidget();
unset($form);