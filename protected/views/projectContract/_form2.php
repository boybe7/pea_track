<h5>เพิ่มข้อมูลคู่สัญญา</h5>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contract-form',
	'enableAjaxValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions'=>  array('class'=>'well text-center')
)); ?>

	<!-- <p class="help-block">Fields with <span class="required">*</span> are required.</p> -->

	<div style="text-align:left"><?php echo $form->errorSummary($model); ?></div>
	<div class="row-fluid">
    	<div class="span12">
      		<?php echo $form->textFieldRow($model,'pc_code',array('class'=>'span12','maxlength'=>200)); ?>
    	</div>
    	
  	</div>
  	<div class="row-fluid">
    	
    	<div class="span12">
      		<?php echo $form->textFieldRow($model,'pc_cost',array('class'=>'span12','maxlength'=>13)); ?>
    	</div>
  	</div>
	<div class="row-fluid">
    	<div class="span12">	
			<?php echo $form->textAreaRow($model,'pc_detail',array('rows'=>3, 'cols'=>50, 'class'=>'span12')); ?>
		</div>
	</div>	
	

	
  
<?php $this->endWidget(); ?>

