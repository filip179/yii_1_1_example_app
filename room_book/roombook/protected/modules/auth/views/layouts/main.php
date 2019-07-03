<?php
/* @var $this AuthController */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="layout-main">

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'brandLabel' => CHtml::encode(Yii::app()->name),
    'color' => TbHtml::NAVBAR_COLOR_INVERSE,
    'collapse' => true,

    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbNav',
            'items' => array(
                array('label' => 'Strona główna', 'url' => array('/site/index')),
                //array('label'=>'Admin', 'url'=>array('/site/page', 'view'=>'admin')),
                //array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label' => 'Zaloguj się', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => 'Wyloguj się (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="container" id="page" style="padding-top:60px;">


    <?php if (isset($this->breadcrumbs)): ?>

        <?php

        $brdc = array('Start' => '/urlopy');
        $brdc = $brdc + $this->breadcrumbs;
        echo TbHtml::breadcrumbs($brdc);

        /*
        $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        ));
        */
        ?>

    <?php endif ?>

    <div class="row">

        <div class="span2">
            <?php

            $adminMenu = array(
                array('label' => 'Użytkownicy', 'url' => array('user/admin')),
                array('label' => 'Grupy', 'url' => array('grupa/admin')),
                array('label' => 'Rodzaje', 'url' => array('rodzaj/admin')),
                array('label' => 'Rodzaje umów', 'url' => array('rodzajeUmowy/admin')),
                array('label' => 'Rodzaje zaświadczeń', 'url' => array('rodzajZaswiadczenia/admin')),
                array('label' => 'Słowniki', 'url' => array('dictionariesAssignments/index')),
                array('label' => 'Firmy', 'url' => array('/firma/admin')),
                array('label' => 'Uprawnienia', 'url' => array('auth/assignment/index')),
                array('label' => 'Konfiguracja', 'url' => array('site/konfiguracja')),
                array('label' => 'Kolejka Email', 'url' => array('email/admin')),
                array('label' => 'Import XML/RCP', 'url' => array('importXML/admin')),
                array('label' => 'Wynagrodzenia', 'url' => array('place/admin')),
                array('label' => 'Struktura', 'url' => array('conf/struct')),
                array('label' => 'Powiadomienia', 'url' => array('conf/popup')),
                array('label' => 'Bezpieczeństwo', 'url' => array('conf/safety')),

            );

            $this->widget('bootstrap.widgets.TbNav', array(
                'type' => TbHtml::NAV_TYPE_TABS,
                'stacked' => true,
                'items' => $adminMenu
            ));
            ?>
        </div>

        <div class="span10 auth-module">

            <?php $this->widget(
                'bootstrap.widgets.TbNav',
                array(
                    'type' => TbHtml::NAV_TYPE_TABS,
                    'items' => array(
                        array(
                            'label' => Yii::t('AuthModule.main', 'Assignments'),
                            'url' => array('/auth/assignment/index'),
                            'active' => $this instanceof AssignmentController,
                        ),
                        array(
                            'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_ROLE, true)),
                            'url' => array('/auth/role/index'),
                            'active' => $this instanceof RoleController,
                        ),
                        array(
                            'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_TASK, true)),
                            'url' => array('/auth/task/index'),
                            'active' => $this instanceof TaskController,
                        ),
                        array(
                            'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_OPERATION, true)),
                            'url' => array('/auth/operation/index'),
                            'active' => $this instanceof OperationController,
                        ),
                    ),
                )
            ); ?>

            <?php echo $content; ?>

        </div>


    </div>
    <div class="clear"></div>
    <div id="footer">
        <div id="virtualKeyboard"></div>

    </div><!-- footer -->

</div><!-- page -->


</body>
</html>