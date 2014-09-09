<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'staff-form',
	'enableAjaxValidation'=>false,
        'type'=>'vertical',
        'htmlOptions'=>  array('class'=>'well','style'=>'width:650px;margin:0 auto;;'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

  <div class="row-fluid">
    <div class="span2">
     <?php echo $form->textFieldRow($model,'title',array('label'=>'คำนำ','class'=>'span12','maxlength'=>20)); ?>
    </div>
   
  </div>
  <div class="row-fluid">
   
    <div class="span6">
      <?php echo $form->textFieldRow($model,'firstname',array('class'=>'span12','maxlength'=>100)); ?>
    </div>
    <div class="span6">
      <?php echo $form->textFieldRow($model,'lastname',array('class'=>'span12','maxlength'=>100)); ?>
      
    </div>
  </div>
  <div class="row-fluid">
    <div class="span6">
     <?php echo $form->textFieldRow($model,'phone',array('class'=>'span12','maxlength'=>10)); ?>
    </div>
    <div class="span6">
      <?php //echo $form->textFieldRow($model,'type_id',array('class'=>'span12','maxlength'=>1)); ?>
       <?php 
       $typelist = CHtml::listData(StaffType::model()->findAll(),'type_id','name');
       echo $form->dropDownListRow($model, 'type_id', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--')); 
       ?>   
    </div>
   
  </div>	

  <div class="row-fluid">
    <div class="span6">
     <?php echo $form->textFieldRow($model,'username',array('class'=>'span12','maxlength'=>20)); ?>
    </div>
    <div class="span6">
     <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span12','maxlength'=>20)); ?>
    </div>
   
  </div>		


	<div class="form-actions">
		<?php 
                
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
                    
		)); 
               echo "<span>  </span>";
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'danger',
			'label'=>'ยกเลิก',
                        
                        'url'=>array("admin"), 
		)); 
                
                ?>
	</div>

<?php $this->endWidget(); ?>
