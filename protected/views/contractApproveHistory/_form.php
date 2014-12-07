
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contract-approve-history-form',
	'enableAjaxValidation'=>true,
)); ?>
<h3>เพิ่มข้อมูลการอนุมัติ</h3>
<form id="contract-approve-history-form">
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'contract_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'detail',array('class'=>'span5','maxlength'=>500)); ?>

	<?php //echo $form->textFieldRow($model,'dateApprove',array('class'=>'span5')); ?>
			<div class="row-fluid">		
					<div class="span3">
      					<?php echo $form->labelEx($model,'dateApprove',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
    					<?php       			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'dateApprove',
		                        'attribute'=>'dateApprove',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->dateApprove),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      			 ?>
		      		</div>
		    </div>

	<?php echo $form->textFieldRow($model,'approveBy',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'cost',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'timeSpend',array('class'=>'span5','maxlength'=>200)); ?>
</form>
<script type="text/javascript">
	$(function () {
		jQuery('#dateApprove').datepicker({'mode':'focus','format':'dd/mm/yyyy','showAnim':'slideDown'});
       
  
	});

</script>

<?php $this->endWidget(); ?>
