<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';

?>


<center>
<div class="container-fluid well" style="width:350px">

 <div class="row-fluid">



          <!-- <div class="span4" ><img src="../dist/img/logo.png" ></div> -->
          
          <div class="span12" >
              <div class="row-fluid"><h3>กรุณาล็อคอินเข้าสู่ระบบ</h3> 
              <?php /** @var BootActiveForm $form */
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'verticalForm',
                        'htmlOptions'=>array('align'=>'left'),
                    )); ?>

                    <?php 
                    echo "<span style='display: block;margin-bottom: 5px;text-align:left'><i class='icon-user'></i>  ชื่อผู้ใช้งาน</span>";
                    echo $form->textFieldRow($model, 'username', array('class'=>'span12','labelOptions' => array('label' => false))); ?>
                    <?php 
                    echo "<span style='display: block;margin-bottom: 5px;text-align:left'><i class='icon-lock'></i>  รหัสผ่าน</span>";
                    echo $form->passwordFieldRow($model, 'password', array('class'=>'span12','labelOptions' => array('label' => false))); ?>

                    <?php $this->widget('bootstrap.widgets.TbButton', array('htmlOptions'=>array('class'=>'pull-right'),'buttonType'=>'submit','type'=>'primary', 'label'=>'Login')); ?>

                    <?php $this->endWidget(); ?>
              </div>    
          </div>
        </div>
</div>
</center>