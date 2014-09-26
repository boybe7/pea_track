<h5>เพิ่มข้อมูลคู่สัญญา</h5>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'vendor-form',
	'enableAjaxValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions'=>  array('class'=>'well text-center')
)); ?>

	<!-- <p class="help-block">Fields with <span class="required">*</span> are required.</p> -->

	<div style="text-align:left"><?php echo $form->errorSummary($model); ?></div>
	<div class="row-fluid">
    	<div class="span12">
      		<?php echo $form->textFieldRow($model,'v_name',array('class'=>'span12','maxlength'=>200)); ?>
    	</div>
    	
  	</div>
  	<div class="row-fluid">
    	
    	<div class="span12">
      		<?php echo $form->textFieldRow($model,'v_tax_id',array('class'=>'span12','maxlength'=>13)); ?>
    	</div>
  	</div>
	<div class="row-fluid">
    	<div class="span12">	
			<?php echo $form->textAreaRow($model,'v_address',array('rows'=>3, 'cols'=>50, 'class'=>'span12')); ?>
		</div>
	</div>	
	<div class="row-fluid">
    	<div class="span12">	
			<?php echo $form->textFieldRow($model,'v_tel',array('class'=>'span12','maxlength'=>25)); ?>
		</div>
	</div>	
	<div class="row-fluid">
    	<div class="span12">	
			<?php echo $form->textFieldRow($model,'v_contractor',array('class'=>'span12','maxlength'=>100)); ?>
		</div>
	</div>
	

	
  
<?php $this->endWidget(); ?>

