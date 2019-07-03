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
    )
);
?>
    <legend>User</legend>

<?php echo $form->textFieldRow(
    $model,
    'email'
);
echo $form->dropDownListRow(
    $model,
    'type',
    array(0 => 'User', 1 => 'Administrator'),
    array('empty' => 'Pick role..')
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
        ); ?>
    </div>
<?php
$this->endWidget();
unset($form);