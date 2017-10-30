<?php
$this->pageTitle = Yii::app()->name . ' - Login';
?>
<div class="col-xs-offset-4 col-xs-7">
    <h1>Login</h1>
</div>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableAjaxValidation' => true,
)); ?>

<div class="col-xs-offset-4 col-xs-7">
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email'); ?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div class="col-xs-offset-4 col-xs-7">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password'); ?>
    <?php echo $form->error($model, 'password'); ?>
    <p class="hint">
        Hint: You may login with <tt>demo/demo</tt>.
    </p>
</div>

<div class="col-xs-offset-4 col-xs-7">
    <?php echo CHtml::submitButton('Login'); ?>
</div>

<?php $this->endWidget(); ?>
