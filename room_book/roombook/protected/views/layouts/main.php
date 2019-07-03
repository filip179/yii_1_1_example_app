<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <link href="./../../css/main.css" rel="stylesheet">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body style="margin-top:30px;">

<div class="col-md-2 col-xs-12">

    <?php $this->widget(
        'bootstrap.widgets.TbMenu',
        array(
            'type' => 'list',
            'items' => array(
                array(
                    'label' => 'Room Book',
                    'itemOptions' => array('class' => 'nav-header')
                ),
                array(
                    'label' => 'Dashboard',
                    'url' => '/site/index',
                    'visible' => !Yii::app()->user->isGuest
                ),
                array(
                    'label' => 'Rooms',
                    'url' => '/rooms/index',
                    'visible' => !Yii::app()->user->isGuest
                ),
                array(
                    'label' => 'Events',
                    'url' => '/events/index',
                    'visible' => !Yii::app()->user->isGuest
                ),
                array(
                    'label' => 'Users',
                    'url' => '/user/index',
                    'visible' => !Yii::app()->user->isGuest
                ),
                array(
                    'label' => 'Login',
                    'url' => '/site/login',
                    'visible' => Yii::app()->user->isGuest,
                ),
                array(
                    'label' => 'Actions',
                    'itemOptions' => array('class' => 'nav-header')
                ),
                array(
                    'label' => 'Logout',
                    'url' => '/site/logout',
                    'visible' => !Yii::app()->user->isGuest,
                ),
            )
        )
    ); ?>
</div>
<div class="col-md-9 col-xs-12">

    <?php echo $content; ?>
</div>


</body>
</html>