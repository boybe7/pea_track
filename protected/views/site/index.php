<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'ยินดีต้อนรับเข้าสู่ '.CHtml::encode(Yii::app()->name),
)); ?>

<?php $this->endWidget(); ?>

